<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VAT Static values
    |--------------------------------------------------------------------------
    | key stored in the db, full values set here
    |
    */

    'vat' => [
        'low' => [
            'value' => 6,
            'title' => 'Laag tarief (6%)'
        ],
        'high' => [
            'value' => 21,
            'title' => 'Hoog tarief (21%)'
        ]
    ],
    'order_status' => [
        'placed' => [
            'title' => 'Order is bevestiged'
        ],
        'payed' => [
            'title' => 'Order is betaald'
        ],
        'fetching' => [
            'title' => 'Order aan het verzamelen'
        ],
        'sent' => [
            'title' => 'Order is verzonden'
        ],
        'deliverd' => [
            'title' => 'Order is afgeleverd'
        ],
        'return' => [
            'title' => 'Order is retour gekomen'
        ]
    ],
    'countries' => [
        'NL' => [
            'title' => 'Nederland',
        ],
        'BE' => [
            'title' => 'Belgie',
        ],
        'DE' => [
            'title' => 'Duitsland'
        ]
    ]
];
