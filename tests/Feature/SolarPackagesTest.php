<?php

namespace Tests\Feature;

use App\Mail\LeadCaptured;
use App\Services\Leads\LeadForwarder;
use Mockery;
use Tests\TestCase;

class SolarPackagesTest extends TestCase
{
    public function test_packages_are_discoverable_and_show_prices_and_equipment(): void
    {
        $this->get('/solar')->assertOk()->assertSeeInOrder([
            'Three systems,', 'id="packages"', '₱160,000', '₱399,000',
            '₱455,000', '₱525,000', '₱765,000', 'id="about"',
        ], false);

        $packagesPage = $this->get('/solar/packages')->assertOk()
            ->assertSee('<link rel="canonical" href="https://www.ever-green.ph/solar/packages"', false)
            ->assertSee('2 × Growatt 16.1 kWh')
            ->assertSee('SRNE 100 Ah, 25.6 V')
            ->assertSee('12-year panel warranty')
            ->assertSee('/solar/estimate?package=mini#quote', false)
            ->assertDontSee('/assets/packages/', false)
            ->assertDontSee('View the original offers');

        $this->assertSame(5, substr_count($packagesPage->getContent(), '12-year panel warranty'));

        $this->get('/solar/estimate')->assertOk()->assertSee('Browse advertised packages');
        $this->assertStringContainsString('/solar/packages</loc>', file_get_contents(public_path('sitemap.xml')));
    }

    public function test_quote_form_carries_the_selected_package_without_a_calculator_snapshot(): void
    {
        $this->get('/solar/estimate?package=package-4')->assertOk()
            ->assertSee('Package 4 · 12 kVA hybrid')
            ->assertSee('₱765,000')
            ->assertSee('name="solar_package" value="package-4"', false)
            ->assertSee('id="estimateSnapshot" disabled', false)
            ->assertSee('Send my package enquiry');

        foreach (['unknown', 'mini.extra', ['mini']] as $package) {
            $this->get('/solar/estimate?'.http_build_query(['package' => $package]))
                ->assertOk()->assertDontSee('name="solar_package"', false);
        }
    }

    public function test_package_enquiry_reaches_the_existing_pipeline_with_canonical_details(): void
    {
        $mock = Mockery::mock(LeadForwarder::class);
        $this->app->instance(LeadForwarder::class, $mock);
        $mock->shouldReceive('forward')->once()->withArgs(function (array $lead): bool {
            $this->assertSame('mini', $lead['solar_package']);
            $this->assertStringContainsString('Mini · 3 kVA hybrid — advertised price ₱160,000', $lead['message']);
            $this->assertStringContainsString('Please check my roof.', $lead['message']);
            $this->assertArrayNotHasKey('est_cost_php', $lead);
            $this->assertArrayNotHasKey('system_type', $lead);
            $this->assertStringContainsString('₱160,000', (new LeadCaptured($lead))->render());
            $this->assertStringNotContainsString('Estimated cost:', (new LeadCaptured($lead))->render());

            return true;
        });

        $this->postJson('/estimate/lead', [
            'name' => 'Juan Cruz', 'mobile' => '0966 000 0000', 'email' => 'juan@example.com',
            'solar_package' => 'mini', 'message' => 'Please check my roof.',
            'est_cost_php' => '1', 'system_type' => 'Grid-tied',
        ])->assertOk()->assertJson(['ok' => true]);
    }

    public function test_invalid_packages_are_rejected_and_selection_survives_validation_errors(): void
    {
        $mock = Mockery::mock(LeadForwarder::class);
        $this->app->instance(LeadForwarder::class, $mock);
        $mock->shouldNotReceive('forward');

        $this->postJson('/estimate/lead', [
            'name' => 'Juan Cruz', 'mobile' => '0966 000 0000', 'email' => 'juan@example.com',
            'solar_package' => 'unknown',
        ])->assertUnprocessable()->assertJsonValidationErrors('solar_package');

        $this->from('/solar/estimate?package=mini')->post('/estimate/lead', [
            'solar_package' => 'mini', 'message' => 'Keep my message.',
        ])->assertRedirect('/solar/estimate?package=mini')->assertSessionHasErrors('name');

        $this->get('/solar/estimate')->assertOk()
            ->assertSee('name="solar_package" value="mini"', false)
            ->assertSee('Keep my message.');
    }

    public function test_package_enquiry_also_works_without_javascript(): void
    {
        $mock = Mockery::mock(LeadForwarder::class);
        $this->app->instance(LeadForwarder::class, $mock);
        $mock->shouldReceive('forward')->once()->withArgs(fn (array $lead): bool => $lead['solar_package'] === 'package-4'
            && str_contains($lead['message'], '₱765,000')
            && ! array_key_exists('est_cost_php', $lead)
        );

        $this->post('/estimate/lead', [
            'name' => 'Juan Cruz', 'mobile' => '0966 000 0000', 'email' => 'juan@example.com',
            'solar_package' => 'package-4',
        ])->assertRedirect('/solar/estimate')->assertSessionHas('lead_success', true);
    }
}
