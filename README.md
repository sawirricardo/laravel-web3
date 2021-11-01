# This is my package laravel-web3

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sawirricardo/laravel-web3.svg?style=flat-square)](https://packagist.org/packages/sawirricardo/laravel-web3)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/sawirricardo/laravel-web3/run-tests?label=tests)](https://github.com/sawirricardo/laravel-web3/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/sawirricardo/laravel-web3/Check%20&%20fix%20styling?label=code%20style)](https://github.com/sawirricardo/laravel-web3/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sawirricardo/laravel-web3.svg?style=flat-square)](https://packagist.org/packages/sawirricardo/laravel-web3)

---

This repo can be used to scaffold a Laravel package. Follow these steps to get started:

1. Press the "Use template" button at the top of this repo to create a new repo with the contents of this laravel-web3
2. Run "php ./configure.php" to run a script that will replace all placeholders throughout all the files
3. Remove this block of text.
4. Have fun creating your package.
5. If you need help creating a package, consider picking up our <a href="https://laravelpackage.training">Laravel Package Training</a> video course.

---

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-web3.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-web3)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require sawirricardo/laravel-web3
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Sawirricardo\LaravelWeb3\LaravelWeb3ServiceProvider" --tag="laravel-web3-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --provider="Sawirricardo\LaravelWeb3\LaravelWeb3ServiceProvider" --tag="laravel-web3-config"
```

This is the contents of the published config file:

```php
return [
];
```

Add this to your .env

```env
WEB3_NETWORK=localhost #mainnet, mumbai, etc
WEB_INFURA_ID=xxxxxxxxxxxxxxxxxx
MIX_WEB3_NETWORK="${WEB3_NETWORK}"
MIX_WEB3_INFURA_ID="${WEB_INFURA_ID}"
```

## Usage

```php
$laravel-web3 = new Sawirricardo\LaravelWeb3();
echo $laravel-web3->echoPhrase('Hello, Sawirricardo!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [ricardosawir](https://github.com/sawirricardo)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
