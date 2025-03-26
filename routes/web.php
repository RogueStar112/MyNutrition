<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\BodyStatsController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\SleepController;
use App\Http\Controllers\VisualizerController;
use App\Http\Controllers\SuggesterController;
use App\Http\Controllers\MacroController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\ProfanityController;
use App\Http\Controllers\ChangelogController;
use App\Http\Controllers\ThemeController;

use Illuminate\Support\Facades\Route;


use Livewire\Component;
use App\Livewire\MealNotificationLivewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {


//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/nutrition', function () {
    return view('nutrition');
})->middleware(['auth', 'verified'])->name('nutrition_mainMenu');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard_view'])->name('dashboard');

    Route::get('/dashboard/render/body_stats_chart', [DashboardController::class, 'renderBodyStatsChart'])->name('dashboard.bodychart');


    Route::get('/dashboard/{start_date}/{end_date}', [DashboardController::class, 'dashboard_stats'])->name('dashboard.stats');


    Route::get('/nutrition/food', [FoodController::class, 'food_form'])->name('food.create');

    

    Route::post('/nutrition/food', [FoodController::class, 'food_form_store'])->name('food.store');
    Route::post('/nutrition/food/create_page', [FoodController::class, 'create_new_food_page'])->name('food.page_create');
    Route::post('/nutrition/food/create_item', [FoodController::class, 'create_new_food_item'])->name('food.item_create');
    // Route::put('/nutrition/food', [FoodController::class, 'food_edit'])->name('food.edit');
    // Route::delete('/nutrition/food', [FoodController::class, 'food_delete'])->name('food.delete');

    Route::get('/nutrition/food/view', [FoodController::class, 'food_view'])->name('food.view');
    
    Route::get('/nutrition/food/view/{user_id}/{food_id}', [FoodController::class, 'food_view_item'])->name('food.view_item');

    // Route::get('/nutrition/food/view/{user_id}/{name}/{quantity}', [FoodController::class, 'food_view_item_quant'])->name('food.view_item_quant');

    Route::get('/nutrition/food/edit/{id}', [FoodController::class, 'food_form_edit'])->name('food.form_edit');
    Route::put('/nutrition/food/edit/{id}', [FoodController::class, 'food_edit'])->name('food.edit');


    Route::get('/nutrition/meal', [MealController::class, 'meal_form'])->name('meal.create');
    Route::post('/nutrition/meal', [MealController::class, 'meal_form_store'])->name('meal.store');

    Route::post('/nutrition/meal/create_meal/{food_id}', [MealController::class, 'add_food_to_meal'])->name('meal.add_food');

    Route::get('/nutrition/meal/search_food/{query}', [MealController::class, 'search_food'])->name('meal.search_food');

    Route::get('/nutrition/meal/summary', [MealController::class, 'meal_form_submission'])->name('meal.create_p2');

    Route::get('/nutrition/meal/summary/edit/{meal_id}', [MealController::class, 'meal_form_edit_submission'])->name('meal.edit_p2');

    Route::get('/nutrition/meal/view', [MealController::class, 'meal_view'])->name('meal.view');

    
    Route::get('/nutrition/meal/view/statistics/{start_date}/{end_date}', [MealController::class, 'meal_view_stats'])->name('meal.view_stats');

    Route::get('/nutrition/body_stats', [BodyStatsController::class, 'body_stats_form'])->name('body_stats.form');

    Route::get('/exercise/create', [ExerciseController::class, 'exercise_form'])->name('exercise.form');

    Route::get('/get/meals/{start_date}/{end_date}', [MealController::class, 'get_meals_from_dates']);

    Route::get('/nutrition/meal/edit/{id}', [MealController::class, 'meal_edit_form'])->name('meal.edit_form');

    Route::put('/nutrition/meal/edit/{id}', [MealController::class, 'meal_edit'])->name('meal.edit');

    Route::post('/nutrition/body_stats', [BodyStatsController::class, 'body_stats_store'])->name('body_stats.store');

    Route::post('/exercise/create', [ExerciseController::class, 'exercise_store'])->name('exercise.store');

    Route::get('/nutrition/visualizer', [DashboardController::class, 'visualizer_show'])->name('visualizer.show');

    Route::get('/goals/create', [MacroController::class, 'goals_form'])->name('goals.form');

    Route::get('/water/create', [WaterController::class, 'water_form'])->name('water.form');

    Route::post('/water/store', [WaterController::class, 'water_store'])->name('water.store');

    Route::get('/sleep/create', [SleepController::class, 'sleep_form'])->name('sleep.form');

    Route::get('/nutrition/visualizer/load/{start_date}/{end_date}', [VisualizerController::class, 'visualizer_load'])->name('visualizer.load_dates');

    Route::get('/nutrition/visualizer/meal_widget_load/{id}', [VisualizerController::class, 'visualizer_mealwidget_load'])->name('visualizer.load_mealwidget');



    Route::get('/nutrition/notifications/load', [MealController::class, 'load_meal_notifications'])->name('notifications.meal');



    Route::get('/nutrition/notifications/load_count', [MealController::class, 'load_meal_notifications_count'])->name('notifications.meal_count');

    Route::get('/nutrition/compare', [FoodController::class, 'compare_form'])->name('compare.form');

    Route::get('/nutrition/compare/p2', [FoodController::class, 'compare_food'])->name('compare.food');

    Route::get('/components/meal_notifications/show/{id}', MealNotificationLivewire::class);

    Route::get('/nutrition/advanced', [DashboardController::class, 'advanced_menu'])->name('nutrition_advancedMenu');

    Route::get('/nutrition/advanced/suggester', [SuggesterController::class, 'suggester_form'])->name('advanced.suggester');

    Route::get('/nutrition/advanced/recipes', [RecipeController::class, 'recipe_form'])->name('advanced.suggester');

    // Route::get('/nutrition/ai/fake', [OpenAIController::class, 'fake_prompt'])->name('ai.fake_prompt');

    // Route::get('/nutrition/ai/real', [OpenAIController::class, 'real_prompt'])->name('ai.real_prompt');

    Route::post('/nutrition/ai/food_prompt/{name}/{serving_size}/{source}/{serving_unit}', [OpenAIController::class, 'food_prompt'])->name('ai.food_prompt');

    Route::get('/nutrition/testing/profanity', [ProfanityController::class, 'profanity_test']);
    
    Route::get('/changelog', [ChangelogController::class, 'changelog_view'])->name('changelog');

    Route::get('/function_test/{meal_id}', [DashboardController::class, 'get_nutrients_of_meal']);

    // Route::get('/function_test/{meal_id}/{meal_id_two}', [MealController::class, 'combine_two_meals']);

    // Route::get('/function_test_v2', [DashboardController::class, 'renderDailyMacroIntakeChart']);

    Route::post('/theme', [ThemeController::class, 'update'])->middleware('auth');
});

// Route::get('/nutrition/food', [FoodController::class, 'food_form'])
// ->middleware(['auth', 'verified'])
// ->name('nutrition_food');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
