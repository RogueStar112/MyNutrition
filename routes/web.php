<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/nutrition', function () {
    return view('nutrition');
})->middleware(['auth', 'verified'])->name('nutrition_mainMenu');


Route::middleware('auth')->group(function () {
    Route::get('/nutrition/food', [FoodController::class, 'food_form'])->name('food.create');
    Route::post('/nutrition/food', [FoodController::class, 'food_form_store'])->name('food.store');
    Route::post('/nutrition/food/create_page', [FoodController::class, 'create_new_food_page'])->name('food.page_create');
    Route::post('/nutrition/food/create_item', [FoodController::class, 'create_new_food_item'])->name('food.item_create');
    // Route::put('/nutrition/food', [FoodController::class, 'food_edit'])->name('food.edit');
    // Route::delete('/nutrition/food', [FoodController::class, 'food_delete'])->name('food.delete');

    Route::get('/nutrition/food/view', [FoodController::class, 'food_view'])->name('food.view');
    Route::get('/nutrition/food/edit/{id}', [FoodController::class, 'food_form_edit'])->name('food.form_edit');
    Route::put('/nutrition/food/edit/{id}', [FoodController::class, 'food_edit'])->name('food.edit');


    Route::get('/nutrition/meal', [MealController::class, 'meal_form'])->name('meal.create');
    
    Route::post('/nutrition/meal/create_meal/{food_id}', [MealController::class, 'add_food_to_meal'])->name('meal.add_food');

    Route::post('/nutrition/meal/search_food/{query}', [MealController::class, 'search_food'])->name('meal.search_food');
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
