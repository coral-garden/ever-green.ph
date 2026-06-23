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

        $data = ['meta' => config("site.meta.$page"), 'division' => $division];

        if ($page === 'solar-projects') {
            $data['projects'] = config('projects.projects');
            $data['testimonials'] = config('projects.testimonials');
        } elseif ($page === 'solar') {
            $data['testimonials'] = array_slice(config('projects.testimonials'), 0, 3);
        }

        return view($view, $data);
    }
}
