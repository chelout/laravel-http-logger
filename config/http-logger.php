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
     * Log methods
     * [] - log all methods
     * ['get','post'] - log only 'get' and 'post' methods
     */
    'methods' => [],

    /*
     * Log message format.
     * @see https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    'format' => "[%datetime%] %extra.method% %extra.url% from %extra.ips% %context%\n",

    /*
     * Log message datetime format.
     * @see https://github.com/Seldaek/monolog/blob/master/doc/01-usage.md#customizing-the-log-format
     * @see https://github.com/Seldaek/monolog/blob/master/src/Monolog/Formatter/LineFormatter.php
     */
    'date_format' => null, // "Y-m-d\TH:i:sP"

    /*
     * Log current memory usage
     * @see https://github.com/Seldaek/monolog/blob/master/src/Monolog/Processor/MemoryUsageProcessor.php
     */
    'memory_usage' => true,

    /*
     * Log peak memory usage
     * @see https://github.com/Seldaek/monolog/blob/master/src/Monolog/Processor/MemoryPeakUsageProcessor.php
     */
    'memory_peak_usage' => true,

    /*
     * Log current git branch and commit
     * @see https://github.com/Seldaek/monolog/blob/master/src/Monolog/Processor/GitProcessor.php
     */
    'git' => true,

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
     * false - don't log uploaded files
     * ['only'] - log files only
     * ['except'] - don't log files
     *
     * If ['only'] is set, ['except'] parametr will be omitted
     */
    // 'files' => false,
    'files' => [
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
