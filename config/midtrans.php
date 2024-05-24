<?php

return [
    'mercant_id' => env('MIDTRANS_MERCHAT_ID'),
    'client_key' => env('MIDTRANS_IS_PRODUCTION') ? env('MIDTRANS_CLIENT_KEY_PROD') : env('MIDTRANS_CLIENT_KEY_SAND'),
    'server_key' => env('MIDTRANS_IS_PRODUCTION') ? env('MIDTRANS_SERVER_KEY_PROD') : env('MIDTRANS_SERVER_KEY_SAND'),

    'is_production' => env('MIDTRANS_IS_PRODUCTION'),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED'),
    'is_3ds' => env('MIDTRANS_IS_3DS'),
];
