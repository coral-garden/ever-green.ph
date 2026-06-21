<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HardwareController extends Controller
{
    public function index(): View
    {
        return view('hardware.index', [
            'meta' => config('site.meta.hardware'),
            'materials' => config('catalog.hardware.materials', []),
            'pickup' => config('catalog.hardware.pickup'),
        ]);
    }
}
