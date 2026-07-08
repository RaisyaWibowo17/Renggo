<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsCustomer
{
    /**
     * Only allow requests from authenticated customers through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isCustomer()) {
            abort(403, 'Halaman ini hanya untuk Pelanggan.');
        }

        return $next($request);
    }
}
