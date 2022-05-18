<?php

namespace App\Http\Middleware;

use Closure;

class NotAvailableByCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->header('X-Country') != 'MO') {
            // abort(403, 'Not available for your country.');
        }

        return $next($request);
    }
}
