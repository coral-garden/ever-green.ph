<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarPageDataTest extends TestCase
{
    public function test_projects_page_view_receives_projects_and_testimonials(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertOk();
        $response->assertViewHas('projects');
        $response->assertViewHas('testimonials');
    }

    public function test_solar_home_view_receives_testimonials(): void
    {
        $response = $this->get('/solar');
        $response->assertOk();
        $response->assertViewHas('testimonials');
    }

    public function test_other_pages_do_not_receive_projects(): void
    {
        $this->get('/about')->assertOk()->assertViewMissing('projects');
    }
}
