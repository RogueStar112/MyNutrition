<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Meal;
use App\Models\MealItems;

use Auth;

use App\Models\MealNotifications;

use Illuminate\Support\Facades\DB;

class LoadMealNotifications extends Component
{   
    public $mealNotifications = [];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications() {
        $user_id = Auth::user()->id;

        $get_all_mealids_from_user = DB::table('meal')
                                        ->select('id')
                                        ->where('user_id', $user_id)
                                        ->where('is_eaten', 0)
                                        ->orderBy('id', 'desc')
                                        ->get();

        // dd($get_all_mealids_from_user);

        // $meal_notifications_array[$user_id] = [];

        foreach ($get_all_mealids_from_user as $index => $meal_id) {

            $mealNotifications[] = DB::table('meal_notifications')->select('id', 'message')->where('meal_id', $meal_id->id)->first();
            

        }

        return $mealNotifications;

    }

    public function render()
    {
        return view('livewire.load-meal-notifications');
    }
}
