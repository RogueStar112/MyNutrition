<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Auth;

use App\Models\MealNotifications;

use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            $user_id = Auth::user()->id;

            $get_all_mealids_from_user = DB::table('meal')
                                            ->select('id')
                                            ->where('user_id', $user_id)
                                            ->where('is_eaten', 0)
                                            ->orderBy('id', 'desc')
                                            ->get();

            $mealNotifications = [];


            foreach ($get_all_mealids_from_user as $index => $meal_id) {

                $mealNotifications[$index+1] = DB::table('meal_notifications')->select('id', 'message')->where('meal_id', $meal_id->id)->first() ?? ['id' => 1];
                

            }

      
            $view->with('mealNotifications', $mealNotifications);
        });
    }
}
