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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MealItems>
 */
class MealItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'meal_id' => Meal::factory(),
            'food_id' => Food::factory(),
            'serving_size' => $this->faker->randomFloat(1, 1, 150),
            'quantity' => $this->faker->randomDigit(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
