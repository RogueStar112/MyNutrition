<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        $food_unit_count = FoodUnit::count();
        $user = User::factory()->create();

        for ($i = 0;  $i < 5; $i++) {
            $food_unit_chosen = rand(1, $food_unit_count);

            $food_source = FoodSource::factory()->create();

            $food = Food::factory()->create(['user_id' => $user->id, 'source_id' => $food_source->id]);


            $meal = Meal::factory()->create(['user_id' => $user->id]);

            for ($i = 0;  $i < rand(1, 5); $i++) {
                $meal_items = MealItems::factory()->create(['food_id' => $food->id, 'meal_id' => $meal->id, 'food_unit_id' => $food_unit_chosen]);
                $macros = Macronutrients::factory()->create(['food_id' => $food->id, 'food_unit_id' => $food_unit_chosen]);
                $micros = Micronutrients::factory()->create(['food_id' => $food->id]);


                
                




            }
        }

        $user_health_details = UserHealthDetails::factory()->create();

            

            // Create related data for the user

            
            
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
