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
        ]);
    }
}
