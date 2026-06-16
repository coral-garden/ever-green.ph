#!/usr/bin/env python3
"""
Build a fully self-contained copy of index.html with every local image
inlined as a base64 data URI. The output (index.standalone.html) needs no
assets/ folder, so it renders anywhere — Dropbox web, email, a moved file.

Usage:  python3 redesign/build_standalone.py
"""
import base64
import mimetypes
import re
from pathlib import Path

HERE = Path(__file__).resolve().parent
SRC = HERE / "index.html"
OUT = HERE / "index.standalone.html"

html = SRC.read_text(encoding="utf-8")

# inline every src="assets/..." reference
cache = {}
def inline(match):
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
            print(f"  [inlined] {path}  ({f.stat().st_size//1024} KB)")
    return cache[path]

html = re.sub(r'src=(["\'])(assets/[^"\']+)\1', inline, html)

OUT.write_text(html, encoding="utf-8")
print(f"\n[done] {OUT.name}  ({OUT.stat().st_size//1024} KB, fully self-contained)")
