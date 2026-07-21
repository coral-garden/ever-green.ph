<?php

namespace App\Services\Leads;

use App\Mail\LeadCaptured;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailLeadForwarder implements LeadForwarder
{
    public function __construct(private string $recipient) {}

    public function forward(array $lead): void
    {
        try {
            Mail::to($this->recipient)->send(new LeadCaptured($lead));
        } catch (Throwable $e) {
            Log::error('lead.email_failed', [
                'reason' => $e->getMessage(),
                'lead' => $lead,
            ]);
        }
    }
}
