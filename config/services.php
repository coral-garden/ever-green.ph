<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // External lead system (TBC). When `url` is empty, leads are logged instead.
    'lead_forwarder' => [
        'url' => env('LEAD_FORWARDER_URL'),
        'key' => env('LEAD_FORWARDER_KEY'),
    ],

    // Bill parser API — POST a bill image, receive structured data back.
    // The key is origin-restricted; `origin` must be an allowlisted domain.
    'bill_parser' => [
        'url' => env('BILL_PARSER_URL'),
        'key' => env('BILL_PARSER_KEY'),
        'origin' => env('BILL_PARSER_ORIGIN', env('APP_URL')),
    ],

];
