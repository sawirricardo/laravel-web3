<?php

namespace Sawirricardo\LaravelWeb3;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sawirricardo\LaravelWeb3\LaravelWeb3
 */
class LaravelWeb3Facade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-web3';
    }
}
