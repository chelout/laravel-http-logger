# Log HTTP requests
[![Latest Version on Packagist](https://img.shields.io/packagist/v/chelout/laravel-http-logger.svg)](https://packagist.org/packages/chelout/laravel-http-logger)
[![Total Downloads](https://img.shields.io/packagist/dt/chelout/laravel-http-logger.svg)](https://packagist.org/packages/chelout/laravel-http-logger)
[![License](https://poser.pugx.org/chelout/laravel-relationship-events/license)](https://packagist.org/packages/chelout/laravel-relationship-events)

This package provides a middleware to log incoming http requests data (body data, headers and session data). It utilizes [Laravel 5.6 logging servises](https://laravel.com/docs/5.6/logging) functionality.
This package might be useful to log user requests to public apis.

## Installation

You can install the package via composer:

```bash
composer require chelout/laravel-http-logger
```

Optionally you can publish the configfile with:

```bash
php artisan vendor:publish --provider="Chelout\HttpLogger\HttpLoggerServiceProvider" --tag="config" 
```

This is the contents of the published config file:

```php

return [
    /*
     * Log file path
     */
    'path' => storage_path('logs/http.log'),
    /*
     * The maximal amount of files to keep (0 means unlimited)
     */
    'max_files' => 5,

    /*
     * Log message format.
     * For for details see https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * and https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    'format' => "[%datetime%] %extra.method% %extra.url% from %extra.ips% %context%\n",

    /*
     * Log message datetime format.
     * For for details see https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * and https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    'dateFormat' => null, // "Y-m-d\TH:i:sP"

    /*
     * false - don't log body fields
     * ['only'] - log fields only
     * ['except'] - don't log fields
     *
     * If ['only'] is set, ['except'] parametr will be omitted
     */
    // 'data' => false,
    'data' => [
        'only' => [],
        'except' => [],
    ],

    /*
     * false - don't log headers
     * ['only'] - log headers only
     * ['except'] - don't log headers
     *
     * If ['only'] is set, ['except'] parametr will be omitted
     */
    // 'headers' => false,
    'headers' => [
        'only' => ['user-agent'],
        'except' => [],
    ],

    /*
     * false - don't log session
     * ['only'] - log session only
     * ['except'] - don't log session
     *
     * If ['only'] is set, ['except'] parametr will be omitted
     */
    'session' => false,
    // 'session' => [
    //     'only' => [],
    //     'except' => [],
    // ],
];

```

## Usage

This packages provides a middleware which can be added as a global middleware or as a single route.

```php
// in `app/Http/Kernel.php`

protected $middleware = [
    // ...
    
    \Chelout\HttpLogger\Middlewares\HttpLogger::class
];
```

```php
// in a routes file

Route::post('/submit-form', function () {
    //
})->middleware(\Chelout\HttpLogger\Middlewares\HttpLogger::class);
```

In order to log http requests you should add log custom log channel:
```php
// in config/logging.php

return [
    // ...

    'channels' => [
        // ...

        'http-logger' => [
            'driver' => 'custom',
            'via' => \Chelout\HttpLogger\Loggers\HttpLogger::class,
        ],
    ],
];
```

You can also enhance existing log channel by customizing Monolog configuration:
```php
// in config/logging.php

return [
    // ...

    'channels' => [
        // ...

        'single' => [
            'driver' => 'single',
            'tap' => [Chelout\HttpLogger\Loggers\MonologCustomizer::class],
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],
    ],
];
```


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [Viacheslav Ostrovskiy](https://github.com/cheelout)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
