<?php

namespace Database\Factories;

use App\Models\Immobilier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'immobilier_id' => Immobilier::factory(),
            'image_path' => $this->faker->imageUrl(),
           
        ];
    }
}
