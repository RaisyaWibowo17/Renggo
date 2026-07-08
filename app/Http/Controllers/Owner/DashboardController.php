<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Services\StatisticService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(protected StatisticService $statistics)
    {
    }

    public function index(Request $request)
    {
        $umkm = $request->user()->umkm;

        if (! $umkm) {
            return redirect()->route('owner.umkm.create');
        }

        $umkm->load(['gallery', 'promos' => fn ($q) => $q->latest()]);

        return view('owner.dashboard', [
            'umkm' => $umkm,
            'stats' => $this->statistics->forUmkm($umkm),
            'activities' => $this->statistics->recentActivities($umkm),
        ]);
    }
}
