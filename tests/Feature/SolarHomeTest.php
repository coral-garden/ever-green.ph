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
}
