<?php

namespace Botble\Api\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureApiKeyIsValid
{
    public function handle($request, Closure $next)
{
    $apiKey = $request->header('X-API-KEY');

    if ($apiKey !== config('app.mobile_app_api_key')) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return $next($request);
}

}
