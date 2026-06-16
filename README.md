# ever-green.ph

Redesign of the Evergreen Solar Mindanao homepage — a high-performance,
single-file static site built around the brand's pinwheel logo palette
(deep forest green → electric lime).

## Structure

```
redesign/
  index.html              # the site — edit this (relative links to assets/)
  assets/                 # logo + real install photos
  build_standalone.py     # bundles images into one portable file
  checkpoints/            # saved design snapshots
scrape_mirror.py          # script that pulled the original Wix site (reference)
```

## View locally

```bash
open -a "Google Chrome" redesign/index.html
```

## Published site

The `redesign/` site is served via GitHub Pages from the `gh-pages` branch.

## Build a single portable file

For emailing or moving without the `assets/` folder, inline every image as
base64 into one self-contained HTML file:

```bash
python3 redesign/build_standalone.py   # → redesign/index.standalone.html
```
