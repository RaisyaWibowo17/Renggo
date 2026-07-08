<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umkm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'slug',
        'business_field',
        'description',
        'address',
        'rw',
        'opening_time',
        'closing_time',
        'cover_path',
        'whatsapp',
        'instagram',
        'gmaps_url',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'opening_time' => 'datetime:H:i',
            'closing_time' => 'datetime:H:i',
            'is_active' => 'boolean',
            'rw' => 'integer',
        ];
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class)->orderBy('sort_order');
    }

    public function gallery()
    {
        return $this->hasMany(Photo::class)->where('type', 'gallery')->orderBy('sort_order');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function promos()
    {
        return $this->hasMany(Promo::class);
    }

    public function activePromos()
    {
        return $this->hasMany(Promo::class)
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            });
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function getRatingAverageAttribute(): float
    {
        return round((float) $this->reviews()->avg('rating'), 1);
    }

    public function getReviewCountAttribute(): int
    {
        return $this->reviews()->count();
    }

    public function getFavoriteCountAttribute(): int
    {
        return $this->favorites()->count();
    }

    public function getViewCountAttribute(): int
    {
        return $this->activityLogs()->where('type', 'view')->count();
    }

    public function isFavoritedBy(?User $user): bool
    {
        if (! $user) {
            return false;
        }

        return $this->favorites()->where('user_id', $user->id)->exists();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $like = '%'.$term.'%';
            $q->where('name', 'ilike', $like)
                ->orWhere('business_field', 'ilike', $like)
                ->orWhere('address', 'ilike', $like)
                ->orWhere('description', 'ilike', $like)
                ->orWhereHas('category', fn (Builder $c) => $c->where('name', 'ilike', $like));
        });
    }

    public function scopeCategory(Builder $query, ?string $categorySlug): Builder
    {
        if (blank($categorySlug) || $categorySlug === 'semua') {
            return $query;
        }

        return $query->whereHas('category', fn (Builder $c) => $c->where('slug', $categorySlug));
    }
}
