<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Services\UmkmSearchService;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function __construct(protected UmkmSearchService $umkmSearch)
    {
    }

    /**
     * "Explore" / search + filter catalog page.
     */
    public function index(Request $request)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:255'],
            'kategori' => ['nullable', 'string', 'max:50'],
        ]);

        $umkms = $this->umkmSearch->search($request->query('q'), $request->query('kategori'));

        return view('umkm.search', [
            'umkms' => $umkms,
            'categories' => $this->umkmSearch->categories(),
            'q' => $request->query('q'),
            'activeCategory' => $request->query('kategori', 'semua'),
        ]);
    }

    public function show(Request $request, Umkm $umkm)
    {
        abort_unless($umkm->is_active || (auth()->check() && auth()->id() === $umkm->user_id), 404);

        $umkm->load([
            'category',
            'gallery',
            'photos' => fn ($q) => $q->where('type', 'cover'),
            'activePromos',
            'reviews.user',
        ]);

        return view('umkm.detail', [
            'umkm' => $umkm,
            'isFavorited' => $umkm->isFavoritedBy($request->user()),
            'myReview' => $request->user()
                ? $umkm->reviews()->where('user_id', $request->user()->id)->first()
                : null,
        ]);
    }
}
