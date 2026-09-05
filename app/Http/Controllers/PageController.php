<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller
{
    /** Map of route slug => [Blade view, division context]. */
    private const PAGES = [
        // Group-level
        'home' => ['pages.home', 'group'],
        'about' => ['pages.about', 'group'],
        'contact' => ['pages.contact', 'group'],
        'terms' => ['pages.terms', 'group'],
        'privacy' => ['pages.privacy', 'group'],
        'accessibility' => ['pages.accessibility', 'group'],
        // Solar division
        'solar' => ['solar.index', 'solar'],
        'solar-services' => ['solar.services', 'solar'],
        'solar-packages' => ['solar.packages', 'solar'],
        'solar-estimate' => ['solar.estimate', 'solar'],
        'solar-projects' => ['solar.projects', 'solar'],
    ];

    public function show(Request $request, string $page): View
    {
        if (! isset(self::PAGES[$page])) {
            throw new NotFoundHttpException;
        }

        [$view, $division] = self::PAGES[$page];

        $data = ['meta' => config("site.meta.$page"), 'division' => $division];

        if (in_array($page, ['solar', 'solar-packages', 'solar-estimate'], true)) {
            $data['packages'] = config('catalog.solar.packages');
        }

        if ($page === 'solar-estimate') {
            $slug = $request->old('solar_package', $request->query('package'));
            $data['selectedPackageSlug'] = is_string($slug) && isset($data['packages'][$slug]) ? $slug : null;
            $data['selectedPackage'] = $data['packages'][$data['selectedPackageSlug']] ?? null;
        }

        if ($page === 'solar-projects') {
            $data['projects'] = config('projects.projects');
            $data['testimonials'] = config('projects.testimonials');
        } elseif ($page === 'solar') {
            $data['testimonials'] = array_slice(config('projects.testimonials'), 0, 3);
            // Featured tiles: the first four documented (spec'd) installs, in config order.
            $data['featuredProjects'] = array_slice(
                array_values(array_filter(
                    config('projects.projects'),
                    fn ($p) => ! empty($p['specs'])
                )),
                0,
                4
            );
        }

        return view($view, $data);
    }

    public function project(string $slug): View
    {
        $project = collect(config('projects.projects'))->firstWhere('slug', $slug);

        if ($project === null) {
            throw new NotFoundHttpException;
        }

        $canonical = "https://www.ever-green.ph/solar/projects/{$project['slug']}";
        $description = "See Evergreen Solar's {$project['title']} installation in {$project['location']}, with project photos";
        $description .= empty($project['specs']) ? '.' : ' and solar system details.';

        return view('solar.project', [
            'division' => 'solar',
            'project' => $project,
            'meta' => [
                'title' => "{$project['title']} Solar Installation in Siargao — Evergreen Solar",
                'description' => $description,
                'canonical' => $canonical,
                'og_title' => "{$project['title']} — Evergreen Solar Project",
                'og_description' => $description,
                'og_url' => $canonical,
                'og_image' => 'https://www.ever-green.ph/assets/projects/'.$project['photos'][0],
                'og_image_alt' => "Solar installation at {$project['title']}, {$project['location']}",
                'twitter_title' => "{$project['title']} — Evergreen Solar Project",
                'twitter_description' => $description,
            ],
        ]);
    }
}
