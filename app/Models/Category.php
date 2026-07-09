<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    /**
     * Daftar kategori bawaan Renggo. Dipakai oleh CategorySeeder dan juga
     * sebagai fallback otomatis lewat allOrSeedDefaults() supaya dropdown
     * kategori TIDAK PERNAH kosong walaupun `php artisan db:seed` belum
     * pernah dijalankan.
     */
    public const DEFAULT_CATEGORIES = [
        ['name' => 'Kuliner', 'icon' => '🍜'],
        ['name' => 'Fashion', 'icon' => '👗'],
        ['name' => 'Kerajinan', 'icon' => '🧺'],
        ['name' => 'Pertanian', 'icon' => '🌾'],
        ['name' => 'Jasa', 'icon' => '🛠️'],
        ['name' => 'Peternakan', 'icon' => '🐄'],
        ['name' => 'Perikanan', 'icon' => '🐟'],
        ['name' => 'Kesehatan', 'icon' => '💊'],
        ['name' => 'Kecantikan', 'icon' => '💄'],
        ['name' => 'Konveksi', 'icon' => '🧵'],
        ['name' => 'Percetakan', 'icon' => '🖨️'],
        ['name' => 'Otomotif', 'icon' => '🛵'],
        ['name' => 'Teknologi', 'icon' => '💻'],
        ['name' => 'Pendidikan', 'icon' => '📚'],
        ['name' => 'Lainnya', 'icon' => '✨'],
    ];

    public function umkms()
    {
        return $this->hasMany(Umkm::class);
    }

    /**
     * Insert/update seluruh kategori bawaan. Aman dipanggil berkali-kali
     * (updateOrCreate berdasarkan slug).
     */
    public static function seedDefaults(): void
    {
        foreach (self::DEFAULT_CATEGORIES as $category) {
            self::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                ['name' => $category['name'], 'icon' => $category['icon']]
            );
        }
    }

    /**
     * Ambil semua kategori terurut nama. Kalau tabel masih kosong (seeder
     * belum pernah dijalankan), otomatis isi dengan kategori default dulu
     * supaya halaman pendaftaran UMKM tidak pernah menampilkan dropdown
     * kosong.
     */
    public static function allOrSeedDefaults(): Collection
    {
        if (self::query()->count() === 0) {
            self::seedDefaults();
        }

        return self::orderBy('name')->get();
    }
}