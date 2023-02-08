<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'name' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10000, 100000),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
