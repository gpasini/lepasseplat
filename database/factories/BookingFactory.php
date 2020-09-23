<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\ScheduledMeal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'scheduled_meal_id' => ScheduledMeal::factory(),
            'quantity' => $this->randomNumber(1),
        ];
    }
}
