# Solar Projects + Testimonials — Design

**Date:** 2026-06-23
**Division:** Evergreen Solar (`/solar`)
**Scope:** Enrich the `/solar/projects` page with real, spec'd installs and client
testimonials, and add a testimonials highlights strip to the `/solar` home page.

## Goal

The current `/solar/projects` page is a photo-only masonry with placeholder entries and
no proof. We have real data: four documented installs (with panel/inverter/battery specs
and photos) and three client reviews. Turn the page into credible proof of work — spec
cards that show engineering depth, plus testimonials — and surface a testimonial taste on
the solar home page.

## Source data

From `EVERGREEN WEBSITE/Untitled spreadsheet.xlsx` and its photo folders.

### Documented projects (full spec cards)

| Slug | Title | Location | System |
|------|-------|----------|--------|
| `sunlit-hostel` | Sunlit Hostel Siargao | Santa Ines, Catangnan, General Luna | 30× 585W bifacial (10yr) · 2× Growatt 10kVA hybrid inverter (5yr) · 4× Growatt LiFePO4 14.3kWh (10yr) |
| `filmegz-seaside` | Filmegz Seaside Homestay | Brgy. Garcia, Sta. Monica | 8× 625W bifacial (12yr) · 1× Growatt 6kVA off-grid inverter (5yr) · 1× Growatt smart LiFePO4 14.3kWh (10yr/6000 cycles) |
| `yugo-grill` | Yugo Grill and Restaurant | Sitio Tugbungan, National Highway, Siargao | 8× 630W bifacial (12yr) · 1× Growatt 6kVA inverter (5yr) · 1× Growatt LiFePO4 14.3kWh (10yr/6000 cycles) |
| `bamboo-surf` | Bamboo Surf Beach Resort | Pacifico, San Isidro, Siargao | 54× 715W bifacial (12yr) · 4× Growatt 10kVA inverter (5yr) · 8× Growatt LiFePO4 14.3kWh (10yr/6000 cycles) · 1yr free maintenance |

Each project folder holds 4–5 photos (Sunlit also has an `.mp4`, excluded for now —
images only in the lightbox).

### Photo-only extras (kept from current page, no specs)

Roxy (Dapa), Casa Cahuenga (Burgos), Garcia Overlooking Villa (Siargao Island) — render
as the existing card style with title + location only. (`filmegs-seaside.webp` and
`sunlit-hostel.webp` already in `public/assets/projects/` are superseded by the new
spec'd versions.)

### Testimonials (all shown 5★)

| Name | Quote (verbatim from spreadsheet) |
|------|-----------------------------------|
| James Gaffod | "I waited six months to write this to ensure everything held up…" (full text) |
| Melpe Salvacion | "Evergreen Solar is my first choice when i was planning to purchase a solar system…" (full text) |
| Antonio Altair | "I got a 5 kw hybrid system install with Evergreen. top quality…" (full text) |

## Architecture

Follows the project convention: **content is developer-edited in `config/`, looped in
Blade — no hardcoded markup.**

### `config/projects.php` (new)

```php
return [
    'projects' => [
        [
            'slug' => 'sunlit-hostel',
            'title' => 'Sunlit Hostel Siargao',
            'location' => 'Santa Ines, Catangnan, General Luna',
            'specs' => ['30× 585W bifacial panels', '2× Growatt 10kVA hybrid inverter', '4× Growatt 14.3kWh LiFePO4 battery'],
            'photos' => ['sunlit-hostel-1.webp', 'sunlit-hostel-2.webp', ...], // [0] is hero
        ],
        // ...filmegz-seaside, yugo-grill, bamboo-surf (with specs)...
        [
            'slug' => 'roxy-dapa',
            'title' => 'Roxy',
            'location' => 'Dapa, Siargao',
            'photos' => ['roxy-dapa.webp'], // no 'specs' key → photo-only card
        ],
        // ...casa-cahuenga, garcia-villa...
    ],
    'testimonials' => [
        ['name' => 'James Gaffod',   'stars' => 5, 'quote' => '...'],
        ['name' => 'Melpe Salvacion','stars' => 5, 'quote' => '...'],
        ['name' => 'Antonio Altair', 'stars' => 5, 'quote' => '...'],
    ],
];
```

A project is a **spec card** when `specs` is present, else a **photo-only card**.

### Controller

Both `/solar` and `/solar/projects` are served by `PageController@show` via its `PAGES`
map (`'solar' => ['solar.index','solar']`, `'solar-projects' => ['solar.projects','solar']`).
`show()` currently returns `view($view, ['meta' => ..., 'division' => ...])`. Add page-keyed
extra view data so the right config reaches each view without touching other pages — e.g. a
small `PAGE_DATA` map or inline switch:

- `solar-projects` → `'projects' => config('projects.projects')`,
  `'testimonials' => config('projects.testimonials')`
- `solar` → `'testimonials' => array_slice(config('projects.testimonials'), 0, 3)`

Keep the existing `meta`/`division` keys intact; other pages get no extra data.

### Views

- `resources/views/solar/projects.blade.php` — replace the hardcoded `.proj-masonry`
  block with a `@foreach` over projects. Spec cards add a `.pspecs` list; photo-only cards
  keep the current markup. Add a **testimonials section** (`@foreach` quote cards) between
  the gallery and the CTA band. Lightbox markup extended for prev/next.
- `resources/views/solar/index.blade.php` — add a 3-up testimonials highlights strip with
  a "Read more / see our work" link to `/solar/projects`.

Both keep their `@verbatim` static chrome but the data-driven loops live **outside**
`@verbatim` (Blade must parse `@foreach`/`{{ }}`). Inline `@`/mailto static blocks remain
verbatim.

### CSS / JS

- `public/assets/page-projects.css` — add `.pspecs` styling (mono eyebrow list, lime
  ticks), `.testimonials` section + `.tcard` quote-card styles, star row. Reuse existing
  `--lime/--panel/--paper` tokens and `.section`/`.shell`/`seam` patterns.
- `public/assets/page-projects.js` — extend the lightbox to accept a **photo set per
  card** (data attribute holds the project's photo list) and step prev/next with buttons +
  arrow keys; wrap-around; respects existing close behavior. Single-photo cards simply have
  no prev/next.
- `/solar` home strip styling: reuse `division`/home CSS where possible; add minimal
  testimonial-strip rules to the home page's CSS.

## Photo pipeline

Convert source JPG/JPEG to `.webp` into `public/assets/projects/`, named `<slug>-<n>.webp`
(hero = `-1`). **Photos are requested from the user just-in-time** — when a project's
finals are needed, ask for that project's images rather than auto-scanning folders. The
Sunlit `.mp4` is out of scope (images only).

## Out of scope (YAGNI)

- Video in the lightbox.
- Review screenshots / avatars (testimonials are text + name + stars).
- Per-project detail pages or routing.
- Any DB/CMS — content stays in `config/projects.php`.
- Touching other divisions.

## Testing

- Feature test: `/solar/projects` returns 200 and contains a spec'd project title
  (e.g. "Yugo Grill") and a testimonial name (e.g. "James Gaffod").
- Feature test: `/solar` returns 200 and contains a testimonial name.
- `php artisan view:clear` then manual check: spec cards render specs, photo-only cards
  don't; lightbox steps through a multi-photo project; home strip links to projects.
- Lighthouse pass on `/solar/projects` (images lazy-loaded, `.webp`).
```
