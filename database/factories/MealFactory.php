<?php

namespace Database\Factories;

use App\Models\Meal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->sentence(20),
            'price' => $this->faker->randomNumber(4) / 100,
        ];
    }
}
