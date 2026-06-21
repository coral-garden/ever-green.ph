<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class BillParser
{
    /**
     * POST a bill image/PDF to the parser API.
     * Returns ['ok' => bool, 'status' => int, 'json' => array]. The API is
     * origin-restricted, so we send a configured Origin header (the key's
     * allowlisted domain). Non-bills come back as 422 with a {message}; that's
     * not thrown — the caller surfaces it. Only transport failures throw.
     */
    public function parse(UploadedFile $file): array
    {
        $url = config('services.bill_parser.url');

        if (empty($url)) {
            throw new RuntimeException('Bill parser is not configured (BILL_PARSER_URL).');
        }

        $headers = [];
        if ($origin = config('services.bill_parser.origin')) {
            $headers['Origin'] = $origin;
        }

        $request = Http::timeout(45)->acceptJson()->withHeaders($headers);

        if ($key = config('services.bill_parser.key')) {
            $request = $request->withToken($key);
        }

        $response = $request
            ->attach('bill_file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post($url);

        return [
            'ok' => $response->successful(),
            'status' => $response->status(),
            'json' => $response->json() ?? [],
        ];
    }
}
