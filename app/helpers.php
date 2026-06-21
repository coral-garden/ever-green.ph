<?php

if (! function_exists('assetv')) {
    /**
     * Root-absolute asset URL with a cache-busting ?v=<mtime> query so browsers
     * always re-fetch a file after it changes (no Vite/build manifest in this app).
     */
    function assetv(string $path): string
    {
        $path = '/' . ltrim($path, '/');
        $full = public_path($path);

        return is_file($full) ? $path . '?v=' . filemtime($full) : $path;
    }
}
