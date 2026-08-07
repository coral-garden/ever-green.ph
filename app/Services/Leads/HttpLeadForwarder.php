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

        Log::info('lead.forward_succeeded', [
            'status' => $response->status(),
            'inquiry_id' => $response->json('data.id'),
        ]);

        $this->email?->forward($lead);
    }

    /**
     * Map the website form to Conduit's shared homeowner inquiry contract.
     */
    private function payload(array $lead): array
    {
        return [
            'contact_name' => $lead['name'] ?? null,
            'phone' => $lead['mobile'] ?? null,
            'email' => $lead['email'] ?? null,
            'city' => $lead['city'] ?? null,
            'country' => 'PH',
            'source' => 'website',
            'notes' => $lead['message'] ?? null,
            'monthly_bill' => $this->monthlyBill($lead['bill_php'] ?? null),
            'metadata' => Arr::except($lead, ['name', 'mobile', 'email', 'city', 'message']),
        ];
    }

    private function monthlyBill(mixed $value): ?int
    {
        $normalized = str_replace(',', '', trim((string) $value));

        return is_numeric($normalized) ? (int) round((float) $normalized) : null;
    }

    private function emailAfterFailure(array $lead, string $reason): void
    {
        Log::error('lead.forward_failed', ['reason' => $reason]);
        $this->email?->forward($lead + ['_forward_failed' => $reason]);
    }
}
