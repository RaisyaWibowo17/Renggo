<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\ActivityLog;
use App\Models\Review;
use App\Models\Umkm;
use App\Services\SupabaseStorageService;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request, Umkm $umkm, SupabaseStorageService $storage)
    {
        $existing = $umkm->reviews()->where('user_id', $request->user()->id)->first();

        abort_if($existing, 422, 'Anda hanya dapat memberikan satu review untuk setiap UMKM. Silakan edit review Anda.');

        $data = $request->validated();

        $photoPath = $request->hasFile('photo')
            ? $storage->upload($request->file('photo'), 'review-photos')
            : null;

        $umkm->reviews()->create([
            'user_id' => $request->user()->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'],
            'photo_path' => $photoPath ? $storage->url($photoPath) : null,
        ]);

        ActivityLog::create([
            'umkm_id' => $umkm->id,
            'user_id' => $request->user()->id,
            'type' => 'review',
            'description' => 'Review baru diberikan',
        ]);

        return back()->with('success', 'Terima kasih atas review Anda!');
    }

    public function update(ReviewRequest $request, Review $review, SupabaseStorageService $storage)
    {
        Gate::authorize('update', $review);

        $data = $request->validated();

        $photoPath = $review->photo_path;
        if ($request->hasFile('photo')) {
            $newPath = $storage->upload($request->file('photo'), 'review-photos');
            $photoPath = $storage->url($newPath);
        }

        $review->update([
            'rating' => $data['rating'],
            'comment' => $data['comment'],
            'photo_path' => $photoPath,
        ]);

        return back()->with('success', 'Review berhasil diperbarui.');
    }

    public function destroy(Review $review)
    {
        Gate::authorize('delete', $review);

        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }
}
