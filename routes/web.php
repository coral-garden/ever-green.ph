<?php

use App\Http\Controllers\ConstructionController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// --- Pages (clean URLs) ---
$pages = ['home' => '/', 'services' => '/services', 'estimate' => '/estimate',
          'projects' => '/projects', 'about' => '/about', 'terms' => '/terms',
          'privacy' => '/privacy', 'accessibility' => '/accessibility'];

foreach ($pages as $page => $path) {
    Route::get($path, [PageController::class, 'show'])->defaults('page', $page)->name($page);
}

// --- Frame Construction division ---
Route::get('/construction', [ConstructionController::class, 'index'])->name('construction');
Route::get('/construction/materials', [ConstructionController::class, 'materials'])->name('construction.materials');

// --- Lead form ---
Route::post('/estimate/lead', [LeadController::class, 'store'])->name('lead.store');

// --- 301 redirects from the old static .html URLs ---
$redirects = ['index' => '/', 'services' => '/services', 'estimate' => '/estimate',
              'projects' => '/projects', 'about' => '/about', 'terms' => '/terms',
              'privacy' => '/privacy', 'accessibility' => '/accessibility'];

foreach ($redirects as $old => $new) {
    Route::redirect("/$old.html", $new, 301);
}
