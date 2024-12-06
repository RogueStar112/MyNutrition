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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Macronutrients>
 */
class MacronutrientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $food_unit_count = FoodUnit::count();
        $food_unit_chosen = rand(1, $food_unit_count);


        return [
            'food_id' => Food::factory(),
            'food_unit_id' => $food_unit_chosen,
            'serving_size' => $this->faker->randomFloat(1, 1, 500),
            'calories' => $this->faker->randomFloat(1, 1, 2500),
            'fat' => $this->faker->randomFloat(1, 1, 70),
            'carbohydrates' => $this->faker->randomFloat(1, 1, 240),
            'protein' => $this->faker->randomFloat(1, 1, 150),
        ];
    }
}
