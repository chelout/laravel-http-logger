<?php

namespace Chelout\HttpLogger\Loggers;

use Chelout\HttpLogger\Processors\RequestDataProcessor;

class MonologCustomizer
{
    /**
     * Customize the given logger instance.
     *
     * @param \Illuminate\Log\Logger $logger
     */
    public function __invoke($logger)
    {
        return $logger->pushProcessor(new RequestDataProcessor);
    }
}
