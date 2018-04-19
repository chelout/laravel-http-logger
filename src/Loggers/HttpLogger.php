<?php

namespace Chelout\HttpLogger\Loggers;

use Chelout\HttpLogger\Processors\RequestDataProcessor;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;

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

        if (config('http-logger.memory_usage')) {
            $logger->pushProcessor(new MemoryUsageProcessor);
        }

        if (config('http-logger.memory_peak_usage')) {
            $logger->pushProcessor(new MemoryPeakUsageProcessor);
        }

        if (config('http-logger.git')) {
            $logger->pushProcessor(new GitProcessor);
        }

        return $logger->pushProcessor(new RequestDataProcessor)
            ->pushHandler(
                (new RotatingFileHandler(
                    config('http-logger.path'),
                    config('http-logger.max_files')
                ))->setFormatter(new LineFormatter(config('http-logger.format'), config('http-logger.date_format'), true, true))
            );
    }
}
