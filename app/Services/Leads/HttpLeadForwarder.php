<?php

namespace App\Services\Leads;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Forwards leads to the external lead API via an outbound HTTP call.
 * The key is origin-restricted (the key's allowlisted domain is sent as the
 * Origin header). On any failure it falls back to the `leads` log channel so
 * the lead is never lost and the user-facing form still succeeds.
 */
class HttpLeadForwarder implements LeadForwarder
{
    public function __construct(
        private string $url,
        private ?string $key = null,
        private ?string $origin = null,
        private ?LeadForwarder $fallback = null,
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
                $this->fallback($lead, "HTTP {$response->status()}: {$response->body()}");
            }
        } catch (Throwable $e) {
            $this->fallback($lead, $e->getMessage());
        }
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

    private function fallback(array $lead, string $reason): void
    {
        Log::error('lead.forward_failed', ['reason' => $reason]);
        $this->fallback?->forward($lead + ['_forward_failed' => $reason]);
    }
}
