# ever-green.ph

Static marketing site for Evergreen Solar (two locations: Burgos, Siargao and
Nova Tierra, Davao City; copy is Siargao-focused). Plain HTML + one shared CSS
file + Python build tooling. **No framework — not Laravel.** Published via
GitHub Pages from `main` (root).

## Build
```bash
python3 build.py   # sync partials into all pages, then rebuild *.standalone.html
```
`build_standalone.py` only does the standalone bundling (inlines images + CSS as
data URIs); `build.py` is the full build and is the normal entry point.

## Structure
- 8 pages: index, services, estimate, projects, about, terms, privacy, accessibility
- `assets/site.css` — single shared stylesheet for every page
- `partials/header.html`, `partials/footer.html` — shared nav/footer (see gotcha)
- `*.standalone.html` — generated, gitignored build artifacts (don't hand-edit)
- `checkpoints/`, `original/` — design snapshots / scraped reference (not source)

## Gotchas
- **Header/footer are shared partials.** Edit `partials/header.html` /
  `partials/footer.html`, then run `python3 build.py` to sync into all 8 pages.
  Editing a page's nav/footer directly is overwritten on the next build. The
  region replaced on each page is between the
  `<!-- @partial:header -->…<!-- @endpartial:header -->` markers (footer
  equivalent too).
- A nav/footer change must land in the partial *and* be re-synced, or pages drift.
- `build.py` inserts markers on a marker-less page using hardcoded anchor strings
  (`NAV_COMMENT`, `MOBILE_END`, `FOOTER_COMMENT`, `FOOTER_CLOSE`). If a page's
  nav/footer HTML diverges from those anchors, sync silently no-ops with a
  `[warn] matched 0x`. Keep anchors in sync with the partials.
