<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarProjectsPageTest extends TestCase
{
    public function test_shows_documented_projects_with_specs(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertOk();
        $response->assertSee('Martin and Rain');
        $response->assertSee('Off-grid setup for 4 houses');
        $response->assertSee('Dayo Siargao');
        $response->assertSee('27× 630W bifacial panels');
        $response->assertSee('Yugo Grill and Restaurant');
        $response->assertSee('Bamboo Surf Beach Resort');
        $response->assertSee('54× 715W bifacial panels · 12yr warranty');
        $response->assertSee('pspecs', false); // spec-card list class is rendered
    }

    public function test_shows_photo_only_extras(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertSee('Suba Resort');
        $response->assertSee('Casa Cahuenga');
        $response->assertSee('Roxy');
        $response->assertSee('href="/solar/projects/suba-resort"', false);
        $response->assertSee('Photos + video');
    }

    public function test_spec_projects_show_a_roof_and_equipment_pair(): void
    {
        // Each documented project renders as a row with a .proj-pair holding the
        // rooftop photo and its inverter/battery photo.
        $response = $this->get('/solar/projects');
        $response->assertSee('proj-pair', false);
        $response->assertSee('Rooftop array', false);
        $response->assertSee('Inverter &amp; battery', false);
        // the equipment photo is shown inline, not just hidden in the lightbox
        $response->assertSee('src="/assets/projects/martin-and-rain-3.webp"', false);
        $response->assertSee('src="/assets/projects/dayo-siargao-2.webp"', false);
        $response->assertSee('src="/assets/projects/sunlit-hostel-3.webp"', false);
    }

    public function test_shows_client_testimonials(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertSee('James Gaffod');
        $response->assertSee('Antonio Altair');
        $response->assertSee('tcard', false);  // testimonial card class rendered
        $response->assertSee('tstars', false); // star row rendered
    }

    public function test_every_project_links_to_its_detail_page(): void
    {
        $response = $this->get('/solar/projects');

        foreach (config('projects.projects') as $project) {
            $response->assertSee('href="/solar/projects/'.$project['slug'].'"', false);
        }
    }
}
