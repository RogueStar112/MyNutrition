<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Food;
use App\Models\Meal;
use App\Models\Macronutrients;
use App\Models\UserHealthDetails;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create();

        for ($i = 0;  $i < 5; $i++) {
            $category = MyBudgetCategory::factory()->create(['user_id' => $user->id]);
            
            $section = MyBudgetSection::factory()->create(['user_id' => $user->id, 'category_id' => $category->id]);

            $source = MyBudgetSource::factory()->create(['user_id' => $user->id]);


            // Create related data for the user

            
            
            for ($ii = 0;  $ii < random_int(4, 8); $ii++) {
            MyBudgetItem::factory()
                ->create(['category_id' => $category->id, 
                        'section_id' => $section->id, 
                        'source_id' => $source->id, 
                        'user_id' => $user->id]);
            }
        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
