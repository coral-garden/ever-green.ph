# Evergreen multi-division structure — design

## Revision (2026-06-22): group-home IA
The IA below was revised after launch once the divisions were understood as **co-equal peers**
(Evergreen Solar, Evergreen Frame Construction, Evergreen Hardware Supply), not Solar-with-sub-sections.
Changes now implemented:
- `/` is a **neutral Evergreen group home**; Solar moved to `/solar/*` (301s from old URLs).
- The building-materials price list belongs to **Hardware Supply** (`/hardware`), **not** Frame
  Construction. Frame Construction (`/construction`) is the steel-frame building service only.
- About/Contact/legal are **group-level** (`/about`, `/contact`, `/terms`, `/privacy`, `/accessibility`).
- `config/catalog.php` key renamed `construction` → `hardware`; shared `division.css` replaces
  `page-construction.css`. See CLAUDE.md "Divisions (umbrella IA)" for the current recipe.

The sections below are the original (Solar-flagship) design, kept for history.

## Context
`ever-green.ph` is a Laravel 13 app (migrated from static HTML in June 2026) currently
serving one business: **Evergreen Solar**. The company is expanding into more business
lines under the same brand — first **Evergreen Frame Construction** (building materials +
construction), with more divisions to follow. All divisions share one brand identity:
the pinwheel logo, the same phone numbers, `simonphconsult@gmail.com`, and the Burgos,
Siargao base.

This design establishes how multiple divisions live in the one app, and implements the
first new division (Frame Construction) as the worked example.

## Decisions (confirmed)
- **One umbrella, one Laravel app, one domain.** Not separate sites/subdomains.
- **Solar stays at `/`** (flagship, unchanged URLs/SEO). Divisions live under a slug
  (`/construction`, …).
- **Content is developer-edited in code** (no CMS, no admin panel). Statamic considered
  and declined for now.
- **No database.** File-based sessions/cache (already configured); catalog data lives in
  a PHP config file.
- Reuse the existing shared layout, header/footer components, bespoke CSS, and the
  lead-form pipeline. This is additive — nothing about the Solar deploy changes.

## Architecture

### Routing (`routes/web.php`)
Solar routes unchanged. Add a Construction section:
```
/construction              ConstructionController@index      name: construction
/construction/materials    ConstructionController@materials  name: construction.materials
```
Quotes reuse the existing lead pipeline (see Leads). Future divisions follow the same
slug pattern.

### Views
```
resources/views/
  layouts/app.blade.php            # unchanged (shared head + chrome + stacks)
  components/site/header.blade.php  # add a division switcher to the nav
  components/site/footer.blade.php  # (optional) add division links
  pages/*.blade.php                # existing Solar pages (unchanged)
  construction/
    index.blade.php                # division landing
    materials.blade.php            # price-list table
```
Per-page meta continues via `config/site.php` + the page's controller, same as Solar.

### Catalog data (`config/catalog.php`)
Dev-edited, no DB. Structured per division so future divisions extend it:
```php
return [
  'construction' => [
    'materials' => [
      ['item' => 'Silk-8 Phenolic Board', 'thickness' => '18mm',  'price' => 1400],
      ['item' => 'Shera Cement Board',     'thickness' => '4.5mm', 'price' => 595],
      ['item' => 'Shera Cement Board',     'thickness' => '9.0mm', 'price' => 1500],
      ['item' => 'Shera Cement Board',     'thickness' => '12mm',  'price' => 1900],
      ['item' => 'Marine Plywood',         'thickness' => '9mm',   'price' => 900],
      ['item' => 'Marine Plywood',         'thickness' => '17mm',  'price' => 1400],
      ['item' => 'Rockwool',               'thickness' => null,    'price' => 1075],
      ['item' => 'SPC Flooring',           'thickness' => null,    'price' => 220],
    ],
  ],
];
```
`materials.blade.php` renders this as a styled table; prices formatted as PHP pesos.
Includes the "prices subject to change" note and the pickup location (Burgos).

### Leads / quotes
Generalize the existing pipeline rather than add a second one:
- Add an optional hidden `division` field (`solar` | `construction`) to lead submissions.
- `StoreLeadRequest` accepts it (`nullable|string`); `LeadController` includes it in the
  payload; `LeadForwarder` tags the lead so enquiries are attributable by division.
- Construction's landing/materials pages link to a quote CTA. Simplest first cut: reuse
  the Solar estimate/contact path, or a lightweight construction quote form posting to the
  same `POST /estimate/lead` with `division=construction`. (Plan decides the minimal form.)

### Shared brand layer
- Header gets a small **division switcher** (e.g. `Solar ▾  Construction`). Logo links to
  `/`. Footer optionally lists divisions.
- No separate "Evergreen group" homepage yet — added later only if divisions become equal
  peers. Solar remains the front door.

## Styling
Reuse the existing bespoke `site.css` design tokens and component classes. Add a small
`public/assets/page-construction.css` only if the materials table/landing needs styles not
already covered (table styling, division landing hero). No Tailwind, no build step.

## Out of scope (deferred)
- Admin/CMS for self-service editing (Statamic or Filament) — revisit if editing frequency
  or editor count grows.
- A neutral Evergreen group homepage.
- Database-backed catalog, inventory, e-commerce/checkout.
- Additional divisions beyond Construction (structure supports them; not built yet).

## Verification
- `/construction` and `/construction/materials` return 200; render with shared header/footer.
- Materials table matches the source price list (8 items, correct thicknesses/prices,
  peso formatting, "subject to change" + Burgos pickup note).
- Division switcher appears in the nav on all pages and links correctly; Solar pages and
  URLs unchanged (existing routes/redirects still pass).
- A construction quote submission flows through the lead pipeline tagged
  `division=construction` (logged to `storage/logs/leads.log` when forwarder unconfigured).
- Feature tests for the new routes + the `division` field on leads; existing tests stay green.
- Lighthouse on `/construction` holds near the site's existing scores.
```
