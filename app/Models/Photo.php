<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public const TYPE_COVER = 'cover';

    public const TYPE_GALLERY = 'gallery';

    protected $fillable = [
        'umkm_id',
        'path',
        'type',
        'sort_order',
    ];

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
