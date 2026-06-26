# Solar Projects + Testimonials Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Turn `/solar/projects` into spec'd proof-of-work cards plus a client testimonials section, and add a testimonials strip to the `/solar` home page — all driven by a new `config/projects.php`.

**Architecture:** Content lives in `config/projects.php` (projects + testimonials arrays), matching the project's "developer-edited config, looped in Blade" convention. `PageController@show` passes the config to the two solar views. Blade loops render spec cards / photo-only cards / quote cards. A rewritten `page-projects.js` lightbox steps through each project's photo set.

**Tech Stack:** Laravel 11 (PHP 8.2+), Blade, PHPUnit feature tests, plain static CSS/JS in `public/assets/`. No Node build.

## Global Constraints

- No DB/CMS — all content in `config/projects.php`.
- Asset/nav paths are root-absolute (`/assets/...`, `/solar/...`).
- Blade loops/`{{ }}` must live OUTSIDE `@verbatim` blocks; static `@`/mailto chrome stays inside `@verbatim`.
- Per-page CSS/JS are static files in `public/assets/` linked via `@push`. No inline `@media`/`@keyframes` in Blade.
- Testimonial quotes are verbatim from the spreadsheet (emojis/curly quotes preserved). All three render 5★.
- A project is a **spec card** when it has a `specs` key; otherwise a **photo-only card**.
- Run `php artisan view:clear` after Blade edits before manual checks.

---

### Task 1: `config/projects.php` data file

**Files:**
- Create: `config/projects.php`
- Test: `tests/Feature/SolarProjectsConfigTest.php`

**Interfaces:**
- Produces: `config('projects.projects')` → array of project arrays. Spec projects have keys `slug, title, location, specs (string[]), photos (string[])`. Photo-only projects have `slug, title, location, photos` (no `specs`). `photos[0]` is the hero filename (relative to `assets/projects/`).
- Produces: `config('projects.testimonials')` → array of `['name'=>string,'stars'=>int,'quote'=>string]`.

