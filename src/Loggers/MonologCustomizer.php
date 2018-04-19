<?php

namespace Chelout\HttpLogger\Loggers;

use Chelout\HttpLogger\Processors\RequestDataProcessor;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\MemoryUsageProcessor;

class MonologCustomizer
{
    /**
     * Customize the given logger instance.
     *
     * @param \Illuminate\Log\Logger $logger
     */
    public function __invoke($logger)
    {
        if (config('http-logger.memory_usage')) {
            $logger->pushProcessor(new MemoryUsageProcessor);
        }

        if (config('http-logger.memory_peak_usage')) {
            $logger->pushProcessor(new MemoryPeakUsageProcessor);
        }

        if (config('http-logger.git')) {
            $logger->pushProcessor(new GitProcessor);
        }

        return $logger->pushProcessor(new RequestDataProcessor);
    }
}
