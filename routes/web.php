<?php

use Illuminate\Support\Facades\Route;


Route::prefix('_web3')
  ->group(function () {
    Route::get('users/signature', [\Sawirricardo\LaravelWeb3\Http\Controllers\Web3Controller::class, 'signature']);
    Route::resource('users', \Sawirricardo\LaravelWeb3\Http\Controllers\Web3Controller::class)->only(['store']);
  });
