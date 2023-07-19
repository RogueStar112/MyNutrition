<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodController;
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
