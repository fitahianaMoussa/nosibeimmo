<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Immobilier>
 */
class ImmobilierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subcategory_id' => Subcategory::factory(),
            'titre' => $this->faker->sentence,
            'prix' => $this->faker->numberBetween(100000, 1000000),
            'surface' => $this->faker->numberBetween(50, 500),
            'reference' => $this->faker->randomElement(['VT', 'VI', 'LI', 'LN']),
            'description' => $this->faker->paragraph,
            'images_couverture' => $this->faker->imageUrl(),
            'electricite' => $this->faker->boolean(),
            'eau' => $this->faker->boolean(),
            'situation_juridique' => $this->faker->sentence,
            'vue_sur_la_mer' => $this->faker->boolean(),
            'plage' => $this->faker->boolean(),
        ];
    }
}
