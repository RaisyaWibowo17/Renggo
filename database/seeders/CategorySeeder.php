<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
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

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name'])],
                ['name' => $category['name'], 'icon' => $category['icon']]
            );
        }
    }
}
