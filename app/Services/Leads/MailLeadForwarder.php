<?php

namespace App\Services\Leads;

use App\Mail\LeadCaptured;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

class MailLeadForwarder implements LeadForwarder
{
    public function __construct(
        private string $recipient,
        private ?string $bcc = null,
    ) {}

    public function forward(array $lead): void
    {
        $context = [
            'delivery_id' => (string) Str::uuid(),
            'recipient' => $this->recipient,
            'bcc' => $this->bcc,
        ];

        Log::info('lead.email_sending', $context);

        try {
            $mail = Mail::to($this->recipient);

            if ($this->bcc !== null && $this->bcc !== '') {
                $mail->bcc($this->bcc);
            }

            $sentMessage = $mail->send(new LeadCaptured($lead));

            Log::info('lead.email_sent', [
                ...$context,
                'message_id' => $sentMessage?->getMessageId(),
            ]);
        } catch (Throwable $e) {
            Log::error('lead.email_failed', [
                ...$context,
                'reason' => $e->getMessage(),
                'exception' => $e::class,
            ]);
        }
    }
}
