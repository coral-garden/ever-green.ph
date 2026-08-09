<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarHomeTest extends TestCase
{
    public function test_home_shows_testimonial_strip_linking_to_projects(): void
    {
        $response = $this->get('/solar');
        $response->assertOk();
        $response->assertSee('Dayo Siargao');
        $response->assertSee('/assets/projects/dayo-siargao-1.webp', false);
        $response->assertSee('James Gaffod');
        $response->assertSee('home-testimonials', false);
        $response->assertSee('/solar/projects', false);
    }

    public function test_featured_tiles_are_real_projects_and_link_to_projects_page(): void
    {
        $response = $this->get('/solar');
        $response->assertOk();

        // The four latest documented installs, in config order.
        $response->assertSee('Martin and Rain');
        $response->assertSee('Dayo Siargao');
        $response->assertSee('Bamboo Surf Beach Resort');
        $response->assertSee('Sunlit Hostel Siargao');

        // no leftover placeholder tiles / dead anchors
        $response->assertDontSee('Hillside array');
        $response->assertDontSee('Among the palms');
        $response->assertDontSee('Seaside rooftop');
        $response->assertDontSee('/assets/project-palms.webp', false);
    }
}
