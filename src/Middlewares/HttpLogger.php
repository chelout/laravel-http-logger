<?php

namespace Chelout\HttpLogger\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HttpLogger
{
    public function handle(Request $request, Closure $next)
    {
        $methods = array_map(function ($method) {
            return strtolower($method);
        }, config('http-logger.methods', []));

        if ($methods && ! in_array(strtolower($request->method()), $methods)) {
            return $next($request);
        }

        Log::channel('http-logger')->info('');

        return $next($request);
    }
}
