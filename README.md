# ever-green.ph

Marketing site for Evergreen Solar — a two-location solar installer (Siargao-focused
copy; offices in Burgos, Siargao and Nova Tierra, Davao City). Built around the
brand's pinwheel-logo palette (deep forest green → electric lime).

**Laravel** application (migrated from a static HTML build in June 2026). Server-rendered
Blade pages with clean URLs; the only dynamic piece today is the estimate/lead form.

## Requirements

- PHP 8.2+
- Composer

No Node/npm build step — CSS and JS are plain static files in `public/assets/`.

## Structure

```
routes/web.php                     # 8 page routes + lead POST + .html 301 redirects
app/Http/Controllers/
  PageController.php                # serves the 8 pages with per-page <head> meta
  LeadController.php                # estimate lead endpoint (validate → forward)
app/Http/Requests/StoreLeadRequest.php
app/Services/Leads/                # LeadForwarder interface + Log/Http implementations
config/site.php                    # per-page <head> meta (title, description, OG, canonical)
resources/views/
  layouts/app.blade.php            # shared <head> + header/footer + @stack hooks
  components/site/{header,footer}.blade.php
  pages/*.blade.php                # the 8 pages (content only)
  partials/jsonld-home.blade.php   # homepage structured data
public/
  assets/                          # site.css, site.js, per-page css/js, images
  sitemap.xml, robots.txt
checkpoints/, original/            # design snapshots / scraped reference (not served)
```

## Run locally

```bash
composer install
cp .env.example .env && php artisan key:generate   # first time only
php artisan serve                                   # http://127.0.0.1:8000
```

## The estimate lead form

`POST /estimate/lead` validates the submission, drops honeypot spam, and emails the lead
to `LEAD_MAIL_TO`. If the external lead API is configured, email becomes the fallback
for failed API deliveries. To forward to the API, set in `.env`:

```
LEAD_FORWARDER_URL=https://example.com/leads
LEAD_FORWARDER_KEY=...        # optional bearer token
```

## Deploy (host-agnostic)

Point the web root at `public/`, then:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate          # if APP_KEY not set
php artisan config:cache route:cache view:cache
```

Set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://www.ever-green.ph`.
Ensure `storage/` is writable. Final cut-over: repoint the `www.ever-green.ph` DNS to the
new host and disable the old GitHub Pages serving.
