#!/usr/bin/env python3
"""
Build fully self-contained copies of the site's HTML pages. For each page,
every local image (src="assets/...") is inlined as a base64 data URI and every
local stylesheet (<link rel="stylesheet" href="assets/*.css">) is inlined as a
<style> block. The output (*.standalone.html) needs no assets/ folder, so it
renders anywhere — Dropbox web, email, a moved file.

Usage:  python3 build_standalone.py
"""
import base64
import mimetypes
import re
from pathlib import Path

HERE = Path(__file__).resolve().parent
PAGES = ["index.html", "estimate.html"]


def inline_images(html, cache):
    def repl(match):
        quote, path = match.group(1), match.group(2)
        if path not in cache:
            f = HERE / path
            if not f.exists():
                print(f"  [warn] missing {path} — left as-is")
                cache[path] = f'src={quote}{path}{quote}'
            else:
                mime = mimetypes.guess_type(f.name)[0] or "application/octet-stream"
                b64 = base64.b64encode(f.read_bytes()).decode("ascii")
                cache[path] = f'src={quote}data:{mime};base64,{b64}{quote}'
                print(f"  [inlined img] {path}  ({f.stat().st_size // 1024} KB)")
        return cache[path]

    return re.sub(r'src=(["\'])(assets/[^"\']+)\1', repl, html)


def inline_css(html):
    # match any <link ... href="assets/xxx.css" ...> (attribute order-independent)
    def repl(match):
        tag = match.group(0)
        href = re.search(r'href=(["\'])(assets/[^"\']+\.css)\1', tag)
        if not href:
            return tag
        path = href.group(2)
        f = HERE / path
        if not f.exists():
            print(f"  [warn] missing {path} — left as-is")
            return tag
        css = f.read_text(encoding="utf-8")
        print(f"  [inlined css] {path}  ({f.stat().st_size // 1024} KB)")
        return f"<style>\n{css}\n</style>"

    return re.sub(r'<link\b[^>]*\bhref=["\']assets/[^"\']+\.css["\'][^>]*>', repl, html)


def build(page):
    src = HERE / page
    out = HERE / page.replace(".html", ".standalone.html")
    print(f"[build] {page}")
    html = src.read_text(encoding="utf-8")
    html = inline_css(html)
    html = inline_images(html, cache={})
    out.write_text(html, encoding="utf-8")
    print(f"  [done] {out.name}  ({out.stat().st_size // 1024} KB, self-contained)\n")


if __name__ == "__main__":
    for page in PAGES:
        build(page)
