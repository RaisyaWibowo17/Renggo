<?php

namespace Database\Factories;

use App\Models\Promo;
use App\Models\Umkm;
use Illuminate\Database\Eloquent\Factories\Factory;

class PromoFactory extends Factory
{
    protected $model = Promo::class;

    protected array $titles = [
        'Diskon 20% Pembelian Pertama', 'Beli 2 Gratis 1', 'Promo Akhir Pekan',
        'Diskon Ongkir Area Desa', 'Gratis Ongkir Min. Belanja 50rb', 'Promo Grand Opening',
    ];

    public function definition(): array
    {
        return [
            'umkm_id' => Umkm::factory(),
            'title' => fake()->randomElement($this->titles),
            'description' => fake()->realText(120),
            'banner_path' => null,
            'is_active' => true,
            'starts_at' => now()->subDays(3),
            'ends_at' => now()->addDays(fake()->numberBetween(7, 30)),
        ];
    }
}
