# ever-green.ph

Redesign of the Evergreen Solar site — a high-performance static site for a
two-location solar installer (Siargao-focused copy; offices in Burgos, Siargao
and Davao City). Built around the brand's pinwheel logo palette
(deep forest green → electric lime).

## Structure

```
*.html                  # 8 pages (index, services, estimate, projects,
                        #   about, terms, privacy, accessibility)
assets/                 # logo, install photos, shared site.css
partials/               # header.html + footer.html, synced into every page
build.py                # full build: sync partials, then rebuild standalone copies
build_standalone.py     # bundles images + CSS into one portable file per page
checkpoints/            # saved design snapshots
original/               # the original Wix site, scraped (reference)
  scrape_mirror.py
  mirror/               # (gitignored)
```

## View locally

```bash
open -a "Google Chrome" index.html
```

## Published site

Served via GitHub Pages from `main` (root):
**https://coral-garden.github.io/ever-green.ph/**

## Build a single portable file

For emailing or moving without the `assets/` folder, inline every image as
base64 into one self-contained HTML file:

```bash
python3 build_standalone.py   # → index.standalone.html
```
