<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'amount' => $this->faker->randomDigit(),
            'price' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2000),
            'sub_total' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 2000),
            'sale_order_id' => ''
        ];
    }
}
