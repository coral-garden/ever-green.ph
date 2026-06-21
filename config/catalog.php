<?php

// Developer-edited product catalogs per division. No database — edit here, then deploy.
// Prices are in PHP pesos (whole numbers). `thickness` is null when not applicable.
return [

    'construction' => [
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
