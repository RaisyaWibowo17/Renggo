<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Umkm;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Centralizes catalog querying (search + category filter + unggulan/terbaru
 * lists) so controllers stay thin.
 */
class UmkmSearchService
{
    public function search(?string $term, ?string $categorySlug, int $perPage = 12): LengthAwarePaginator
    {
        return Umkm::query()
            ->active()
            ->search($term)
            ->category($categorySlug)
            ->with(['category', 'photos' => fn ($q) => $q->where('type', 'cover')])
            ->withCount('reviews')
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function featured(int $limit = 6): Collection
    {
        return Umkm::query()
            ->active()
            ->withCount(['reviews', 'favorites'])
            ->get()
            ->sortByDesc(fn (Umkm $umkm) => $umkm->reviews_count + $umkm->favorites_count)
            ->take($limit)
            ->values();
    }

    public function latest(int $limit = 8): Collection
    {
        return Umkm::query()
            ->active()
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function categories(): Collection
    {
        return Category::allOrSeedDefaults();
    }
}