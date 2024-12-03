<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producte>
 */
class ProducteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word(),
            'descripcio' => $this->faker->sentence(),
            'preu' => $this->faker->randomFloat(2, 10, 100),
            'quantitat_stock' => $this->faker->numberBetween(0, 100), 
            'categoria_id' => rand(1, 7),
        ];
    }
}
