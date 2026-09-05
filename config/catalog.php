<?php

// Developer-edited product catalogs per division. No database — edit here, then deploy.
// Prices are in PHP pesos (whole numbers). `thickness` is null when not applicable.
return [

    'solar' => [
        // Transcribed from Evergreen's package flyers supplied on 6 September 2026.
        // All panel warranty durations set to 12 years per owner guidance.
        'inclusions' => [
            'Mounting / racking system',
            'AC/DC breakers and wiring',
            'Installation and labor',
            'System testing and commissioning',
        ],
        'packages' => [
            'mini' => [
                'name' => 'Mini', 'kva' => 3, 'price' => 160000,
                'panels' => 4, 'panel_type' => '630 W solar panels',
                'inverter' => '1 × SRNE 3KW24V500V',
                'battery' => '1 × SRNE 100 Ah, 25.6 V',
                'battery_capacity' => '2.56 kWh',
                'panel_warranty' => '12-year panel warranty',
                'inverter_warranty' => '2-year inverter warranty',
                'battery_warranty' => '5-year battery warranty',
                'warranty_note' => null,
            ],
            'package-1' => [
                'name' => 'Package 1', 'kva' => 6, 'price' => 399000,
                'panels' => 10, 'panel_type' => '630 W bifacial solar panels',
                'inverter' => '1 × Growatt 6 kVA hybrid',
                'battery' => '1 × Calidad 14.3 kWh',
                'battery_capacity' => '14.3 kWh',
                'panel_warranty' => '12-year panel warranty',
                'inverter_warranty' => '5-year inverter warranty',
                'battery_warranty' => '5-year battery warranty',
                'warranty_note' => 'Confirm the battery cycle limit and warranty terms with your quote.',
            ],
            'package-2' => [
                'name' => 'Package 2', 'kva' => 8, 'price' => 455000,
                'panels' => 12, 'panel_type' => '630 W bifacial solar panels',
                'inverter' => '1 × Growatt 8 kVA hybrid',
                'battery' => '1 × Growatt 14.3 kWh',
                'battery_capacity' => '14.3 kWh',
                'panel_warranty' => '12-year panel warranty',
                'inverter_warranty' => '5-year inverter warranty',
                'battery_warranty' => '10-year / 6,000-cycle battery warranty',
                'warranty_note' => null,
            ],
            'package-3' => [
                'name' => 'Package 3', 'kva' => 10, 'price' => 525000,
                'panels' => 16, 'panel_type' => '630 W bifacial solar panels',
                'inverter' => '1 × Growatt 10 kVA hybrid',
                'battery' => '1 × Growatt 16.1 kWh',
                'battery_capacity' => '16.1 kWh',
                'panel_warranty' => '12-year panel warranty',
                'inverter_warranty' => '5-year inverter warranty',
                'battery_warranty' => '10-year / 6,000-cycle battery warranty',
                'warranty_note' => null,
            ],
            'package-4' => [
                'name' => 'Package 4', 'kva' => 12, 'price' => 765000,
                'panels' => 20, 'panel_type' => '630 W bifacial solar panels',
                'inverter' => '1 × Solis 12 kVA hybrid',
                'battery' => '2 × Growatt 16.1 kWh',
                'battery_capacity' => '32.2 kWh',
                'panel_warranty' => '12-year panel warranty',
                'inverter_warranty' => '5-year inverter warranty',
                'battery_warranty' => '10-year / 6,000-cycle battery warranty',
                'warranty_note' => null,
            ],
        ],
    ],

    'hardware' => [
        'pickup' => 'Burgos, Siargao',
        'materials' => [
            ['item' => 'Silk-8 Phenolic Board', 'thickness' => '18mm',  'price' => 1400],
            ['item' => 'Shera Cement Board',     'thickness' => '4.5mm', 'price' => 595],
            ['item' => 'Shera Cement Board',     'thickness' => '9.0mm', 'price' => 1500],
            ['item' => 'Shera Cement Board',     'thickness' => '12mm',  'price' => 1900],
            ['item' => 'Marine Plywood',         'thickness' => '9mm',   'price' => 900],
            ['item' => 'Marine Plywood',         'thickness' => '17mm',  'price' => 1400],
            ['item' => 'Rockwool',               'thickness' => null,    'price' => 1075],
            ['item' => 'SPC Flooring',           'thickness' => null,    'price' => 220],
        ],
    ],

];
