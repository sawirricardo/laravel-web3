<?php
// config for Sawirricardo/LaravelWeb3
return [
    'network' => env('WEB3_NETWORK', 'localhost'),
    'infura_id' => env('WEB3_INFURA_ID', ''),
    'contracts' => [
        // [
        //   'address' => '0xlaks3211flkjfqoeio13090',
        //   'contract' =>  json_decode(file_get_contents(storage_path('path/to/your/contract.json'))),
        // ],
    ],
    'model' => [
        // column to store wallet address
        'column' => 'account'
    ]
];
