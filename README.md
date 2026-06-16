# ever-green.ph

Redesign of the Evergreen Solar Mindanao homepage — a high-performance,
single-file static site built around the brand's pinwheel logo palette
(deep forest green → electric lime).

## Structure

```
index.html              # the site (relative links to assets/)
assets/                 # logo + real install photos
build_standalone.py     # bundles images into one portable file
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
