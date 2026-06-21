<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /** Map of route slug => Blade view under resources/views/pages. */
    private const PAGES = [
        'home'          => 'pages.home',
        'services'      => 'pages.services',
        'estimate'      => 'pages.estimate',
        'projects'      => 'pages.projects',
        'about'         => 'pages.about',
        'terms'         => 'pages.terms',
        'privacy'       => 'pages.privacy',
        'accessibility' => 'pages.accessibility',
    ];

    public function show(string $page): View
    {
        if (! isset(self::PAGES[$page])) {
            throw new NotFoundHttpException();
        }

        $meta = config("site.meta.$page");

        return view(self::PAGES[$page], ['meta' => $meta]);
    }
}
