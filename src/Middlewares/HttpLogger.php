<?php

namespace Chelout\HttpLogger\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HttpLogger
{
    public function handle(Request $request, Closure $next)
    {
        Log::channel('http-logger')->info('');

        return $next($request);
    }
}
