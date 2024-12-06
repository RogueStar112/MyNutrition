<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;
use App\Models\Meal;
use App\Models\MealItems;
use App\Models\MealNotifications;
use App\Models\Macronutrients;
use App\Models\Micronutrients;
use App\Models\UserHealthDetails;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Micronutrients>
 */
class MicronutrientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => Food::factory(),
            'sugars' => $this->faker->randomFloat(1, 1, 50),
            'saturates' => $this->faker->randomFloat(1, 1, 40),
            'fibre' => $this->faker->randomFloat(1, 1, 30),
            'salt' => $this->faker->randomFloat(1, 1, 6),
        ];
    }
}
