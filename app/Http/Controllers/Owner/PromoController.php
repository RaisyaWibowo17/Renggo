<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\PromoRequest;
use App\Models\Promo;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $umkm = $request->user()->umkm;
        abort_unless($umkm, 404, 'Daftarkan UMKM Anda terlebih dahulu.');

        return view('owner.promo.index', [
            'umkm' => $umkm,
            'promos' => $umkm->promos()->latest()->get(),
        ]);
    }

    public function create(Request $request)
    {
        abort_unless($request->user()->umkm, 404, 'Daftarkan UMKM Anda terlebih dahulu.');

        return view('owner.promo.form', ['promo' => null]);
    }

    public function store(PromoRequest $request, SupabaseStorageService $storage)
    {
        $umkm = $request->user()->umkm;
        abort_unless($umkm, 404);

        $data = $request->validated();

        $bannerPath = $request->hasFile('banner')
            ? $storage->upload($request->file('banner'), 'promo-banners')
            : null;

        $umkm->promos()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'banner_path' => $bannerPath ? $storage->url($bannerPath) : null,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'is_active' => true,
        ]);

        return redirect()->route('owner.promo.index')->with('success', 'Promo berhasil dibuat.');
    }

    public function edit(Promo $promo)
    {
        Gate::authorize('update', $promo);

        return view('owner.promo.form', ['promo' => $promo]);
    }

    public function update(PromoRequest $request, Promo $promo, SupabaseStorageService $storage)
    {
        Gate::authorize('update', $promo);

        $data = $request->validated();

        $bannerPath = $promo->banner_path;
        if ($request->hasFile('banner')) {
            $path = $storage->upload($request->file('banner'), 'promo-banners');
            $bannerPath = $storage->url($path);
        }

        $promo->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'banner_path' => $bannerPath,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'is_active' => $request->boolean('is_active', $promo->is_active),
        ]);

        return redirect()->route('owner.promo.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy(Promo $promo)
    {
        Gate::authorize('delete', $promo);

        $promo->delete();

        return back()->with('success', 'Promo berhasil dihapus.');
    }
}
