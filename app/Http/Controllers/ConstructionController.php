<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ConstructionController extends Controller
{
    public function index(): View
    {
        return view('construction.index', [
            'meta' => config('site.meta.construction'),
            'division' => 'construction',
            'designGallery' => self::DESIGN_GALLERY,
            'siteGallery' => self::SITE_GALLERY,
        ]);
    }

    /** Design/engineering visuals — 3D renders + a structural model. */
    private const DESIGN_GALLERY = [
        ['img' => 'construction-render-1.webp', 'tag' => 'Render', 'alt' => 'Aerial render of a full light-gauge steel roof canopy'],
        ['img' => 'construction-render-2.webp', 'tag' => 'Render', 'alt' => 'Render of a steel truss roof interior with concrete columns'],
        ['img' => 'construction-render-4.webp', 'tag' => 'Render', 'alt' => 'Bright open-span steel-frame interior render'],
        ['img' => 'construction-render-3.webp', 'tag' => 'Render', 'alt' => 'Daylight study of a steel truss roof interior'],
        ['img' => 'construction-plan-1.webp', 'tag' => 'Structural model', 'alt' => 'Isometric structural model of a steel building frame'],
    ];

    /** Real builds on site across Siargao. */
    private const SITE_GALLERY = [
        ['img' => 'construction-site-1.webp', 'tag' => 'On site', 'alt' => 'Crew framing a steel roof on a Siargao build'],
        ['img' => 'construction-site-2.webp', 'tag' => 'On site', 'alt' => 'Steel roof trusses being installed from scaffolding'],
        ['img' => 'construction-site-3.webp', 'tag' => 'On site', 'alt' => 'Steel roof trusses going up over a concrete structure'],
        ['img' => 'construction-site-4.webp', 'tag' => 'Materials', 'alt' => 'Stacked galvanized light-gauge steel truss components'],
    ];
}
