<?php

namespace Chelout\HttpLogger\Loggers;

use Chelout\HttpLogger\Processors\RequestDataProcessor;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class HttpLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger('http-logger');

        return $logger->pushProcessor(new RequestDataProcessor)
            ->pushHandler(
                (new RotatingFileHandler(
                    config('http-logger.path'),
                    config('http-logger.max_files')
                ))->setFormatter(new LineFormatter(config('http-logger.format'), config('http-logger.dateFormat'), true, true))
            );
    }
}
