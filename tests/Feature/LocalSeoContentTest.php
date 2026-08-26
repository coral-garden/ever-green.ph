<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class LocalSeoContentTest extends TestCase
{
    public static function commercialHeadingProvider(): array
    {
        return [
            'solar landing' => ['/solar', 'Solar installation for Siargao'],
            'solar services' => ['/solar/services', 'Solar services in Siargao'],
            'solar estimate' => ['/solar/estimate', 'Solar cost &amp; savings estimate for Siargao'],
            'solar projects' => ['/solar/projects', 'Solar installations across Siargao'],
            'construction' => ['/construction', 'Steel-frame construction in Siargao'],
            'hardware' => ['/hardware', 'Building materials &amp; hardware supply in Siargao'],
            'contact' => ['/contact', 'Contact Evergreen in Siargao'],
        ];
    }

    #[DataProvider('commercialHeadingProvider')]
    public function test_commercial_pages_have_service_and_location_specific_headings(string $path, string $heading): void
    {
        $this->get($path)
            ->assertOk()
            ->assertSee('<h1', false)
            ->assertSee($heading, false);
    }

    public function test_hardware_and_estimator_titles_include_siargao(): void
    {
        $this->get('/hardware')
            ->assertSee('<title>Building Materials &amp; Hardware Supply in Siargao | Evergreen</title>', false);

        $this->get('/solar/estimate')
            ->assertSee('<title>Solar Cost &amp; Savings Estimate for Siargao | Evergreen Solar</title>', false);
    }

    public function test_estimator_explains_methodology_boundaries_and_examples(): void
    {
        $this->get('/solar/estimate')
            ->assertOk()
            ->assertSee('How the Siargao solar estimate works')
            ->assertSee('<time datetime="2026-08-26">26 August 2026</time>', false)
            ->assertSee('Typical grid-tied scenarios')
            ->assertSee('₱45,000–₱62,000 per kWp')
            ->assertSee('What the online estimate considers')
            ->assertSee('What your formal quote must confirm')
            ->assertSee('Frequently asked questions')
            ->assertSee('href="/solar/projects/bamboo-surf"', false)
            ->assertSee('href="/solar/projects/filmegz-seaside"', false)
            ->assertSee('Editable planning rate')
            ->assertSee('Simple planning payback')
            ->assertSee('excludes financing, maintenance, component replacement, degradation, taxes, and changes in electricity pricing')
            ->assertSee('Does the estimate promise a particular equipment warranty?')
            ->assertDontSee('Before the system runs free for 25+ yrs.')
            ->assertDontSee('like planting dozens of trees')
            ->assertDontSee('CO₂ avoided')
            ->assertSee('not a formal quote');
    }

    public function test_location_copy_uses_a_siargao_service_area_and_identifies_burgos_as_a_warehouse(): void
    {
        foreach (['/', '/solar', '/contact'] as $path) {
            $this->get($path)
                ->assertOk()
                ->assertDontSee('Davao')
                ->assertDontSee('Nova Tierra');
        }

        $this->get('/contact')
            ->assertSee('Serving Siargao Island')
            ->assertSee('Office: General Luna, Surigao del Norte')
            ->assertSee('This office is not open to the public')
            ->assertSee('Warehouse pickup in Burgos by arrangement');
    }

    public function test_homepage_structured_data_models_siargao_without_a_false_storefront(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        preg_match('/<script type="application\/ld\+json">\s*(.*?)\s*<\/script>/s', $html, $matches);
        $this->assertArrayHasKey(1, $matches, 'Homepage JSON-LD was not found');

        $jsonLd = json_decode($matches[1], true, flags: JSON_THROW_ON_ERROR);
        $nodes = collect($jsonLd['@graph'])->keyBy('@id');

        foreach (['#org', '#siargao', '#general-luna-office', '#solar', '#construction', '#hardware'] as $fragment) {
            $this->assertTrue($nodes->has("https://www.ever-green.ph/{$fragment}"), "Missing structured-data node {$fragment}");
        }

        $organization = $nodes['https://www.ever-green.ph/#org'];
        $this->assertSame(['@id' => 'https://www.ever-green.ph/#siargao'], $organization['areaServed']);
        $this->assertSame(['@id' => 'https://www.ever-green.ph/#general-luna-office'], $organization['location']);
        $this->assertSame(
            [
                ['@id' => 'https://www.ever-green.ph/#solar'],
                ['@id' => 'https://www.ever-green.ph/#construction'],
                ['@id' => 'https://www.ever-green.ph/#hardware'],
            ],
            $organization['subOrganization']
        );

        foreach (['#solar', '#construction', '#hardware'] as $fragment) {
            $division = $nodes["https://www.ever-green.ph/{$fragment}"];
            $this->assertSame(['@id' => 'https://www.ever-green.ph/#org'], $division['parentOrganization']);
            $this->assertSame(['@id' => 'https://www.ever-green.ph/#siargao'], $division['areaServed']);
            $this->assertArrayNotHasKey('location', $division);
            $this->assertSame('+639663051461', $division['telephone']);
            $this->assertNotEmpty($division['hasOfferCatalog']['itemListElement']);
        }

        $this->assertSame('AdministrativeArea', $nodes['https://www.ever-green.ph/#siargao']['@type']);
        $office = $nodes['https://www.ever-green.ph/#general-luna-office'];
        $this->assertSame('Place', $office['@type']);
        $this->assertFalse($office['publicAccess']);
        $this->assertSame('General Luna', $office['address']['addressLocality']);
        $this->assertSame('Surigao del Norte', $office['address']['addressRegion']);
        $this->assertFalse($nodes->has('https://www.ever-green.ph/#davao'));
        $this->assertStringNotContainsString('Davao', $matches[1]);
    }
}
