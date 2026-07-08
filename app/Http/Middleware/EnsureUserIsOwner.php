<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsOwner
{
    /**
     * Only allow requests from authenticated UMKM owners through.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isOwner()) {
            abort(403, 'Halaman ini hanya untuk Pemilik UMKM.');
        }

        return $next($request);
    }
}
