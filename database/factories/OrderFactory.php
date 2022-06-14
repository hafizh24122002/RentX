<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;
    
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            // 'seller_id'=>mt_rand(1, 3),
            'buyer_id'=> mt_rand(1, 3),
            // 'property_id'=> mt_rand(1, 26),
            'date_order' => $this->faker->dateTimeBetween('-3 week','-2 week'),
            'check_in' => $this->faker->dateTimeBetween('-2 week', '-1 week'),
            'check_out' => $this->faker->dateTimeBetween('-1 week','+2 week'),
            'duration'=> $this->faker->numberBetween(1,365),
            'total_payment'=> $this->faker->numberBetween(100000,1000000),
            'status'=>$this->faker->randomElement(["accepted","rejected",'pending','paid'])
        ];
    }
}