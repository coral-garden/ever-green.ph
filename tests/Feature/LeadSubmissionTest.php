<?php

namespace Tests\Feature;

use App\Services\Leads\LeadForwarder;
use Mockery;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    private function fakeForwarder(): Mockery\MockInterface
    {
        $mock = Mockery::mock(LeadForwarder::class);
        $this->app->instance(LeadForwarder::class, $mock);

        return $mock;
    }

    public function test_valid_ajax_submission_returns_ok_and_forwards(): void
    {
        $this->fakeForwarder()->shouldReceive('forward')->once();

        $this->postJson('/estimate/lead', [
            'name' => 'Juan Cruz',
            'mobile' => '0966 000 0000',
            'email' => 'juan@example.com',
            'system_type' => 'Hybrid',
        ])->assertOk()->assertJson(['ok' => true]);
    }

    public function test_invalid_ajax_submission_returns_422(): void
    {
        $this->fakeForwarder()->shouldNotReceive('forward');

        $this->postJson('/estimate/lead', ['mobile' => '123'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email']);
    }

    public function test_honeypot_silently_succeeds_without_forwarding(): void
    {
        $this->fakeForwarder()->shouldNotReceive('forward');

        $this->postJson('/estimate/lead', [
            'name' => 'Bot',
            'mobile' => '1',
            'email' => 'bot@example.com',
            '_gotcha' => 'spam',
        ])->assertOk()->assertJson(['ok' => true]);
    }

    public function test_non_ajax_submission_redirects_with_success_flash(): void
    {
        $this->fakeForwarder()->shouldReceive('forward')->once();

        $this->post('/estimate/lead', [
            'name' => 'Maria',
            'mobile' => '0977 000 0000',
            'email' => 'maria@example.com',
        ])->assertRedirect('/solar/estimate')->assertSessionHas('lead_success', true);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
