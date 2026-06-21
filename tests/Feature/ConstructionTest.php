<?php

namespace Tests\Feature;

use App\Services\Leads\LeadForwarder;
use Mockery;
use Tests\TestCase;

class ConstructionTest extends TestCase
{
    public function test_construction_landing_renders(): void
    {
        $this->get('/construction')
            ->assertOk()
            ->assertSee('Frame Construction')
            ->assertSee('Building materials');
    }

    public function test_materials_price_list_renders_catalog(): void
    {
        $this->get('/construction/materials')
            ->assertOk()
            ->assertSee('Shera Cement Board')
            ->assertSee('SPC Flooring')
            ->assertSee('₱1,900')          // Shera 12mm
            ->assertSee('subject to change');
    }

    public function test_lead_can_be_tagged_with_construction_division(): void
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

    public function test_lead_defaults_to_solar_division_when_unspecified(): void
    {
        $mock = Mockery::mock(LeadForwarder::class);
        $this->app->instance(LeadForwarder::class, $mock);
        $mock->shouldReceive('forward')
            ->once()
            ->with(Mockery::on(fn ($lead) => ($lead['division'] ?? null) === 'solar'));

        $this->postJson('/estimate/lead', [
            'name' => 'Ana Homeowner',
            'mobile' => '0977 444 5555',
            'email' => 'ana@example.com',
        ])->assertOk();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
