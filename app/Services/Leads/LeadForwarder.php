<?php

namespace App\Services\Leads;

interface LeadForwarder
{
    /**
     * Deliver a captured lead to its destination.
     * Implementations must NOT throw on delivery failure — the public form
     * should always succeed for the user; failures are logged for recovery.
     */
    public function forward(array $lead): void;
}
