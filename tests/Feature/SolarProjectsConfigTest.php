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

        // four documented installs carry specs
        foreach (['sunlit-hostel', 'filmegz-seaside', 'yugo-grill', 'bamboo-surf'] as $slug) {
            $this->assertArrayHasKey($slug, $bySlug, "missing project $slug");
            $this->assertNotEmpty($bySlug[$slug]['specs'], "$slug should have specs");
            $this->assertNotEmpty($bySlug[$slug]['photos'], "$slug should have photos");
        }

        // three placeholders kept as photo-only (no specs key)
        foreach (['roxy-dapa', 'casa-cahuenga', 'garcia-villa'] as $slug) {
            $this->assertArrayHasKey($slug, $bySlug, "missing extra $slug");
            $this->assertArrayNotHasKey('specs', $bySlug[$slug], "$slug should be photo-only");
        }
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
