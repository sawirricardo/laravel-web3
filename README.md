# Laravel Web3

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sawirricardo/laravel-web3.svg?style=flat-square)](https://packagist.org/packages/sawirricardo/laravel-web3)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/sawirricardo/laravel-web3/run-tests?label=tests)](https://github.com/sawirricardo/laravel-web3/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/sawirricardo/laravel-web3/Check%20&%20fix%20styling?label=code%20style)](https://github.com/sawirricardo/laravel-web3/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sawirricardo/laravel-web3.svg?style=flat-square)](https://packagist.org/packages/sawirricardo/laravel-web3)

---

Laravel Web3 helps you to kickstart your web3 apps.

<!-- ## Support us -->

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
  'network' => env('WEB3_NETWORK', 'localhost'),
  'infura_id' => env('WEB3_INFURA_ID', ''),
];
```

Add this to your .env

```env
WEB3_NETWORK=localhost #mainnet, mumbai, etc
WEB_INFURA_ID=xxxxxxxxxxxxxxxxxx
MIX_WEB3_NETWORK="${WEB3_NETWORK}"
MIX_WEB3_INFURA_ID="${WEB_INFURA_ID}"
```

Then, add "account" to \App\Models\User fillables

```php
// app/Models/User.php
protected $fillable = [
  'email','name','password',
  'account' //Add this
];
```

Also add this to your layout HTML

```html
<body>
    <!-- it's best to drop this at the below -->
    <script
        src="https://cdn.ethers.io/lib/ethers-5.2.umd.min.js"
        type="application/javascript"
    ></script>
    <script
        type="text/javascript"
        src="https://unpkg.com/web3modal@1.9.0/dist/index.js"
    ></script>
    <script
        type="text/javascript"
        src="https://unpkg.com/@walletconnect/web3-provider@1.6.5/dist/umd/index.min.js"
    ></script>
    <x-laravelweb3Scripts />
</body>
```

## Usage

```blade
@guest
<button onclick="laravelWeb3.onConnect()">Connect to wallet</button>
@endguest

@auth
<button onclick="laravelWeb3.onDisconnect()">Disconnect wallet</button>
@endauth
```

```js
// return provider object by Ethers JS
// Run wild, my friends
const etherProvider = laravelWeb3.getProvider();

// LaravelWeb3 automatically register laravelWeb3 to window object for you to play.
console.log({window.laravelWeb3});
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
