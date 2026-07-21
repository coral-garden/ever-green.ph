<?php

namespace App\Http\Controllers;

use App\Services\BillParser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class BillParserController extends Controller
{
    public function parse(Request $request, BillParser $parser): JsonResponse
    {
        $request->validate([
            // Keep the raw upload comfortably below Lambda's 6 MB synchronous
            // payload limit; API Gateway base64-encodes binary request bodies.
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,heic,heif,pdf', 'max:4096'],
        ]);

        try {
            $result = $parser->parse($request->file('file'));
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'ok' => false,
                'message' => "We couldn't read that bill. Please enter your bill amount manually.",
            ]);
        }

        $bill = $result['json']['data'] ?? [];

        // Success: a parsed electric bill.
        if ($result['ok'] && ($bill['is_electric_bill'] ?? false)) {
            return response()->json([
                'ok' => true,
                'bill' => [
                    'amount' => $bill['total_amount_due'] ?? null,
                    'kwh' => $bill['total_kwh_used'] ?? null,
                    'rate' => $bill['rate_per_kwh'] ?? null,
                    'currency' => $bill['currency'] ?? null,
                    'provider' => $bill['utility_provider'] ?? null,
                ],
            ]);
        }

        // Non-bill or API error: surface the API's message when present.
        return response()->json([
            'ok' => false,
            'message' => $result['json']['message']
                ?? "We couldn't read that bill. Please enter your bill amount manually.",
        ]);
    }
}
