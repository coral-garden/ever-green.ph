<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarProjectsPageTest extends TestCase
{
    public function test_shows_documented_projects_with_specs(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertOk();
        $response->assertSee('Yugo Grill and Restaurant');
        $response->assertSee('Bamboo Surf Beach Resort');
        $response->assertSee('54× 715W bifacial panels · 12yr warranty');
        $response->assertSee('pspecs', false); // spec-card list class is rendered
    }

    public function test_shows_photo_only_extras(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertSee('Casa Cahuenga');
        $response->assertSee('Roxy');
    }
}
