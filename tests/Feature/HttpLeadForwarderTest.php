<?php

namespace Tests\Feature;

use App\Services\Leads\HttpLeadForwarder;
use App\Services\Leads\LeadForwarder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
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
        ]);
    }

    public function test_the_container_binds_the_http_forwarder_when_a_url_is_set(): void
    {
        $this->assertInstanceOf(HttpLeadForwarder::class, $this->app->make(LeadForwarder::class));
    }

    public function test_it_maps_the_payload_and_sends_token_and_origin(): void
    {
        Http::fake(['leads.test/*' => Http::response(['ok' => true], 200)]);

        $this->app->make(LeadForwarder::class)->forward([
            'name' => 'Juan Cruz',
            'mobile' => '0966 000 0000',
            'email' => 'juan@example.com',
            'division' => 'solar',
        ]);

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
    }

    public function test_it_falls_back_to_the_leads_log_on_api_failure_without_throwing(): void
    {
        Http::fake(['leads.test/*' => Http::response('nope', 500)]);

        Log::shouldReceive('error')->once();
        Log::shouldReceive('channel')->with('leads')->once()->andReturnSelf();
        Log::shouldReceive('info')->once()->with('lead.captured', Mockery::on(
            fn ($ctx) => ($ctx['_forward_failed'] ?? null) !== null
        ));

        // Must not throw — the public form always succeeds for the user.
        $this->app->make(LeadForwarder::class)->forward([
            'name' => 'Maria',
            'mobile' => '1',
            'email' => 'maria@example.com',
        ]);
    }
}
