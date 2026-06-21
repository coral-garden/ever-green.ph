<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /** Map of route slug => Blade view. */
    private const PAGES = [
        // Group-level
        'home'           => 'pages.home',
        'about'          => 'pages.about',
        'contact'        => 'pages.contact',
        'terms'          => 'pages.terms',
        'privacy'        => 'pages.privacy',
        'accessibility'  => 'pages.accessibility',
        // Solar division
        'solar'          => 'solar.index',
        'solar-services' => 'solar.services',
        'solar-estimate' => 'solar.estimate',
        'solar-projects' => 'solar.projects',
    ];

    public function show(string $page): View
    {
        if (! isset(self::PAGES[$page])) {
            throw new NotFoundHttpException();
        }

        return view(self::PAGES[$page], ['meta' => config("site.meta.$page")]);
    }
}
