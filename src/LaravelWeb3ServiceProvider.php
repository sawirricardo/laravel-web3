<?php

namespace Sawirricardo\LaravelWeb3;

use Sawirricardo\LaravelWeb3\Commands\LaravelWeb3Command;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelWeb3ServiceProvider extends PackageServiceProvider
{
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
            ->hasViewComponents('lightweb3', LaravelWeb3Scripts::class)
            ->hasCommand(LaravelWeb3Command::class);
    }
}
