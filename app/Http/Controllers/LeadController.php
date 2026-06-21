<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Services\Leads\LeadForwarder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request, LeadForwarder $forwarder): JsonResponse|RedirectResponse
    {
        // Honeypot: bots fill the hidden _gotcha field. Pretend success, drop silently.
        if ($request->filled('_gotcha')) {
            return $this->success($request);
        }

        $forwarder->forward($request->leadPayload());

        return $this->success($request);
    }

    private function success(StoreLeadRequest $request): JsonResponse|RedirectResponse
    {
        if ($request->expectsJson()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('estimate')->with('lead_success', true);
    }
}
