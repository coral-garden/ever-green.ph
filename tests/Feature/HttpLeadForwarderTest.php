<?php

namespace Tests\Feature;

use App\Mail\LeadCaptured;
use App\Services\Leads\HttpLeadForwarder;
use App\Services\Leads\LeadForwarder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Mockery;
use Tests\TestCase;

class HttpLeadForwarderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config([
            'services.lead_forwarder.url' => 'https://leads.test/api/v1/leads',
            'services.lead_forwarder.key' => 'lk_secret',
            'services.lead_forwarder.origin' => 'https://allowed.test',
            'services.lead_mail.to' => 'sales@example.com',
        ]);
    }

    public function test_the_container_binds_the_http_forwarder_when_a_url_is_set(): void
    {
        $this->assertInstanceOf(HttpLeadForwarder::class, $this->app->make(LeadForwarder::class));
    }

    public function test_it_sends_the_mapped_payload_to_the_api_and_emails_the_lead(): void
    {
        Http::fake(['leads.test/*' => Http::response(['ok' => true], 200)]);
        Mail::fake();

        $lead = [
            'name' => 'Juan Cruz',
            'mobile' => '0966 000 0000',
            'email' => 'juan@example.com',
            'division' => 'solar',
        ];

        $this->app->make(LeadForwarder::class)->forward($lead);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://leads.test/api/v1/leads'
                && $request->method() === 'POST'
                && $request->hasHeader('Authorization', 'Bearer lk_secret')
                && $request->hasHeader('Origin', 'https://allowed.test')
                && $request['contact_name'] === 'Juan Cruz'
                && $request['phone'] === '0966 000 0000'
                && $request['email'] === 'juan@example.com'
                && $request['score'] === true
                && $request['division'] === 'solar'
                && ! array_key_exists('name', $request->data())
                && ! array_key_exists('mobile', $request->data());
        });

        Mail::assertSent(LeadCaptured::class, fn (LeadCaptured $mail) =>
            $mail->hasTo('sales@example.com')
            && $mail->lead === $lead
        );
        Mail::assertSentCount(1);
    }

    public function test_it_falls_back_to_email_on_api_failure_without_throwing(): void
    {
        Http::fake(['leads.test/*' => Http::response('nope', 500)]);
        Mail::fake();

        Log::shouldReceive('error')->once()->with('lead.forward_failed', Mockery::type('array'));

        // Must not throw — the public form always succeeds for the user.
        $this->app->make(LeadForwarder::class)->forward([
            'name' => 'Maria',
            'mobile' => '1',
            'email' => 'maria@example.com',
        ]);

        Mail::assertSent(LeadCaptured::class, fn (LeadCaptured $mail) =>
            $mail->hasTo('sales@example.com')
            && ($mail->lead['_forward_failed'] ?? null) !== null
        );
        Mail::assertSentCount(1);
    }
}
