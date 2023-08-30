<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "code" => fake()->numberBetween(10000, 99999),
            "time_delivery" => fake()->numberBetween(40, 80),
            "vendor_id" => fake()->randomElement(Vendor::pluck("id")->toArray()),
        ];
    }
}
