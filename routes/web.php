<?php

use Illuminate\Support\Facades\Route;


Route::prefix('_web3')
  ->middleware(['web'])
  ->group(function () {
    Route::get('users/signature', [\Sawirricardo\LaravelWeb3\Http\Controllers\Web3Controller::class, 'signature'])
      ->middleware(['guest']);
    Route::resource('users', \Sawirricardo\LaravelWeb3\Http\Controllers\Web3Controller::class)
      ->middleware(['guest'])->only(['store']);
    Route::delete('users/logout', [\Sawirricardo\LaravelWeb3\Http\Controllers\Web3Controller::class, 'logout'])
      ->middleware(['auth']);
  });
