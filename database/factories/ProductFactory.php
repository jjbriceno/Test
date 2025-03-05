<?php

namespace Database\Factories;

use App\Models\Product;

use App\Models\Currency;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomCurrency = Currency::inRandomOrder()->first();

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'currency_id' => $randomCurrency?->id,
            'tax_cost' => $this->faker->randomFloat(2, 0, 100),
            'manufacturing_cost' => $this->faker->randomFloat(2, 0, 500),
        ];
    }
}
