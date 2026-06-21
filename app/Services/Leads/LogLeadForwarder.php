<?php

namespace App\Services\Leads;

use Illuminate\Support\Facades\Log;

/**
 * Default forwarder used until the external lead system (TBC) is configured.
 * Persists every lead to the dedicated `leads` log channel so nothing is lost.
 */
class LogLeadForwarder implements LeadForwarder
{
    public function forward(array $lead): void
    {
        Log::channel('leads')->info('lead.captured', $lead);
    }
}
