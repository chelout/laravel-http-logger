<?php

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
