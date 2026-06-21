<?php

namespace Tests\Feature;

use App\Services\Leads\LeadForwarder;
use Mockery;
use Tests\TestCase;

class ConstructionTest extends TestCase
{
    public function test_construction_landing_renders_and_cross_links_hardware(): void
    {
        $this->get('/construction')
            ->assertOk()
            ->assertSee('Frame Construction')
            ->assertSee('Build for island living')
            ->assertSee('/hardware', escape: false);
    }

    public function test_lead_can_be_tagged_with_a_division(): void
    {
        $mock = Mockery::mock(LeadForwarder::class);
        $this->app->instance(LeadForwarder::class, $mock);
        $mock->shouldReceive('forward')
            ->once()
            ->with(Mockery::on(fn ($lead) => ($lead['division'] ?? null) === 'construction'));

        $this->postJson('/estimate/lead', [
            'name' => 'Pedro Builder',
            'mobile' => '0966 222 3333',
            'email' => 'pedro@example.com',
            'division' => 'construction',
        ])->assertOk()->assertJson(['ok' => true]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
