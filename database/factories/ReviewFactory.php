<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            // 'order_id'=> $this->faker->unique()->numberBetween(1, 20),
            // 'buyer_id'=> mt_rand(1, 3),
            // 'property_id'=> mt_rand(1, 10),
            'comment'=> $this->faker->sentence(mt_rand(5, 10)),
            'rating' => mt_rand(1, 5)
        ];
    }
}