<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use App\Models\Umkm;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    /**
     * Record a lightweight "kunjungan halaman" (page visit) entry whenever
     * a visitor opens a UMKM detail page, so owners can see view counts
     * on their dashboard statistics.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->routeIs('umkm.show') && $response->getStatusCode() === 200) {
            $umkm = $request->route('umkm');

            if ($umkm instanceof Umkm) {
                ActivityLog::create([
                    'umkm_id' => $umkm->id,
                    'user_id' => optional($request->user())->id,
                    'type' => 'view',
                    'ip_address' => $request->ip(),
                ]);
            }
        }

        return $response;
    }
}
