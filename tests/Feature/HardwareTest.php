<?php

namespace Tests\Feature;

use Tests\TestCase;

class HardwareTest extends TestCase
{
    public function test_hardware_landing_renders_catalog(): void
    {
        $this->get('/hardware')
            ->assertOk()
            ->assertSee('Hardware Supply')
            ->assertSee('Shera Cement Board')
            ->assertSee('SPC Flooring')
            ->assertSee('₱1,900')          // Shera 12mm
            ->assertSee('subject to change');
    }

    public function test_old_materials_url_redirects_to_hardware(): void
    {
        $this->get('/construction/materials')->assertRedirect('/hardware');
    }
}
