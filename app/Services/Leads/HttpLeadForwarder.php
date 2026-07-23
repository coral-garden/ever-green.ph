<?php

namespace App\Services\Leads;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Forwards leads to the external lead API and sends an email notification.
 * The key is origin-restricted (the key's allowlisted domain is sent as the
 * Origin header). API failures are logged and included in the email so the
 * lead is still delivered and the user-facing form can succeed.
 */
class HttpLeadForwarder implements LeadForwarder
{
    public function __construct(
        private string $url,
        private ?string $key = null,
        private ?string $origin = null,
        private ?LeadForwarder $email = null,
    ) {}

    public function forward(array $lead): void
    {
        try {
            $request = Http::timeout(8)->acceptJson();

            if ($this->origin) {
                $request = $request->withHeaders(['Origin' => $this->origin]);
            }

            if ($this->key) {
                $request = $request->withToken($this->key);
            }

            $response = $request->post($this->url, $this->payload($lead));

            if ($response->failed()) {
                $this->emailAfterFailure($lead, "HTTP {$response->status()}: {$response->body()}");

                return;
            }
        } catch (Throwable $e) {
            $this->emailAfterFailure($lead, $e->getMessage());

            return;
        }

        $this->email?->forward($lead);
    }

    /**
     * Map the internal lead shape to the API contract
     * ({contact_name, email, phone, score}). Remaining captured fields
     * (city, message, division, estimate snapshot, …) ride along as extras.
     */
    private function payload(array $lead): array
    {
        return [
            'contact_name' => $lead['name'] ?? null,
            'phone'        => $lead['mobile'] ?? null,
            'score'        => true, // request lead scoring on the API side
        ] + Arr::except($lead, ['name', 'mobile']);
    }

    private function emailAfterFailure(array $lead, string $reason): void
    {
        Log::error('lead.forward_failed', ['reason' => $reason]);
        $this->email?->forward($lead + ['_forward_failed' => $reason]);
    }
}
