<?php

namespace App\Services\Leads;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Forwards leads to the external system (TBC) via an outbound HTTP API call.
 * On any failure it falls back to the `leads` log channel so the lead is never
 * lost and the user-facing form still succeeds.
 */
class HttpLeadForwarder implements LeadForwarder
{
    public function __construct(
        private string $url,
        private ?string $key = null,
    ) {}

    public function forward(array $lead): void
    {
        try {
            $request = Http::timeout(8)->acceptJson();

            if ($this->key) {
                $request = $request->withToken($this->key);
            }

            $response = $request->post($this->url, $lead);

            if ($response->failed()) {
                $this->fallback($lead, "HTTP {$response->status()}: {$response->body()}");
            }
        } catch (Throwable $e) {
            $this->fallback($lead, $e->getMessage());
        }
    }

    private function fallback(array $lead, string $reason): void
    {
        Log::error('lead.forward_failed', ['reason' => $reason]);
        Log::channel('leads')->info('lead.captured', $lead + ['_forward_failed' => $reason]);
    }
}
