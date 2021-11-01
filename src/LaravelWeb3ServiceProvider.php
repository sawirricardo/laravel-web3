<?php

namespace Sawirricardo\LaravelWeb3;

use Illuminate\Support\Facades\Blade;
use Sawirricardo\LaravelWeb3\Commands\LaravelWeb3Command;
use Sawirricardo\LaravelWeb3\Components\LaravelWeb3Scripts;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelWeb3ServiceProvider extends PackageServiceProvider
{
    public function packageBooted()
    {
        Blade::component('laravelweb3Scripts', LaravelWeb3Scripts::class);
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-web3')
            ->hasConfigFile()
            // ->hasViews()
            ->hasRoute('/../routes/web')
            ->hasMigration('update_users_table_web3_compatible')
            ->hasCommand(LaravelWeb3Command::class);
    }
}
