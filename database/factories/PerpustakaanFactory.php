<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perpustakaan>
 */
class PerpustakaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => Str::random(10),
            'penulis' => fake()->name(),
            'gambar' => fake()->randomNumber(4),
            'price' => fake()->randomNumber(2), 
            'jumlah' => fake()->randomNumber(2), 
        ];
    }
}