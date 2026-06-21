<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /** Map of route slug => [Blade view, division context]. */
    private const PAGES = [
        // Group-level
        'home'           => ['pages.home', 'group'],
        'about'          => ['pages.about', 'group'],
        'contact'        => ['pages.contact', 'group'],
        'terms'          => ['pages.terms', 'group'],
        'privacy'        => ['pages.privacy', 'group'],
        'accessibility'  => ['pages.accessibility', 'group'],
        // Solar division
        'solar'          => ['solar.index', 'solar'],
        'solar-services' => ['solar.services', 'solar'],
        'solar-estimate' => ['solar.estimate', 'solar'],
        'solar-projects' => ['solar.projects', 'solar'],
    ];

    public function show(string $page): View
    {
        if (! isset(self::PAGES[$page])) {
            throw new NotFoundHttpException();
        }

        [$view, $division] = self::PAGES[$page];

        return view($view, ['meta' => config("site.meta.$page"), 'division' => $division]);
    }
}
