<?php

namespace Database\Seeders;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UmkmSeeder extends Seeder
{
    public function run(): void
    {
        // Demo accounts so reviewers can log in immediately without registering.
        $demoOwner = User::factory()->owner()->create([
            'name' => 'Pak Slamet (Demo Owner)',
            'username' => 'demo_owner',
            'password' => Hash::make('password'),
        ]);

        User::factory()->customer()->create([
            'name' => 'Siti Aminah (Demo Pelanggan)',
            'username' => 'demo_pelanggan',
            'email' => 'pelanggan@renggo.test',
            'password' => Hash::make('password'),
        ]);

        // 20 dummy UMKM (the first one belongs to the demo owner account).
        $umkms = collect();
        $umkms->push(Umkm::factory()->create(['user_id' => $demoOwner->id]));
        $umkms = $umkms->merge(Umkm::factory()->count(19)->create());

        // 50 dummy reviews spread across UMKM, one reviewer per review.
        $umkms->each(function (Umkm $umkm) {
            $reviewCount = fake()->numberBetween(1, 4);

            for ($i = 0; $i < $reviewCount; $i++) {
                \App\Models\Review::factory()->create([
                    'umkm_id' => $umkm->id,
                    'user_id' => User::factory()->customer(),
                ]);
            }
        });

        $remaining = 50 - \App\Models\Review::count();
        if ($remaining > 0) {
            \App\Models\Review::factory($remaining)->create([
                'umkm_id' => fn () => $umkms->random()->id,
                'user_id' => fn () => User::factory()->customer(),
            ]);
        }

        // 10 dummy promos spread across random UMKM.
        $umkms->random(10)->each(function (Umkm $umkm) {
            \App\Models\Promo::factory()->create(['umkm_id' => $umkm->id]);
        });
    }
}
