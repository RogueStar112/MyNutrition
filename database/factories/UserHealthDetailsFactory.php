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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserHealthDetails>
 */
class UserHealthDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $weight = $this->faker->randomFloat(1, 35, 150); // weight in kg
        $height = $this->faker->randomFloat(1, 120, 190); // height in cm

        // Convert height to meters and calculate BMI
        $heightInMeters = $height / 100;
        $bmi = $heightInMeters > 0 ? $weight / ($heightInMeters ** 2) : 0;
        
        return [
            'weight' => $weight,
            'height' => $height,
            'bmi' => round($bmi, 1),
            'bodyfat' => 0,
            'last_updated' => now(),
        ];
    }
}