- [ ] **Step 1: Write the failing test**

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarProjectsConfigTest extends TestCase
{
    public function test_projects_config_has_spec_and_photo_only_entries(): void
    {
        $projects = config('projects.projects');

        $this->assertIsArray($projects);

        $bySlug = collect($projects)->keyBy('slug');

        // four documented installs carry specs
        foreach (['sunlit-hostel', 'filmegz-seaside', 'yugo-grill', 'bamboo-surf'] as $slug) {
            $this->assertArrayHasKey($slug, $bySlug, "missing project $slug");
            $this->assertNotEmpty($bySlug[$slug]['specs'], "$slug should have specs");
            $this->assertNotEmpty($bySlug[$slug]['photos'], "$slug should have photos");
        }

        // three placeholders kept as photo-only (no specs key)
        foreach (['roxy-dapa', 'casa-cahuenga', 'garcia-villa'] as $slug) {
            $this->assertArrayHasKey($slug, $bySlug, "missing extra $slug");
            $this->assertArrayNotHasKey('specs', $bySlug[$slug], "$slug should be photo-only");
        }
    }

    public function test_testimonials_config_has_three_five_star_quotes(): void
    {
        $testimonials = config('projects.testimonials');

        $this->assertCount(3, $testimonials);
        foreach ($testimonials as $t) {
            $this->assertNotEmpty($t['name']);
            $this->assertNotEmpty($t['quote']);
            $this->assertSame(5, $t['stars']);
        }
        $this->assertSame('James Gaffod', $testimonials[0]['name']);
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=SolarProjectsConfigTest`
Expected: FAIL — `config('projects.projects')` is null.

- [ ] **Step 3: Create the config file**

```php
<?php

// Developer-edited project + testimonial content for Evergreen Solar.
// A project with a 'specs' key renders as a spec card; without it, a photo-only card.
// photos[0] is the hero; the rest are stepped through in the lightbox.
// Filenames are relative to public/assets/projects/.

return [

    'projects' => [

        [
            'slug' => 'sunlit-hostel',
            'title' => 'Sunlit Hostel Siargao',
            'location' => 'Santa Ines, Catangnan, General Luna',
            'specs' => [
                '30× 585W bifacial panels · 10yr warranty',
                '2× Growatt 10kVA hybrid inverter · 5yr warranty',
                '4× Growatt 14.3kWh LiFePO4 battery · 10yr warranty',
            ],
            'photos' => [
                'sunlit-hostel-1.webp',
                'sunlit-hostel-2.webp',
                'sunlit-hostel-3.webp',
            ],
        ],

        [
            'slug' => 'filmegz-seaside',
            'title' => 'Filmegz Seaside Homestay',
            'location' => 'Brgy. Garcia, Sta. Monica, Siargao',
            'specs' => [
                '8× 625W bifacial panels · 12yr warranty',
                '1× Growatt 6kVA off-grid inverter · 5yr warranty',
                '1× Growatt smart 14.3kWh LiFePO4 battery · 10yr / 6000 cycles',
            ],
            'photos' => [
                'filmegz-seaside-1.webp',
                'filmegz-seaside-2.webp',
                'filmegz-seaside-3.webp',
            ],
        ],

        [
            'slug' => 'yugo-grill',
            'title' => 'Yugo Grill and Restaurant',
            'location' => 'Sitio Tugbungan, National Highway, Siargao',
            'specs' => [
                '8× 630W bifacial panels · 12yr warranty',
                '1× Growatt 6kVA inverter · 5yr warranty',
                '1× Growatt 14.3kWh LiFePO4 battery · 10yr / 6000 cycles',
            ],
            'photos' => [
                'yugo-grill-1.webp',
                'yugo-grill-2.webp',
                'yugo-grill-3.webp',
            ],
        ],

        [
            'slug' => 'bamboo-surf',
            'title' => 'Bamboo Surf Beach Resort',
            'location' => 'Pacifico, San Isidro, Siargao',
            'specs' => [
                '54× 715W bifacial panels · 12yr warranty',
                '4× Growatt 10kVA inverter · 5yr warranty',
                '8× Growatt 14.3kWh LiFePO4 battery · 10yr / 6000 cycles',
                '1 year free maintenance',
            ],
            'photos' => [
                'bamboo-surf-1.webp',
                'bamboo-surf-2.webp',
                'bamboo-surf-3.webp',
            ],
        ],

        // ---- photo-only extras (no specs available) ----
        [
            'slug' => 'roxy-dapa',
            'title' => 'Roxy',
            'location' => 'Dapa, Siargao',
            'photos' => ['roxy-dapa.webp'],
        ],
        [
            'slug' => 'casa-cahuenga',
            'title' => 'Casa Cahuenga',
            'location' => 'Burgos, Siargao',
            'photos' => ['casa-cahuenga.webp'],
        ],
        [
            'slug' => 'garcia-villa',
            'title' => 'Garcia Overlooking Villa',
            'location' => 'Siargao Island',
            'photos' => ['garcia-villa.webp'],
        ],

    ],

    'testimonials' => [
        [
            'name' => 'James Gaffod',
            'stars' => 5,
            'quote' => 'I waited six months to write this to ensure everything held up—and I can happily give a 5 ⭐ review! The product quality and service have been 100% reliable without a single issue. I’m incredibly grateful to Sir Simon and his team; they stepped in when we had no source of electricity and truly delivered. If you’re looking for a professional team and a system that lasts, I highly recommend them!',
        ],
        [
            'name' => 'Melpe Salvacion',
            'stars' => 5,
            'quote' => 'Evergreen Solar is my first choice when i was planning to purchase a solar system. And now! It’s very worth it! Beyond my expectation!🤩, and his Team very accommodating. Truly professional in this field! In just 2days everything is installed! What a Great Job!! 👏 im happy right now. No more stress due to fluctuations. This is a truly life saver and good investment specially to my Laundry Service and Homestay . 👌🤙 Thank you! Sir Simon and Sir Clinton and the rest of the Team! Until our next transaction. 😊🤙',
        ],
        [
            'name' => 'Antonio Altair',
            'stars' => 5,
            'quote' => 'I got a 5 kw hybrid system install with Evergreen. top quality, and the team know what they are doing. Specially impressed with the after sales support, very easy to talk with them. Highly recommended',
        ],
    ],

];
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter=SolarProjectsConfigTest`
Expected: PASS (2 tests).

- [ ] **Step 5: Commit**

```bash
git add config/projects.php tests/Feature/SolarProjectsConfigTest.php
git commit -m "feat: add config/projects.php with solar projects + testimonials"
```

---

### Task 2: Pass config data through PageController

**Files:**
- Modify: `app/Http/Controllers/PageController.php`
- Test: `tests/Feature/SolarPageDataTest.php`

**Interfaces:**
- Consumes: `config('projects.*')` from Task 1.
- Produces: view `solar.projects` receives `projects` (all) + `testimonials` (all); view `solar.index` receives `testimonials` (first 3). Existing `meta` + `division` keys unchanged. Other pages get no extra keys.

- [ ] **Step 1: Write the failing test**

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarPageDataTest extends TestCase
{
    public function test_projects_page_view_receives_projects_and_testimonials(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertOk();
        $response->assertViewHas('projects');
        $response->assertViewHas('testimonials');
    }

    public function test_solar_home_view_receives_testimonials(): void
    {
        $response = $this->get('/solar');
        $response->assertOk();
        $response->assertViewHas('testimonials');
    }

    public function test_other_pages_do_not_receive_projects(): void
    {
        $this->get('/about')->assertOk()->assertViewMissing('projects');
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=SolarPageDataTest`
Expected: FAIL — `projects`/`testimonials` not passed to views.

- [ ] **Step 3: Implement the controller change**

Replace the body of `show()` in `app/Http/Controllers/PageController.php` (lines 26-35) with:

```php
    public function show(string $page): View
    {
        if (! isset(self::PAGES[$page])) {
            throw new NotFoundHttpException();
        }

        [$view, $division] = self::PAGES[$page];

        $data = ['meta' => config("site.meta.$page"), 'division' => $division];

        if ($page === 'solar-projects') {
            $data['projects'] = config('projects.projects');
            $data['testimonials'] = config('projects.testimonials');
        } elseif ($page === 'solar') {
            $data['testimonials'] = array_slice(config('projects.testimonials'), 0, 3);
        }

        return view($view, $data);
    }
```

- [ ] **Step 4: Run test to verify it passes**

Run: `php artisan test --filter=SolarPageDataTest`
Expected: PASS (3 tests). (`/solar` and `/solar/projects` still render the OLD hardcoded views — that's fine; we only added view data.)

- [ ] **Step 5: Commit**

```bash
git add app/Http/Controllers/PageController.php tests/Feature/SolarPageDataTest.php
git commit -m "feat: pass projects/testimonials config to solar views"
```

---

### Task 3: Render spec cards + photo-only cards on the projects page

**Files:**
- Modify: `resources/views/solar/projects.blade.php`
- Test: `tests/Feature/SolarProjectsPageTest.php`

**Interfaces:**
- Consumes: `$projects` from Task 2. Each `.pcard` gets `data-title`, `data-loc`, and `data-photos` (comma-joined `/assets/projects/<file>` URLs) for the Task 5 lightbox.
- Produces: spec cards include a `.pspecs` list; photo-only cards do not.

- [ ] **Step 1: Write the failing test**

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarProjectsPageTest extends TestCase
{
    public function test_shows_documented_projects_with_specs(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertOk();
        $response->assertSee('Yugo Grill and Restaurant');
        $response->assertSee('Bamboo Surf Beach Resort');
        $response->assertSee('54× 715W bifacial panels · 12yr warranty');
        $response->assertSee('pspecs', false); // spec-card list class is rendered
    }

    public function test_shows_photo_only_extras(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertSee('Casa Cahuenga');
        $response->assertSee('Roxy');
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=SolarProjectsPageTest`
Expected: FAIL — old hardcoded page has no "Yugo Grill" / no `pspecs`.

- [ ] **Step 3: Replace the masonry block in the Blade**

In `resources/views/solar/projects.blade.php`, replace the whole `<div class="proj-masonry"> … </div>` block (lines 44-69) with a Blade loop. To do this, **close `@verbatim` before the loop and reopen it after**, so Blade parses the loop:

```blade
      @verbatim
      <div class="proj-masonry">
      @endverbatim

      @foreach ($projects as $p)
        @php $photoUrls = collect($p['photos'])->map(fn ($f) => '/assets/projects/'.$f)->implode(','); @endphp
        <button class="pcard reveal" data-title="{{ $p['title'] }}" data-loc="{{ $p['location'] }}" data-photos="{{ $photoUrls }}">
          <img src="/assets/projects/{{ $p['photos'][0] }}" alt="Solar installation at {{ $p['title'] }}, {{ $p['location'] }}" loading="lazy" />
          <div class="pmeta">
            <div class="ploc">{{ $p['location'] }}</div>
            <div class="ptitle">{{ $p['title'] }}</div>
            @if (!empty($p['specs']))
              <ul class="pspecs">
                @foreach ($p['specs'] as $spec)
                  <li>{{ $spec }}</li>
                @endforeach
              </ul>
            @endif
          </div>
        </button>
      @endforeach

      @verbatim
      </div>
      @endverbatim
```

(The surrounding `<section>`/`<div class="shell">`/`section-head` stay inside their existing `@verbatim`. Only the masonry grid becomes a loop. Confirm the file still has matching `@verbatim`/`@endverbatim` pairs and one `@endsection`.)

- [ ] **Step 4: Clear views and run the test**

Run: `php artisan view:clear && php artisan test --filter=SolarProjectsPageTest`
Expected: PASS (2 tests).

- [ ] **Step 5: Commit**

```bash
git add resources/views/solar/projects.blade.php tests/Feature/SolarProjectsPageTest.php
git commit -m "feat: render solar projects from config (spec + photo-only cards)"
```

---

### Task 4: Testimonials section on the projects page

**Files:**
- Modify: `resources/views/solar/projects.blade.php`
- Test: `tests/Feature/SolarProjectsPageTest.php` (add a method)

**Interfaces:**
- Consumes: `$testimonials` from Task 2.
- Produces: a `<section class="section testimonials">` with `.tcard` quote cards, each with a `.tstars` row and `.tname`.

- [ ] **Step 1: Add the failing test method**

Add to `tests/Feature/SolarProjectsPageTest.php`:

```php
    public function test_shows_client_testimonials(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertSee('James Gaffod');
        $response->assertSee('Antonio Altair');
        $response->assertSee('tcard', false);  // testimonial card class rendered
        $response->assertSee('tstars', false); // star row rendered
    }
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=SolarProjectsPageTest::test_shows_client_testimonials`
Expected: FAIL — no `tcard` on the page.

- [ ] **Step 3: Insert the testimonials section**

In `resources/views/solar/projects.blade.php`, insert this block **between** the end of the gallery `</section>` and the start of the `<!-- ===== CTA ===== -->` section. The gallery section ends inside `@verbatim`; close it, add the Blade section, reopen `@verbatim` for the CTA. Concretely, place this right before the `<!-- ===================== CTA ===================== -->` comment:

```blade
      @verbatim
      <!-- ===================== TESTIMONIALS ===================== -->
      @endverbatim
      <section class="section testimonials">
        <div class="shell">
          <div class="section-head reveal">
            <div class="lead">
              <div class="tag tag-dot">What clients say</div>
              <h2>Trusted across the island</h2>
            </div>
            <p class="kicker">Real words from homeowners and businesses now running on Evergreen solar.</p>
          </div>
          <div class="tgrid">
            @foreach ($testimonials as $t)
              <figure class="tcard reveal">
                <div class="tstars" aria-label="{{ $t['stars'] }} out of 5 stars">{!! str_repeat('★', $t['stars']) !!}</div>
                <blockquote>{{ $t['quote'] }}</blockquote>
                <figcaption class="tname">{{ $t['name'] }}</figcaption>
              </figure>
            @endforeach
          </div>
        </div>
      </section>
      @verbatim
      @endverbatim
```

(The trailing empty `@verbatim`/`@endverbatim` is just to re-open verbatim context for the CTA section that follows; if the CTA section already begins with its own markup inside the existing verbatim block, ensure verbatim is open before it. Verify matching pairs after editing.)

- [ ] **Step 4: Clear views and run the test**

Run: `php artisan view:clear && php artisan test --filter=SolarProjectsPageTest`
Expected: PASS (3 tests).

- [ ] **Step 5: Commit**

```bash
git add resources/views/solar/projects.blade.php tests/Feature/SolarProjectsPageTest.php
git commit -m "feat: add client testimonials section to solar projects page"
```

---

### Task 5: Spec/testimonial CSS + multi-photo lightbox JS

**Files:**
- Modify: `public/assets/page-projects.css`
- Modify: `public/assets/page-projects.js`
- Test: `tests/Feature/SolarProjectsPageTest.php` (add a method)

**Interfaces:**
- Consumes: `.pcard[data-photos]` (comma-joined URLs) from Task 3; `.pspecs`, `.tcard`, `.tstars` from Tasks 3-4; existing `#lightbox`, `#lbImg`, `#lbCap`, `#lbClose`.
- Produces: lightbox prev/next buttons (`#lbPrev`, `#lbNext`) stepping through a card's photo set with wrap-around + arrow keys.

- [ ] **Step 1: Add the failing test method**

Add to `tests/Feature/SolarProjectsPageTest.php`:

```php
    public function test_cards_carry_photo_sets_for_the_lightbox(): void
    {
        $response = $this->get('/solar/projects');
        $response->assertSee('data-photos="/assets/projects/sunlit-hostel-1.webp', false);
    }
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=SolarProjectsPageTest::test_cards_carry_photo_sets_for_the_lightbox`
Expected: PASS already if Task 3 emitted `data-photos` — if so, this just locks the contract. If it FAILS, fix Task 3's `data-photos` output first.

- [ ] **Step 3: Add the prev/next buttons to the lightbox markup**

In `resources/views/solar/projects.blade.php`, inside the existing `@verbatim` lightbox block, add prev/next buttons next to `#lbClose` (before `<img id="lbImg">`):

```html
    <button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous photo">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>
    </button>
    <button class="lb-nav lb-next" id="lbNext" aria-label="Next photo">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg>
    </button>
```

- [ ] **Step 4: Append the CSS**

Append to `public/assets/page-projects.css`:

```css
  /* spec list inside project cards */
  .pcard .pspecs { list-style: none; margin: 8px 0 0; padding: 0; display: grid; gap: 3px; }
  .pcard .pspecs li {
    font-family: var(--font-mono); font-size: 11px; line-height: 1.45;
    letter-spacing: .02em; color: rgba(255,255,255,.92); padding-left: 14px; position: relative;
  }
  .pcard .pspecs li::before { content: ""; position: absolute; left: 0; top: 7px;
    width: 6px; height: 6px; border-radius: 50%; background: var(--lime); }

  /* testimonials */
  .testimonials { background: var(--paper); }
  .testimonials .tgrid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 18px; margin-top: 28px; }
  @media (max-width: 920px) { .testimonials .tgrid { grid-template-columns: 1fr; } }
  .tcard { margin: 0; padding: 22px; border-radius: var(--radius); border: 1px solid var(--line);
    background: var(--panel); display: flex; flex-direction: column; gap: 12px; }
  .tcard .tstars { color: var(--lime); font-size: 15px; letter-spacing: 2px; }
  .tcard blockquote { margin: 0; font-size: 15px; line-height: 1.6; color: var(--ink, inherit); }
  .tcard .tname { font-family: var(--font-display); font-weight: 700; letter-spacing: -0.01em; }

  /* lightbox nav */
  .lightbox .lb-nav { position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255,255,255,.08); border: 0; color: #fff; padding: 10px; border-radius: 50%; cursor: pointer; }
  .lightbox .lb-nav:hover { background: rgba(255,255,255,.18); }
  .lightbox .lb-nav svg { width: 26px; height: 26px; display: block; }
  .lightbox .lb-prev { left: 18px; }
  .lightbox .lb-next { right: 18px; }
  .lightbox.single .lb-nav { display: none; }
```

- [ ] **Step 5: Rewrite the lightbox JS**

Replace the entire contents of `public/assets/page-projects.js` with:

```js
  // ---- lightbox with per-card photo stepping ----
  const lb = document.getElementById('lightbox');
  const lbImg = document.getElementById('lbImg');
  const lbCap = document.getElementById('lbCap');
  const lbPrev = document.getElementById('lbPrev');
  const lbNext = document.getElementById('lbNext');

  let photos = [];
  let idx = 0;
  let cap = '';

  const render = () => {
    lbImg.src = photos[idx];
    lbImg.alt = cap;
    lbCap.innerHTML = cap + (photos.length > 1 ? ' <span class="lb-count">' + (idx + 1) + ' / ' + photos.length + '</span>' : '');
  };

  const openLb = (card) => {
    const list = (card.dataset.photos || '').split(',').filter(Boolean);
    const heroSrc = card.querySelector('img').src;
    photos = list.length ? list : [heroSrc];
    idx = 0;
    cap = '<b>' + card.dataset.title + '</b> — ' + card.dataset.loc;
    lb.classList.toggle('single', photos.length < 2);
    render();
    lb.classList.add('open');
    lb.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const closeLb = () => {
    lb.classList.remove('open');
    lb.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  const step = (delta) => {
    if (photos.length < 2) return;
    idx = (idx + delta + photos.length) % photos.length;
    render();
  };

  document.querySelectorAll('.pcard').forEach(card => card.addEventListener('click', () => openLb(card)));
  document.getElementById('lbClose').addEventListener('click', closeLb);
  lbPrev.addEventListener('click', (e) => { e.stopPropagation(); step(-1); });
  lbNext.addEventListener('click', (e) => { e.stopPropagation(); step(1); });
  lb.addEventListener('click', (e) => { if (e.target === lb) closeLb(); });
  document.addEventListener('keydown', (e) => {
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape') closeLb();
    else if (e.key === 'ArrowLeft') step(-1);
    else if (e.key === 'ArrowRight') step(1);
  });
```

- [ ] **Step 6: Clear views, run tests**

Run: `php artisan view:clear && php artisan test --filter=SolarProjectsPageTest`
Expected: PASS (4 tests).

- [ ] **Step 7: Commit**

```bash
git add public/assets/page-projects.css public/assets/page-projects.js resources/views/solar/projects.blade.php tests/Feature/SolarProjectsPageTest.php
git commit -m "feat: spec/testimonial styling + multi-photo lightbox"
```

---

### Task 6: Testimonials strip on the solar home page

**Files:**
- Modify: `resources/views/solar/index.blade.php`
- Modify: `public/assets/site.css` (testimonial-strip styles)
- Test: `tests/Feature/SolarHomeTest.php`

> NOTE: The solar home view links NO per-page CSS — all its styles (`.hero`, `.systems`, `.proj-grid`) live in the shared `public/assets/site.css`. Add the strip styles there, next to the existing home styles, rather than creating a new `page-home.css`.

**Interfaces:**
- Consumes: `$testimonials` from Task 2 (first 3).
- Produces: a `<section class="section home-testimonials">` strip with a link to `/solar/projects`.

- [ ] **Step 1: Write the failing test**

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class SolarHomeTest extends TestCase
{
    public function test_home_shows_testimonial_strip_linking_to_projects(): void
    {
        $response = $this->get('/solar');
        $response->assertOk();
        $response->assertSee('James Gaffod');
        $response->assertSee('home-testimonials', false);
        $response->assertSee('/solar/projects', false);
    }
}
```

- [ ] **Step 2: Run test to verify it fails**

Run: `php artisan test --filter=SolarHomeTest`
Expected: FAIL — no `home-testimonials` on `/solar`.

- [ ] **Step 3: Insert the strip + fix the "More projects" link**

In `resources/views/solar/index.blade.php`, the whole page is one `@verbatim` block. Insert the strip **between** the PROJECTS `</section>` (line 237) and the QUOTE section (line 239) by closing/reopening verbatim:

```blade
      @verbatim
      <!-- ===================== TESTIMONIALS STRIP ===================== -->
      @endverbatim
      <section class="section home-testimonials">
        <div class="shell">
          <div class="section-head reveal">
            <div class="lead">
              <div class="tag tag-dot">Client stories</div>
              <h2>Loved by island homes &amp; businesses</h2>
            </div>
            <p class="kicker">A few words from people already running on Evergreen solar.</p>
          </div>
          <div class="ht-grid">
            @foreach ($testimonials as $t)
              <figure class="ht-card reveal">
                <div class="ht-stars" aria-label="{{ $t['stars'] }} out of 5 stars">{!! str_repeat('★', $t['stars']) !!}</div>
                <blockquote>{{ $t['quote'] }}</blockquote>
                <figcaption>{{ $t['name'] }}</figcaption>
              </figure>
            @endforeach
          </div>
          <div style="margin-top:32px;" class="reveal">
            <a class="btn btn-ghost" href="/solar/projects">See our work
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      </section>
      @verbatim
      @endverbatim
```

Also update the existing "More projects" button (line 232) from `href="#contact"` to `href="/solar/projects"` so it points to the real gallery. (This edit is inside the existing `@verbatim` — just change the href string.)

- [ ] **Step 4: Append home-strip CSS**

Append to `public/assets/site.css` (shared file where the home styles already live):

```css
  /* home testimonials strip */
  .home-testimonials .ht-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin-top: 26px; }
  @media (max-width: 920px) { .home-testimonials .ht-grid { grid-template-columns: 1fr; } }
  .home-testimonials .ht-card { margin: 0; padding: 20px; border-radius: var(--radius);
    border: 1px solid var(--line); background: var(--panel); display: flex; flex-direction: column; gap: 10px; }
  .home-testimonials .ht-stars { color: var(--lime); letter-spacing: 2px; }
  .home-testimonials .ht-card blockquote { margin: 0; font-size: 14px; line-height: 1.6; }
  .home-testimonials .ht-card figcaption { font-family: var(--font-display); font-weight: 700; }
```

- [ ] **Step 5: Clear views, run the test**

Run: `php artisan view:clear && php artisan test --filter=SolarHomeTest`
Expected: PASS.

- [ ] **Step 6: Run the full suite**

Run: `php artisan test`
Expected: all green (existing tests + the new ones).

- [ ] **Step 7: Commit**

```bash
git add resources/views/solar/index.blade.php public/assets/site.css tests/Feature/SolarHomeTest.php
git commit -m "feat: add testimonials strip to solar home page"
```

---

### Task 7: Photo pipeline (interactive — needs user images)

**Files:**
- Create: `public/assets/projects/<slug>-<n>.webp` (per spec project)

**Interfaces:**
- Consumes: source images supplied by the user, per project, on request.
- Produces: the `.webp` files referenced in `config/projects.php` `photos` arrays.

> NOTE: This task is the only one needing real photos. Do it project-by-project, requesting images from the user as you go. The four documented installs (`sunlit-hostel`, `filmegz-seaside`, `yugo-grill`, `bamboo-surf`) each need 3 webps named `<slug>-1.webp` (hero) … `<slug>-3.webp`. The photo-only extras already have their webps in `public/assets/projects/`. If a project ends up with fewer/more than 3 photos, update that project's `photos` array in `config/projects.php` to match the actual files generated.

- [ ] **Step 1: Request the images for one project**

Ask the user to drop the photos for the first project (e.g. Sunlit Hostel). Confirm the source file paths.

- [ ] **Step 2: Convert to webp at the target names**

For each supplied image (example for Sunlit Hostel):

```bash
cwebp -q 82 -resize 1400 0 "<source-1>.jpg" -o public/assets/projects/sunlit-hostel-1.webp
cwebp -q 82 -resize 1400 0 "<source-2>.jpg" -o public/assets/projects/sunlit-hostel-2.webp
cwebp -q 82 -resize 1400 0 "<source-3>.jpg" -o public/assets/projects/sunlit-hostel-3.webp
```

(If `cwebp` is unavailable, use `magick "<source>" -resize 1400x -quality 82 public/assets/projects/<slug>-<n>.webp`. Verify the resulting file sizes are reasonable, < ~300KB each.)

- [ ] **Step 3: Reconcile config to actual files**

If the count differs from 3, edit that project's `photos` array in `config/projects.php` so every listed file exists and `photos[0]` is the chosen hero.

- [ ] **Step 4: Verify in the browser**

Run: `php artisan serve` and open `http://127.0.0.1:8000/solar/projects`. Confirm: the project's hero shows, the card lists specs, and the lightbox steps through all photos with prev/next + arrow keys.

- [ ] **Step 5: Repeat Steps 1-4 for the remaining documented projects, then commit**

```bash
git add public/assets/projects/ config/projects.php
git commit -m "feat: add real project photos for solar gallery"
```

---

## Self-Review

**Spec coverage:**
- `config/projects.php` (projects + testimonials) → Task 1. ✓
- Controller wiring → Task 2. ✓
- Spec cards / photo-only cards → Task 3. ✓
- Testimonials section on projects page → Task 4. ✓
- CSS + multi-photo lightbox → Task 5. ✓
- Home testimonials strip → Task 6. ✓
- Photo pipeline (just-in-time, per project) → Task 7. ✓
- Testing (feature tests on both routes, spec content, testimonial names) → Tasks 1-6. ✓
- Out-of-scope items (video, avatars, detail pages, DB) → not present. ✓

**Placeholder scan:** No TBD/TODO; every code step shows full content. Task 7 is intentionally interactive (needs user images) and says so explicitly rather than hiding work.

**Type consistency:** `data-photos` (comma-joined `/assets/projects/...`) is produced in Task 3 and consumed verbatim in Task 5. `specs`/`photos`/`testimonials[].stars` keys are consistent across Tasks 1→3→4→6. Class names (`pspecs`, `tcard`, `tstars`, `home-testimonials`) match between Blade, CSS, and the assertions.
