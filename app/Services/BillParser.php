<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BillParser
{
    /**
     * POST a bill image/PDF to the parser API and return its decoded JSON.
     * Throws on misconfiguration or a failed HTTP call (caller handles gracefully).
     */
    public function parse(UploadedFile $file): array
    {
        $url = config('services.bill_parser.url');

        if (empty($url)) {
            throw new RuntimeException('Bill parser is not configured (BILL_PARSER_URL).');
        }

        $request = Http::timeout(45)->acceptJson();

        if ($key = config('services.bill_parser.key')) {
            $request = $request->withToken($key);
        }

        $response = $request
            ->attach('bill_file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post($url);

        $response->throw();

        return $response->json() ?? [];
    }
}
