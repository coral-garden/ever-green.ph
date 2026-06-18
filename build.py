#!/usr/bin/env python3
"""
Site build: sync shared partials (header / footer) into every page, then
regenerate the self-contained *.standalone.html copies.

Header and footer live ONCE in partials/header.html and partials/footer.html.
Each page carries  <!-- @partial:header --> … <!-- @endpartial:header -->  (and
the footer equivalent) marker comments; this script rewrites whatever is between
them with the current partial. On a page that has no markers yet, they are
inserted automatically around the existing NAV/FOOTER blocks (one-time).

Workflow:  edit partials/header.html (or any page's own content), then run:
    python3 build.py
"""
import re
from pathlib import Path
import build_standalone  # reuse its PAGES list + standalone builder

HERE = Path(__file__).resolve().parent

# Anchors used to insert markers the first time a page is processed.
NAV_COMMENT    = "  <!-- ===================== NAV ===================== -->"
MOBILE_END     = ('    <div class="mm-foot">Nova Tierra, Davao City · 0966 305 1461</div>\n'
                  "  </div>")
FOOTER_COMMENT = "  <!-- ===================== FOOTER ===================== -->"
FOOTER_CLOSE   = "  </footer>"

PARTS = {
    "header": re.compile(r"<!-- @partial:header -->.*?<!-- @endpartial:header -->", re.S),
    "footer": re.compile(r"<!-- @partial:footer -->.*?<!-- @endpartial:footer -->", re.S),
}


def ensure_markers(html):
    """Wrap the existing header/footer in marker comments if not already present."""
    if "@partial:header" not in html:
        html = html.replace(NAV_COMMENT, "  <!-- @partial:header -->\n" + NAV_COMMENT, 1)
        html = html.replace(MOBILE_END, MOBILE_END + "\n  <!-- @endpartial:header -->", 1)
    if "@partial:footer" not in html:
        html = html.replace(FOOTER_COMMENT, "  <!-- @partial:footer -->\n" + FOOTER_COMMENT, 1)
        html = html.replace(FOOTER_CLOSE, FOOTER_CLOSE + "\n  <!-- @endpartial:footer -->", 1)
    return html


def sync_partials(page):
    path = HERE / page
    html = ensure_markers(path.read_text(encoding="utf-8"))
    for name, pattern in PARTS.items():
        content = (HERE / "partials" / f"{name}.html").read_text(encoding="utf-8").rstrip("\n")
        repl = f"<!-- @partial:{name} -->\n{content}\n  <!-- @endpartial:{name} -->"
        html, n = pattern.subn(lambda m: repl, html)
        if n != 1:
            print(f"  [warn] {page}: {name} matched {n}x (expected 1) — check markers/anchors")
    path.write_text(html, encoding="utf-8")
    print(f"  [synced] {page}")


if __name__ == "__main__":
    print("[partials] syncing header/footer into pages")
    for page in build_standalone.PAGES:
        sync_partials(page)
    print("\n[standalone] rebuilding self-contained copies")
    for page in build_standalone.PAGES:
        build_standalone.build(page)
