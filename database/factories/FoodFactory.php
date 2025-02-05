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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
        {
            return [
                'name' => $this->faker->word,
                'user_id' => User::factory(),
                'source_id' => FoodSource::factory(),
                'updated_at' => now(),
                'created_at' => now(),
                'description' => $this->faker->sentence,
                // 'price' => $this->faker->randomFloat(2, 10, 1000),
                // 'category_id' => MyBudgetCategory::factory()->for(User::factory()), // Automatically link to User
                // 'section_id' => MyBudgetSection::factory()->for(User::factory()),
                // 'source_id' => MyBudgetSource::factory()->for(User::factory()),
                // 'user_id' => User::factory(),
            ];
        }
}
