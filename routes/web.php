<?php

use App\Http\Controllers\ConstructionController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// --- Group-level pages ---
$pages = [
    'home'          => '/',
    'about'         => '/about',
    'contact'       => '/contact',
    'terms'         => '/terms',
    'privacy'       => '/privacy',
    'accessibility' => '/accessibility',
    // Solar division
    'solar'          => '/solar',
    'solar-services' => '/solar/services',
    'solar-estimate' => '/solar/estimate',
    'solar-projects' => '/solar/projects',
];
foreach ($pages as $page => $path) {
    Route::get($path, [PageController::class, 'show'])->defaults('page', $page)->name($page);
}

// --- Frame Construction & Hardware Supply divisions ---
Route::get('/construction', [ConstructionController::class, 'index'])->name('construction');
Route::get('/hardware', [HardwareController::class, 'index'])->name('hardware');

// --- Lead form (division-agnostic endpoint) ---
Route::post('/estimate/lead', [LeadController::class, 'store'])->name('lead.store');

// --- 301 redirects: old URLs -> new IA ---
$redirects = [
    // pre-Laravel .html URLs
    '/index.html'         => '/',
    '/services.html'      => '/solar/services',
    '/estimate.html'      => '/solar/estimate',
    '/projects.html'      => '/solar/projects',
    '/about.html'         => '/about',
    '/terms.html'         => '/terms',
    '/privacy.html'       => '/privacy',
    '/accessibility.html' => '/accessibility',
    // first-gen clean URLs (Solar at root) -> new /solar/* IA
    '/services'              => '/solar/services',
    '/estimate'              => '/solar/estimate',
    '/projects'              => '/solar/projects',
    '/construction/materials' => '/hardware',
];
foreach ($redirects as $from => $to) {
    Route::redirect($from, $to, 301);
}
