<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'user_id',
        'rating',
        'comment',
        'photo_path',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
        ];
    }

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
