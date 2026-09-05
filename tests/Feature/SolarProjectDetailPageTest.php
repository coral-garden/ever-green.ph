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

    public function test_project_page_has_breadcrumb_structured_data(): void
    {
        $html = $this->get('/solar/projects/bamboo-surf')->assertOk()->getContent();

        preg_match_all('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $html, $matches);
        $documents = collect($matches[1])->map(fn (string $json) => json_decode($json, true, flags: JSON_THROW_ON_ERROR));
        $breadcrumbs = $documents->firstWhere('@type', 'BreadcrumbList');

        $this->assertNotNull($breadcrumbs);
        $this->assertSame(
            ['Solar', 'Projects', 'Bamboo Surf Beach Resort solar installation'],
            array_column($breadcrumbs['itemListElement'], 'name')
        );
        $this->assertSame(
            'https://www.ever-green.ph/solar/projects/bamboo-surf',
            $breadcrumbs['itemListElement'][2]['item']
        );
    }

    public function test_project_images_have_responsive_sources_and_intrinsic_dimensions(): void
    {
        $response = $this->get('/solar/projects/bamboo-surf')->assertOk();

        $response
            ->assertSee('srcset="/assets/projects/responsive/bamboo-surf-1-480.webp 480w, /assets/projects/bamboo-surf-1.webp 854w"', false)
            ->assertSee('width="854"', false)
            ->assertSee('height="641"', false)
            ->assertSee('fetchpriority="high"', false)
            ->assertSee('loading="lazy"', false);

        $manifest = config('project-images');

        foreach (config('projects.projects') as $project) {
            foreach (array_unique(array_merge($project['photos'], isset($project['equipment']) ? [$project['equipment']] : [])) as $file) {
                $this->assertArrayHasKey($file, $manifest, "Missing dimensions for {$file}");
                $this->assertFileExists(public_path('assets/projects/responsive/'.pathinfo($file, PATHINFO_FILENAME).'-480.webp'));

                if ($manifest[$file]['width'] > 960) {
                    $this->assertFileExists(public_path('assets/projects/responsive/'.pathinfo($file, PATHINFO_FILENAME).'-960.webp'));
                }
            }
        }
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

    public function test_sitemap_uses_valid_last_modified_dates_instead_of_ignored_priorities(): void
    {
        $sitemap = file_get_contents(public_path('sitemap.xml'));
        $xml = simplexml_load_string($sitemap);

        $this->assertNotFalse($xml);
        $this->assertStringNotContainsString('<priority>', $sitemap);

        foreach ($xml->url as $url) {
            $lastModified = (string) $url->lastmod;
            $date = \DateTimeImmutable::createFromFormat('!Y-m-d', $lastModified);
            $this->assertNotFalse($date);
            $this->assertSame($lastModified, $date->format('Y-m-d'));
        }
    }
}
