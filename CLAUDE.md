# ever-green.ph

Marketing site for Evergreen Solar (two locations: Burgos, Siargao and Nova Tierra,
Davao City; copy is Siargao-focused). **Laravel app** (PHP 8.2+, Blade), migrated from
a static HTML build in June 2026. Server-rendered pages, clean URLs, one shared CSS file.
**No Node/npm build step** — CSS/JS are plain static files in `public/assets/`.

## Run / build
```bash
composer install
php artisan serve            # local dev → http://127.0.0.1:8000
php artisan view:clear       # after editing Blade if a stale compiled view sticks
```
Production: web root = `public/`, then `php artisan config:cache route:cache view:cache`.

## Structure
- 8 pages served by `PageController@show`: home, services, estimate, projects, about,
  terms, privacy, accessibility. Routes + `.html`→clean-URL 301s live in `routes/web.php`.
- `resources/views/layouts/app.blade.php` — the ONE shared `<head>` + header/footer mount
  + `@stack('head')` / `@stack('scripts')`.
- `resources/views/components/site/{header,footer}.blade.php` — shared nav/footer.
- `resources/views/pages/*.blade.php` — page content only (`@extends('layouts.app')`).
- `config/site.php` — per-page `<head>` meta (title, description, canonical, OG/Twitter).
- `public/assets/` — `site.css` (shared), `site.js` (shared chrome JS), `page-*.css/js`
  (per-page), images, plus `sitemap.xml` + `robots.txt`.
- `app/Services/Leads/` — `LeadForwarder` interface + `LogLeadForwarder` (default) /
  `HttpLeadForwarder`. `checkpoints/`, `original/` are reference only (not served).

## Gotchas
- **Header/footer are Blade components**, not page markup. Edit
  `resources/views/components/site/{header,footer}.blade.php` — changes apply everywhere.
  Their content is wrapped in `@verbatim` (it's static HTML with `@`/mailto that Blade
  must not parse). Same for `partials/jsonld-home.blade.php`.
- **Per-page `<head>` meta lives in `config/site.php`**, keyed by page slug — not in the
  Blade files. Add a page → add a route in `routes/web.php`, a view in `pages/`, a
  `PageController::PAGES` entry, and a `config/site.php` block.
- **Per-page CSS/JS are static files** in `public/assets/` (`page-<name>.css/js`), linked
  via `@push('head')` / `@push('scripts')`. Kept out of Blade so inline `@media`/`@keyframes`
  and JS never hit the Blade compiler. `site.js` (shared chrome) loads first and defines
  `reduce`; page scripts rely on it — keep load order (layout `site.js` before `@stack`).
- **The estimate lead form** posts to `POST /estimate/lead` (`LeadController`). It needs
  `@csrf` in the form (already present). Validation: `StoreLeadRequest`. Honeypot `_gotcha`.
  AJAX gets 422 JSON; no-JS gets a redirect + `session('lead_success')`. Unconfigured
  forwarder → logs to `storage/logs/leads.log`. Set `LEAD_FORWARDER_URL`/`_KEY` to forward.
- `bootstrap/app.php` returns JSON for exceptions when `api/*` **or** `$request->expectsJson()`
  — the latter is required so the AJAX form gets 422s instead of redirects.
- Asset/nav paths are **root-absolute** (`/assets/...`, `/services`) because clean URLs
  break root-relative paths. Keep new links root-absolute.
