<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\UmkmStoreRequest;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Umkm;
use App\Services\SupabaseStorageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    /**
     * Multi-step registration form (Alpine.js driven, single submit).
     */
    public function create(Request $request)
    {
        if ($request->user()->umkm) {
            return redirect()->route('owner.umkm.edit')
                ->with('info', 'Anda sudah memiliki UMKM terdaftar.');
        }

        return view('owner.umkm.form', [
            'umkm' => null,
            'categories' => Category::allOrSeedDefaults(),
        ]);
    }

    public function store(UmkmStoreRequest $request, SupabaseStorageService $storage)
    {
        abort_if($request->user()->umkm, 422, 'Anda hanya dapat mendaftarkan satu UMKM.');

        $data = $request->validated();

        $umkm = Umkm::create([
            'user_id' => $request->user()->id,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $this->uniqueSlug($data['name']),
            'business_field' => $data['business_field'],
            'description' => $data['description'],
            'address' => $data['address'],
            'rw' => $data['rw'],
            'opening_time' => $data['opening_time'],
            'closing_time' => $data['closing_time'],
            'whatsapp' => $data['whatsapp'],
            'instagram' => $data['instagram'] ?? null,
            'gmaps_url' => $data['gmaps_url'] ?? null,
            'is_active' => true,
        ]);

        $this->syncMedia($request, $umkm, $storage);

        if (filled($data['promo_title'] ?? null)) {
            $bannerPath = $request->hasFile('promo_banner')
                ? $storage->upload($request->file('promo_banner'), 'promo-banners')
                : null;

            $umkm->promos()->create([
                'title' => $data['promo_title'],
                'description' => $data['promo_description'],
                'banner_path' => $bannerPath ? $storage->url($bannerPath) : null,
                'is_active' => true,
            ]);
        }

        ActivityLog::create([
            'umkm_id' => $umkm->id,
            'user_id' => $request->user()->id,
            'type' => 'update',
            'description' => 'UMKM didaftarkan',
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'UMKM berhasil didaftarkan!');
    }

    public function edit(Request $request)
    {
        $umkm = $request->user()->umkm;
        abort_unless($umkm, 404, 'Anda belum mendaftarkan UMKM.');

        $umkm->load(['gallery', 'photos' => fn ($q) => $q->where('type', 'cover')]);

        return view('owner.umkm.form', [
            'umkm' => $umkm,
            'categories' => Category::allOrSeedDefaults(),
        ]);
    }

    public function update(UmkmStoreRequest $request, SupabaseStorageService $storage)
    {
        $umkm = $request->user()->umkm;
        abort_unless($umkm, 404);
        Gate::authorize('update', $umkm);

        $data = $request->validated();

        $umkm->update([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'business_field' => $data['business_field'],
            'description' => $data['description'],
            'address' => $data['address'],
            'rw' => $data['rw'],
            'opening_time' => $data['opening_time'],
            'closing_time' => $data['closing_time'],
            'whatsapp' => $data['whatsapp'],
            'instagram' => $data['instagram'] ?? null,
            'gmaps_url' => $data['gmaps_url'] ?? null,
        ]);

        if ($umkm->wasChanged('name')) {
            $umkm->update(['slug' => $this->uniqueSlug($data['name'], $umkm->id)]);
        }

        $this->syncMedia($request, $umkm, $storage);

        ActivityLog::create([
            'umkm_id' => $umkm->id,
            'user_id' => $request->user()->id,
            'type' => 'update',
            'description' => 'Informasi UMKM diperbarui',
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'UMKM berhasil diperbarui.');
    }

    protected function syncMedia(Request $request, Umkm $umkm, SupabaseStorageService $storage): void
    {
        if ($request->hasFile('cover')) {
            $oldCover = $umkm->photos()->where('type', Photo::TYPE_COVER)->first();
            $path = $storage->replace($request->file('cover'), 'umkm-covers', $oldCover?->path);

            if ($oldCover) {
                $oldCover->update(['path' => $storage->url($path)]);
            } else {
                $umkm->photos()->create(['path' => $storage->url($path), 'type' => Photo::TYPE_COVER]);
            }

            $umkm->update(['cover_path' => $storage->url($path)]);
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $index => $file) {
                $path = $storage->upload($file, 'umkm-gallery');
                $umkm->photos()->create([
                    'path' => $storage->url($path),
                    'type' => Photo::TYPE_GALLERY,
                    'sort_order' => $index,
                ]);
            }
        }
    }

    protected function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $i = 1;

        while (Umkm::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}