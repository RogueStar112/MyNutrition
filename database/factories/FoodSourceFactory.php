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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodSource>
 */
class FoodSourceFactory extends Factory
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
        ];
    }
}
