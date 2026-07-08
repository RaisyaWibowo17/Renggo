<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UmkmFactory extends Factory
{
    protected $model = Umkm::class;

    protected array $namePrefixes = [
        'Kedai', 'Toko', 'Warung', 'Kios', 'Griya', 'Sentra', 'Rumah',
    ];

    protected array $businessWords = [
        'Kopi Renggo', 'Anyaman Bambu Lestari', 'Batik Candirenggo', 'Tani Makmur Sejahtera',
        'Jahit Berkah', 'Kripik Singkong Bu Sri', 'Madu Hutan Asli', 'Sayur Organik Desa',
        'Sablon Kaos Kreatif', 'Kerajinan Kayu Jati', 'Roti Bakar Malam', 'Bengkel Motor Jaya',
        'Salon Kecantikan Ayu', 'Ternak Lele Makmur', 'Konveksi Seragam Sekolah',
    ];

    public function definition(): array
    {
        $name = fake()->randomElement($this->namePrefixes).' '.fake()->randomElement($this->businessWords);

        return [
            'user_id' => User::factory()->owner(),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1, 99999),
            'business_field' => fake()->randomElement(['Kuliner', 'Fashion', 'Kerajinan Tangan', 'Hasil Pertanian', 'Jasa Layanan']),
            'description' => fake()->realText(180),
            'address' => 'Desa '.fake()->citySuffix().', RT '.fake()->numberBetween(1, 8).'/RW '.fake()->numberBetween(1, 15).', Kab. Malang',
            'rw' => fake()->numberBetween(1, 15),
            'opening_time' => '08:00',
            'closing_time' => '20:00',
            'cover_path' => null,
            'whatsapp' => '628'.fake()->numerify('##########'),
            'instagram' => fake()->userName(),
            'gmaps_url' => 'https://maps.google.com/?q='.fake()->latitude(-8.2, -7.9).','.fake()->longitude(112.5, 112.8),
            'is_active' => true,
        ];
    }
}
