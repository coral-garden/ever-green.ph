<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BillParserTest extends TestCase
{
    private const SAMPLE = [
        'data' => [
            'is_electric_bill' => true,
            'utility_provider' => 'Pacific Power',
            'total_amount_due' => 142.57,
            'total_kwh_used' => 845,
            'rate_per_kwh' => 0.1687,
            'currency' => 'USD',
        ],
        'credits_remaining' => 99,
    ];

    protected function setUp(): void
    {
        parent::setUp();
        config(['services.bill_parser.url' => 'https://parser.test/api/v1/bill-parser']);
    }

    public function test_parses_a_bill_and_returns_normalized_fields(): void
    {
        Http::fake(['parser.test/*' => Http::response(self::SAMPLE, 200)]);

        $this->postJson('/estimate/parse-bill', ['file' => UploadedFile::fake()->image('bill.jpg')])
            ->assertOk()
            ->assertJson([
                'ok' => true,
                'bill' => [
                    'amount' => 142.57,
                    'kwh' => 845,
                    'rate' => 0.1687,
                    'currency' => 'USD',
                    'provider' => 'Pacific Power',
                ],
            ]);
    }

    public function test_surfaces_api_message_for_non_electric_bill(): void
    {
        Http::fake(['parser.test/*' => Http::response([
            'message' => 'The uploaded file does not look like an electric utility bill.',
            'credits_remaining' => 8,
        ], 422)]);

        $this->postJson('/estimate/parse-bill', ['file' => UploadedFile::fake()->image('receipt.jpg')])
            ->assertOk()
            ->assertJson([
                'ok' => false,
                'message' => 'The uploaded file does not look like an electric utility bill.',
            ]);
    }

    public function test_handles_parser_failure_gracefully(): void
    {
        Http::fake(['parser.test/*' => Http::response('error', 500)]);

        $this->postJson('/estimate/parse-bill', ['file' => UploadedFile::fake()->image('bill.jpg')])
            ->assertOk()
            ->assertJson(['ok' => false]);
    }

    public function test_requires_a_file(): void
    {
        $this->postJson('/estimate/parse-bill', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['file']);
    }

    public function test_rejects_a_bill_larger_than_four_megabytes(): void
    {
        $file = UploadedFile::fake()->create('bill.pdf', 4097, 'application/pdf');

        $this->postJson('/estimate/parse-bill', ['file' => $file])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['file']);
    }
}
