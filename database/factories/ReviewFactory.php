<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    protected array $comments = [
        'Produknya sangat berkualitas dan pelayanannya ramah sekali.',
        'Rasa dan kualitasnya konsisten, jadi langganan tetap di sini.',
        'Harga terjangkau untuk kualitas sebagus ini, recommended!',
        'Pengemasan rapi dan pengiriman cepat, terima kasih!',
        'Sangat membantu UMKM desa, semoga makin berkembang.',
        'Pelayanan cepat tanggap saat saya bertanya lewat WhatsApp.',
        'Produk sesuai foto, kualitas oke untuk harga segini.',
        'Tempatnya bersih dan nyaman, produknya juga enak.',
    ];

    public function definition(): array
    {
        return [
            'umkm_id' => Umkm::factory(),
            'user_id' => User::factory()->customer(),
            'rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->randomElement($this->comments),
            'photo_path' => null,
        ];
    }
}
