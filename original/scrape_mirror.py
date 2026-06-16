#!/usr/bin/env python3
"""
Static mirror scraper for ever-green.ph homepage.
Downloads HTML + all linked assets (CSS, JS, images, fonts).
"""

import os
import re
import time
import urllib.request
import urllib.parse
from pathlib import Path
from bs4 import BeautifulSoup

BASE_URL = "https://www.ever-green.ph/"
OUT_DIR = Path("mirror")
HEADERS = {
    "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8",
    "Accept-Language": "en-US,en;q=0.5",
}

downloaded = set()

def url_to_local_path(url, base_url=BASE_URL):
    parsed = urllib.parse.urlparse(url)
    # For absolute URLs on same domain, strip the scheme+host
    if parsed.netloc and parsed.netloc not in ("www.ever-green.ph", "ever-green.ph"):
        # External resource — store under _external/<host>/path
        safe_host = re.sub(r'[^\w.-]', '_', parsed.netloc)
        path_part = parsed.path.lstrip("/") or "index.html"
        if parsed.query:
            path_part += "?" + parsed.query
        path_part = re.sub(r'[?*<>|"]', '_', path_part)
        return OUT_DIR / "_external" / safe_host / path_part
    else:
        path_part = parsed.path.lstrip("/") or "index.html"
        if not path_part or path_part.endswith("/"):
            path_part = path_part + "index.html"
        return OUT_DIR / path_part

def fetch(url):
    if url in downloaded:
        return None
    downloaded.add(url)
    try:
        req = urllib.request.Request(url, headers=HEADERS)
        with urllib.request.urlopen(req, timeout=15) as resp:
            content_type = resp.headers.get("Content-Type", "")
            data = resp.read()
            return data, content_type
    except Exception as e:
        print(f"  [skip] {url}: {e}")
        return None

def save(path: Path, data: bytes):
    path.parent.mkdir(parents=True, exist_ok=True)
    path.write_bytes(data)

def resolve(href, page_url):
    if href.startswith("data:") or href.startswith("javascript:") or href.startswith("#"):
        return None
    return urllib.parse.urljoin(page_url, href)

def scrape_css_urls(css_text, css_url):
    urls = re.findall(r'url\(["\']?([^"\')\s]+)["\']?\)', css_text)
    return [resolve(u, css_url) for u in urls if resolve(u, css_url)]

def download_asset(url):
    result = fetch(url)
    if not result:
        return
    data, ct = result
    local = url_to_local_path(url)
    save(local, data)
    print(f"  [asset] {url} -> {local}")
    # If CSS, recurse into url() references
    if "css" in ct or url.endswith(".css"):
        for sub_url in scrape_css_urls(data.decode("utf-8", errors="replace"), url):
            download_asset(sub_url)

def main():
    OUT_DIR.mkdir(exist_ok=True)
    print(f"Fetching homepage: {BASE_URL}")
    result = fetch(BASE_URL)
    if not result:
        print("Failed to fetch homepage.")
        return

    html_bytes, _ = result
    soup = BeautifulSoup(html_bytes, "html.parser")

    asset_urls = []

    # CSS <link>
    for tag in soup.find_all("link", rel=lambda r: r and "stylesheet" in r):
        href = tag.get("href")
        if href:
            u = resolve(href, BASE_URL)
            if u:
                asset_urls.append(u)

    # <script src>
    for tag in soup.find_all("script", src=True):
        u = resolve(tag["src"], BASE_URL)
        if u:
            asset_urls.append(u)

    # <img src> + srcset
    for tag in soup.find_all("img"):
        for attr in ("src", "data-src", "data-lazy-src"):
            u = resolve(tag.get(attr, ""), BASE_URL)
            if u:
                asset_urls.append(u)
        srcset = tag.get("srcset", "")
        for part in srcset.split(","):
            parts = part.strip().split()
            if parts:
                u = resolve(parts[0], BASE_URL)
                if u:
                    asset_urls.append(u)

    # <source srcset> (picture elements, video)
    for tag in soup.find_all("source"):
        for attr in ("src", "srcset"):
            val = tag.get(attr, "")
            for part in val.split(","):
                parts = part.strip().split()
                if parts:
                    u = resolve(parts[0], BASE_URL)
                    if u:
                        asset_urls.append(u)

    # Background images in style attributes
    for tag in soup.find_all(style=True):
        for u in scrape_css_urls(tag["style"], BASE_URL):
            asset_urls.append(u)

    # Inline <style> blocks
    for tag in soup.find_all("style"):
        for u in scrape_css_urls(tag.get_text(), BASE_URL):
            asset_urls.append(u)

    # favicon
    for tag in soup.find_all("link", rel=lambda r: r and any(x in r for x in ("icon", "shortcut"))):
        u = resolve(tag.get("href", ""), BASE_URL)
        if u:
            asset_urls.append(u)

    # Download all assets
    print(f"\nDownloading {len(asset_urls)} discovered assets...")
    for url in asset_urls:
        if url:
            download_asset(url)
            time.sleep(0.05)

    # Save the HTML last (after collecting asset list)
    index_path = OUT_DIR / "index.html"
    save(index_path, html_bytes)
    print(f"\n[done] Homepage saved to {index_path}")
    print(f"[done] Total assets downloaded: {len(downloaded) - 1}")

if __name__ == "__main__":
    main()
