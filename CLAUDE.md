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

## Divisions (umbrella IA)
Evergreen is a **parent group** of co-equal divisions in this single app:
- **`/`** — neutral Evergreen group home (brand intro + division cards; carries the JSON-LD).
- **Evergreen Solar** — `/solar`, `/solar/services`, `/solar/estimate`, `/solar/projects`.
- **Evergreen Frame Construction** — `/construction` (steel-frame building *service*; no price list).
- **Evergreen Hardware Supply** — `/hardware` (building-materials price list lives here).
- **Group-level pages** (cover all divisions): `/about`, `/contact`, `/terms`, `/privacy`,
  `/accessibility`.

Note the split: Frame Construction is the **building service**; Hardware Supply is the
**materials store**. Don't put the price list under construction.

All divisions share the layout, header/footer (nav = Solar · Construction · Hardware ·
About · Contact), logo, and contacts. Catalog/product data is **developer-edited in
`config/catalog.php`** keyed by division (e.g. `catalog.hardware.materials`) — no DB, no CMS;
change a price, push, deploy. Leads from any division post to one endpoint
(`POST /estimate/lead`) and flow through the one pipeline tagged by a `division` field
(defaults to `solar`). Old URLs (`/services`, `/estimate`, `/construction/materials`, all
`*.html`) are kept alive via 301s in `routes/web.php`. Design spec: `docs/superpowers/specs/`.

The **header is division-aware**: each controller passes a `division` context
(`group`/`solar`/`construction`/`hardware`) to the view; `layouts/app.blade.php` forwards it
to `<x-site.header>`, which reads `config/divisions.php` for that division's wordmark
sub-label, nav links, and CTA. The "Evergreen" wordmark always returns to the group portal
(`/`); the sub-label (e.g. "Solar") shows the current sub-site. So Solar shows its own nav
(Services/Estimate/Projects), Construction/Hardware show theirs, and `/` is the chooser.

Light-background division pages (group home, construction, hardware, contact) load the
shared **`public/assets/division.css`**, which forces the fixed nav solid + clears its height
(Solar pages open on a dark hero, so they don't need it). Reuse `.ec-hero`, `.ec-cards`,
`.ec-table`, `.ec-card-link` from there.

**To add a division:**
1. `config/catalog.php` — add `catalog.<slug>` data (if it has a catalog/price list).
2. `app/Http/Controllers/<Name>Controller.php` — pass `config('site.meta.<slug>')`, data,
   and a `'division' => '<slug>'` context.
3. `routes/web.php` — add `GET /<slug>` (named) + any 301s for moved URLs.
4. `config/site.php` — add a `<slug>` meta block; `config/divisions.php` — add the division's
   wordmark label, nav links, and CTA.
5. `resources/views/<slug>/*.blade.php` — `@extends('layouts.app')`; `@push('head')` the
   `division.css` link (and `@verbatim` any inline JSON-LD).
6. `components/site/header.blade.php` + footer — add the nav link (desktop + mobile).
7. `public/sitemap.xml` — add the new URLs. Add feature tests; check Lighthouse.

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
