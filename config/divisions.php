<?php

// Per-division header context: the wordmark sub-label, the nav links, and the CTA.
// The "Evergreen" wordmark always returns to the group portal at "/".
return [

    'group' => [
        'label' => null,
        'links' => [
            ['Solar', '/solar'],
            ['Construction', '/construction'],
            ['Hardware', '/hardware'],
            ['About', '/about'],
            ['Contact', '/contact'],
        ],
        'cta' => ['Contact us', '/contact'],
    ],

    'solar' => [
        'label' => 'Solar',
        'links' => [
            ['Services', '/solar/services'],
            ['Estimate', '/solar/estimate'],
            ['Projects', '/solar/projects'],
            ['About', '/about'],
            ['Contact', '/contact'],
        ],
        'cta' => ['Get a quote', '/solar/estimate'],
    ],

    'construction' => [
        'label' => 'Frame Construction',
        'links' => [
            ['Solar', '/solar'],
            ['Hardware', '/hardware'],
            ['About', '/about'],
            ['Contact', '/contact'],
        ],
        'cta' => ['Get a quote', '/contact'],
    ],

    'hardware' => [
        'label' => 'Hardware Supply',
        'links' => [
            ['Solar', '/solar'],
            ['Construction', '/construction'],
            ['About', '/about'],
            ['Contact', '/contact'],
        ],
        'cta' => ['Contact us', '/contact'],
    ],

];
