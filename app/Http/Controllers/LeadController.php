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
        // Keep the trap for simple non-JavaScript bots. Legitimate AJAX submissions
        // may have this off-screen field populated by a browser password manager.
        if ($request->filled('_gotcha') && ! $request->expectsJson()) {
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

        return redirect()->route('solar-estimate')->with('lead_success', true);
    }
}
