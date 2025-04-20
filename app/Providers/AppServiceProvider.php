<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Auth;

use Carbon\Carbon;

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
            
            $now = Carbon::now()->format('Y-m-d H:i:s');

            $user_id = Auth::user()->id;

            $get_all_mealids_from_user = DB::table('meal')
                                            ->select('id')
                                            ->where('user_id', $user_id)
                                            ->where('is_eaten', 0)
                                            ->orderBy('id', 'desc')
                                            ->get();

            $mealNotifications = [];


            foreach ($get_all_mealids_from_user as $index => $meal_id) {

                // $mealNotifications[$index+1] = DB::table('meal_notifications')->select('id', 'meal_id', 'message', 'type')->where('meal_id', $meal_id->id)->first() ?? null;
                
                $meal_notifications_search = DB::table('meal_notifications')->select('id', 'meal_id', 'message', 'type')->where('meal_id', $meal_id->id)->orderBy('created_at', 'asc')->get() ?? null;
                
                foreach ($meal_notifications_search as $notification) {

                    $mealNotifications[$index+1][$notification->type] = $notification;

                }

            }

            // dd($mealNotifications);

            
            $view->with('mealNotifications', $mealNotifications);


        });

        // MOBILE NOTIFICATIONS 
        View::composer('layouts.app', function ($view) {
            
            $now = Carbon::now()->format('Y-m-d H:i:s');

            $user_id = Auth::user()->id;

            $get_all_mealids_from_user = DB::table('meal')
                                            ->select('id')
                                            ->where('user_id', $user_id)
                                            ->where('is_eaten', 0)
                                            ->orderBy('id', 'desc')
                                            ->get();

            $mealNotifications = [];


            foreach ($get_all_mealids_from_user as $index => $meal_id) {

                // $mealNotifications[$index+1] = DB::table('meal_notifications')->select('id', 'meal_id', 'message', 'type')->where('meal_id', $meal_id->id)->first() ?? null;
                
                $meal_notifications_search = DB::table('meal_notifications')->select('id', 'meal_id', 'message', 'type')->where('meal_id', $meal_id->id)->orderBy('created_at', 'asc')->get() ?? null;
                
                foreach ($meal_notifications_search as $notification) {

                    $mealNotifications[$index+1][$notification->type] = $notification;

                }

            }

            // dd($mealNotifications);

            
            $view->with('mealNotifications', $mealNotifications);

            
        });
    }
}
