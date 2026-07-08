<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $name = fake()->name();

        return [
            'name' => $name,
            'username' => Str::slug($name, '_').fake()->unique()->numberBetween(1, 99999),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '08'.fake()->numerify('##########'),
            'rw' => fake()->numberBetween(1, 15),
            'role' => User::ROLE_CUSTOMER,
            'password' => Hash::make('password'),
            'profile_photo_url' => null,
            'remember_token' => Str::random(10),
        ];
    }

    public function owner(): static
    {
        return $this->state(fn () => ['role' => User::ROLE_OWNER, 'email' => null]);
    }

    public function customer(): static
    {
        return $this->state(fn () => ['role' => User::ROLE_CUSTOMER]);
    }
}
