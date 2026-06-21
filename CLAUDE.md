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

## Divisions (umbrella structure)
Evergreen is one brand with multiple business divisions in this single app. **Solar is the
flagship and owns `/`** and its existing pages. Other divisions live under a slug
(e.g. **Frame Construction** at `/construction`, `/construction/materials`). All divisions
share the layout, header/footer, logo, and contacts. Catalog/product data is
**developer-edited in `config/catalog.php`** (no DB, no CMS) — change a price, push, deploy.
Leads from any division flow through the one pipeline tagged by a `division` field
(defaults to `solar`). Design spec: `docs/superpowers/specs/`.

**To add a division** (repeat the Construction pattern):
1. `config/catalog.php` — add the division's data (if it has a catalog/price list).
2. `app/Http/Controllers/<Name>Controller.php` — pass `config('site.meta.<slug>')` + data to views.
3. `routes/web.php` — add `GET` routes named by slug.
4. `config/site.php` — add a `<slug>` (and any sub-page) meta block.
5. `resources/views/<slug>/*.blade.php` — landing + sub-pages (`@extends('layouts.app')`).
6. `public/assets/page-<slug>.css` — division styles, `@push('head')` in its views.
   Note: if the page opens on a **light** background (Solar pages open on a dark hero),
   force the fixed nav solid in that CSS (`.nav { background: rgba(7,25,15,.92); … }`) and
   add top padding to clear it — otherwise the white nav text fails contrast.
7. `components/site/header.blade.php` — add the nav link (desktop + mobile).
8. `public/sitemap.xml` — add the new URLs. Add feature tests; check Lighthouse.

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
