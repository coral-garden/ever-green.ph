<?php

namespace Tests\Feature;

use App\Mail\LeadCaptured;
use App\Services\Leads\LeadForwarder;
use App\Services\Leads\MailLeadForwarder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RuntimeException;
use Tests\TestCase;

class MailLeadForwarderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config([
            'services.lead_forwarder.url' => null,
            'services.lead_mail.to' => 'sales@example.com',
            'services.lead_mail.bcc' => 'archive@example.com',
        ]);
    }

    public function test_the_container_binds_the_mail_forwarder_without_an_api_url(): void
    {
        $this->assertInstanceOf(MailLeadForwarder::class, $this->app->make(LeadForwarder::class));
    }

    public function test_the_production_ses_v2_mailer_is_defined(): void
    {
        $this->assertSame('ses-v2', config('mail.mailers.ses-v2.transport'));
    }

    public function test_it_emails_the_lead_and_sets_reply_to(): void
    {
        Mail::fake();

        $this->app->make(LeadForwarder::class)->forward([
            'name' => 'Juan Cruz',
            'mobile' => '0966 000 0000',
            'email' => 'juan@example.com',
            'division' => 'solar',
        ]);

        Mail::assertSent(LeadCaptured::class, fn (LeadCaptured $mail) => $mail->hasTo('sales@example.com')
            && $mail->hasBcc('archive@example.com')
            && $mail->hasReplyTo('juan@example.com', 'Juan Cruz')
        );
    }

    public function test_the_email_contains_the_lead_details(): void
    {
        $body = (new LeadCaptured([
            'name' => 'Juan Cruz',
            'mobile' => '0966 000 0000',
            'email' => 'juan@example.com',
            'division' => 'solar',
            'est_cost_php' => '₱350,000',
        ]))->render();

        $this->assertStringContainsString('Juan Cruz', $body);
        $this->assertStringContainsString('0966 000 0000', $body);
        $this->assertStringContainsString('₱350,000', $body);
    }

    public function test_it_logs_mail_failure_without_throwing(): void
    {
        Mail::shouldReceive('to')->once()->andThrow(new RuntimeException('SES unavailable'));
        Log::shouldReceive('info')->once()->withArgs(fn (string $message, array $context): bool => $message === 'lead.email_sending'
                && Str::isUuid($context['delivery_id'])
                && $context['recipient'] === 'sales@example.com'
        );
        Log::shouldReceive('error')->once()->withArgs(fn (string $message, array $context): bool => $message === 'lead.email_failed'
            && Str::isUuid($context['delivery_id'])
            && $context['recipient'] === 'sales@example.com'
            && $context['reason'] === 'SES unavailable'
            && $context['exception'] === RuntimeException::class
        );

        $this->app->make(LeadForwarder::class)->forward(['name' => 'Maria']);
    }

    public function test_it_logs_when_ses_accepts_the_message(): void
    {
        Mail::fake();
        Log::shouldReceive('info')->once()->withArgs(fn (string $message, array $context): bool => $message === 'lead.email_sending'
            && Str::isUuid($context['delivery_id'])
            && $context['recipient'] === 'sales@example.com'
        );
        Log::shouldReceive('info')->once()->withArgs(fn (string $message, array $context): bool => $message === 'lead.email_sent'
            && Str::isUuid($context['delivery_id'])
            && $context['recipient'] === 'sales@example.com'
            && $context['message_id'] === null
        );

        $this->app->make(LeadForwarder::class)->forward(['name' => 'Maria']);
    }
}
