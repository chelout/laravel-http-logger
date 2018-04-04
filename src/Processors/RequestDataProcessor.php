<?php

namespace Chelout\HttpLogger\Processors;

class RequestDataProcessor
{
    /**
     * Adds additional request data to the log message.
     *
     * @return array
     */
    public function __invoke($record): array
    {
        return array_merge_recursive($record, [
            'context' => array_filter([
                'data' => $this->processContext('data'),
                'headers' => $this->processContext('headers'),
                'session' => $this->processContext('session'),
            ]),
            'extra' => $this->processExtra(),
        ]);
    }

    /**
     * Process extra.
     *
     * @return array
     */
    protected function processExtra(): array
    {
        return [
            'method' => request()->getMethod(),
            'url' => request()->url(),
            'ips' => implode(', ', request()->ips()),
        ];
    }

    /**
     * Process context.
     *
     * @param string $name data source
     *
     * @return array
     */
    protected function processContext(string $name): array
    {
        $config = config("http-logger.{$name}");

        if (false !== $config) {
            $context = $this->{'get' . ucfirst($name)}();

            if (array_get($config, 'except')) {
                return array_except($context, array_get($config, 'except'));
            }

            if (array_get($config, 'only')) {
                return array_only($context, array_get($config, 'only'));
            }

            return $context;
        }

        return [];
    }

    /**
     * Get request body data.
     *
     * @return array
     */
    protected function getData(): array
    {
        return request()->all();
    }

    /**
     * Get request headers.
     *
     * @return array
     */
    protected function getHeaders(): array
    {
        return request()->header();
    }

    /**
     * Get session data.
     *
     * @return array
     */
    protected function getSession(): array
    {
        return session()->all();
    }
}
