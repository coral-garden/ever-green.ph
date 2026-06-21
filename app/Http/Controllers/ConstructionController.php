<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ConstructionController extends Controller
{
    public function index(): View
    {
        return view('construction.index', ['meta' => config('site.meta.construction')]);
    }

    public function materials(): View
    {
        return view('construction.materials', [
            'meta' => config('site.meta.construction-materials'),
            'materials' => config('catalog.construction.materials', []),
            'pickup' => config('catalog.construction.pickup'),
        ]);
    }
}
