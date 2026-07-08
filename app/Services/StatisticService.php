<?php

namespace App\Services;

use App\Models\Umkm;

/**
 * Computes the simple statistics shown on the owner dashboard:
 * total views, total favorites, total reviews, and average rating.
 */
class StatisticService
{
    public function forUmkm(Umkm $umkm): array
    {
        return [
            'total_view' => $umkm->activityLogs()->where('type', 'view')->count(),
            'total_favorit' => $umkm->favorites()->count(),
            'total_review' => $umkm->reviews()->count(),
            'rating_rata_rata' => round((float) $umkm->reviews()->avg('rating'), 1),
        ];
    }

    public function recentActivities(Umkm $umkm, int $limit = 10)
    {
        return $umkm->activityLogs()->latest('created_at')->limit($limit)->get();
    }
}
