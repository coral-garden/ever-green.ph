<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class InformationArchitectureTest extends TestCase
{
    public static function pageProvider(): array
    {
        return [
            'group home'    => ['/', 'Evergreen'],
            'solar landing' => ['/solar', 'Powering'],
            'solar services' => ['/solar/services', 'Services'],
            'solar estimate' => ['/solar/estimate', 'estimate'],
            'solar projects' => ['/solar/projects', 'projects'],
            'about'         => ['/about', 'Evergreen'],
            'contact'       => ['/contact', 'Contact'],
            'terms'         => ['/terms', 'Terms'],
            'privacy'       => ['/privacy', 'Privacy'],
            'accessibility' => ['/accessibility', 'Accessibility'],
        ];
    }

    #[DataProvider('pageProvider')]
    public function test_page_renders(string $path, string $needle): void
    {
        $this->get($path)->assertOk()->assertSee($needle);
    }

    public function test_group_home_shows_brand_intro_and_division_blurbs(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('We power')                 // brand hero headline
            ->assertSee('island group')             // positioning line (existing copy)
            ->assertSee('High-performance solar')   // solar card blurb
            ->assertSee('termite-proof builds')     // construction card blurb
            ->assertSee('marine plywood');          // hardware card blurb
    }

    public static function redirectProvider(): array
    {
        return [
            ['/services', '/solar/services'],
            ['/estimate', '/solar/estimate'],
            ['/projects', '/solar/projects'],
            ['/services.html', '/solar/services'],
            ['/index.html', '/'],
            ['/about.html', '/about'],
            ['/construction/materials', '/hardware'],
        ];
    }

    #[DataProvider('redirectProvider')]
    public function test_legacy_url_redirects(string $from, string $to): void
    {
        $this->get($from)->assertRedirect($to);
    }
}
