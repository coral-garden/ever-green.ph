<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarProjectDetailPageTest extends TestCase
{
    public function test_documented_project_has_a_canonical_detail_page(): void
    {
        $response = $this->get('/solar/projects/bamboo-surf');

        $response->assertOk();
        $response->assertViewIs('solar.project');
        $response->assertViewHas('project', fn (array $project) => $project['slug'] === 'bamboo-surf');
        $response->assertSee('<title>Bamboo Surf Beach Resort Solar Installation in Siargao — Evergreen Solar</title>', false);
        $response->assertSee('<link rel="canonical" href="https://www.ever-green.ph/solar/projects/bamboo-surf"', false);
        $response->assertSee('Bamboo Surf Beach Resort');
        $response->assertSee('Pacifico, San Isidro, Siargao');
        $response->assertSee('54× 715W bifacial panels · 12yr warranty');
        $response->assertSee('/assets/projects/bamboo-surf-1.webp', false);
        $response->assertSee('/assets/projects/bamboo-surf-9.webp', false);
    }

    public function test_photo_only_project_also_has_a_detail_page(): void
    {
        $this->get('/solar/projects/suba-resort')
            ->assertOk()
            ->assertSee('Suba Resort')
            ->assertSee('/assets/projects/suba-resort-7.webp', false)
            ->assertSee('/assets/projects/suba-resort-drone.mp4', false);
    }

    public function test_unknown_project_slug_returns_not_found(): void
    {
        $this->get('/solar/projects/not-a-project')->assertNotFound();
    }

    public function test_sitemap_contains_every_project_detail_url(): void
    {
        $sitemap = file_get_contents(public_path('sitemap.xml'));

        foreach (config('projects.projects') as $project) {
            $url = "<loc>https://www.ever-green.ph/solar/projects/{$project['slug']}</loc>";

            $this->assertSame(
                1,
                substr_count($sitemap, $url),
                "Sitemap should contain exactly one URL for project {$project['slug']}"
            );
        }
    }
}
