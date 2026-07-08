<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Umkm;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for the current customer on a UMKM.
     */
    public function toggle(Request $request, Umkm $umkm)
    {
        $user = $request->user();

        $favorite = $umkm->favorites()->where('user_id', $user->id)->first();

        if ($favorite) {
            $favorite->delete();
            $favorited = false;
        } else {
            $umkm->favorites()->create(['user_id' => $user->id]);
            ActivityLog::create([
                'umkm_id' => $umkm->id,
                'user_id' => $user->id,
                'type' => 'favorite',
                'description' => 'Ditambahkan ke favorit',
            ]);
            $favorited = true;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'favorited' => $favorited,
                'favorite_count' => $umkm->fresh()->favorite_count,
            ]);
        }

        return back()->with('success', $favorited ? 'Ditambahkan ke favorit.' : 'Dihapus dari favorit.');
    }

    /**
     * List the current customer's favorited UMKMs.
     */
    public function index(Request $request)
    {
        $umkms = $request->user()
            ->favoriteUmkms()
            ->with(['category', 'photos' => fn ($q) => $q->where('type', 'cover')])
            ->paginate(12);

        return view('umkm.favorites', ['umkms' => $umkms]);
    }
}
