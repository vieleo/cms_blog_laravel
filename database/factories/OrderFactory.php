<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'status' => 'awaiting_payment',
            'payment_method' => 'cash_on_delivery',
        ];
    }
}
