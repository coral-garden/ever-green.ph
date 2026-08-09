<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarProjectsConfigTest extends TestCase
{
    public function test_projects_config_has_spec_and_photo_only_entries(): void
    {
        $projects = config('projects.projects');

        $this->assertIsArray($projects);

        $bySlug = collect($projects)->keyBy('slug');

        // Documented installs carry the available system details.
        foreach (['martin-and-rain', 'dayo-siargao', 'sunlit-hostel', 'filmegz-seaside', 'yugo-grill', 'bamboo-surf'] as $slug) {
            $this->assertArrayHasKey($slug, $bySlug, "missing project $slug");
            $this->assertNotEmpty($bySlug[$slug]['specs'], "$slug should have specs");
            $this->assertNotEmpty($bySlug[$slug]['photos'], "$slug should have photos");
        }

        $this->assertSame('Martin and Rain', $bySlug['martin-and-rain']['title']);
        $this->assertSame(['Off-grid setup for 4 houses'], $bySlug['martin-and-rain']['specs']);
        $this->assertSame('martin-and-rain-3.webp', $bySlug['martin-and-rain']['equipment']);
        $this->assertCount(4, $bySlug['martin-and-rain']['photos']);

        $this->assertSame('Dayo Siargao', $bySlug['dayo-siargao']['title']);
        $this->assertSame('dayo-siargao-2.webp', $bySlug['dayo-siargao']['equipment']);
        $this->assertContains('27× 630W bifacial panels', $bySlug['dayo-siargao']['specs']);

        // Installs without documented system details stay photo-only.
        foreach (['suba-resort', 'kolekbibo', 'roxy-dapa', 'casa-cahuenga', 'garcia-villa'] as $slug) {
            $this->assertArrayHasKey($slug, $bySlug, "missing extra $slug");
            $this->assertArrayNotHasKey('specs', $bySlug[$slug], "$slug should be photo-only");
        }

        $this->assertSame('Suba Resort', $bySlug['suba-resort']['title']);
        $this->assertCount(7, $bySlug['suba-resort']['photos']);
        $this->assertSame('suba-resort-1.webp', $bySlug['suba-resort']['photos'][0]);
        $this->assertSame(['suba-resort-drone.mp4'], $bySlug['suba-resort']['videos']);
    }

    public function test_testimonials_config_has_three_five_star_quotes(): void
    {
        $testimonials = config('projects.testimonials');

        $this->assertCount(3, $testimonials);
        foreach ($testimonials as $t) {
            $this->assertNotEmpty($t['name']);
            $this->assertNotEmpty($t['quote']);
            $this->assertSame(5, $t['stars']);
        }
        $this->assertSame('James Gaffod', $testimonials[0]['name']);
    }
}
