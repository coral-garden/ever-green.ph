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
            'file' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,heic,heif,pdf', 'max:10240'],
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

        $bill = $result['data'] ?? [];

        if (! ($bill['is_electric_bill'] ?? false)) {
            return response()->json([
                'ok' => false,
                'message' => "That doesn't look like an electric bill — please enter your bill amount manually.",
            ]);
        }

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
}
