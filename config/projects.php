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
            'equipment' => 'sunlit-hostel-3.webp',
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
            'equipment' => 'filmegz-seaside-4.webp',
            'photos' => [
                'filmegz-seaside-1.webp',
                'filmegz-seaside-2.webp',
                'filmegz-seaside-3.webp',
                'filmegz-seaside-4.webp',
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
            'equipment' => 'yugo-grill-4.webp',
            'photos' => [
                'yugo-grill-1.webp',
                'yugo-grill-2.webp',
                'yugo-grill-3.webp',
                'yugo-grill-4.webp',
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
            'equipment' => 'bamboo-surf-4.webp',
            'photos' => [
                'bamboo-surf-1.webp',
                'bamboo-surf-2.webp',
                'bamboo-surf-3.webp',
                'bamboo-surf-4.webp',
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
