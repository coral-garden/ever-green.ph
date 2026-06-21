<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:120'],
            'mobile'   => ['required', 'string', 'max:40'],
            'email'    => ['required', 'email:rfc', 'max:160'],
            'city'     => ['nullable', 'string', 'max:120'],
            'message'  => ['nullable', 'string', 'max:2000'],
            'division' => ['nullable', 'string', 'max:40'],

            // Estimate snapshot fields auto-filled by the calculator (JS-formatted strings).
            'bill_php'                => ['nullable', 'string', 'max:60'],
            'system_type'             => ['nullable', 'string', 'max:60'],
            'system_size_kwp'         => ['nullable', 'string', 'max:60'],
            'panels'                  => ['nullable', 'string', 'max:60'],
            'target_offset_pct'       => ['nullable', 'string', 'max:60'],
            'est_cost_php'            => ['nullable', 'string', 'max:60'],
            'est_monthly_savings_php' => ['nullable', 'string', 'max:60'],
        ];
    }

    /** The validated lead payload, normalized for forwarding. */
    public function leadPayload(): array
    {
        return array_merge(
            $this->safe()->only([
                'name', 'mobile', 'email', 'city', 'message', 'division',
                'bill_php', 'system_type', 'system_size_kwp', 'panels',
                'target_offset_pct', 'est_cost_php', 'est_monthly_savings_php',
            ]),
            [
                'division'     => $this->input('division', 'solar'),
                'submitted_at' => now()->toIso8601String(),
                'ip'           => $this->ip(),
                'user_agent'   => (string) $this->userAgent(),
            ],
        );
    }
}
