#!/usr/bin/env bash

set -euo pipefail

readonly project_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
readonly source_dir="${project_root}/public/assets/projects"
readonly output_dir="${source_dir}/responsive"

if ! command -v magick >/dev/null 2>&1 || ! command -v identify >/dev/null 2>&1; then
  echo "ImageMagick commands 'magick' and 'identify' are required." >&2
  exit 1
fi

mkdir -p "${output_dir}"

for source_path in "${source_dir}"/*.webp; do
  readonly_width="$(identify -format '%w' "${source_path}")"
  source_name="$(basename "${source_path}" .webp)"

  for target_width in 480 960; do
    if (( readonly_width > target_width )); then
      magick "${source_path}" \
        -auto-orient \
        -resize "${target_width}x>" \
        -strip \
        -quality 78 \
        -define webp:method=6 \
        "${output_dir}/${source_name}-${target_width}.webp"
    fi
  done
done

echo "Responsive project images written to ${output_dir}"
