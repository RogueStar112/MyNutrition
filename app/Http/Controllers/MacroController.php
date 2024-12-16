<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;
use App\Models\Macronutrients;
use App\Models\Micronutrients;
use App\Models\Meal;
use App\Models\MealItems;
use App\Models\MealNotifications;

use Auth;

use Carbon;

use Illuminate\Support\Facades\DB;


class MacroController extends Controller
{
    public function goals_form(Request $request) {

        $user_id = Auth::user()->id;

        $check_if_local = env('DB_CONNECTION') === 'sqlite';
        
        // Local SQLite Version
        // if ($check_if_local) {
        // $meal_dates_select_filterstr = "strftime('%Y-%m-%d', time_planned) as date";

        // Deployment MySQL Version
        // } else {
            $meal_dates_select_filterstr = "DISTINCT DATE_FORMAT(time_planned, '%Y-%m-%d') as date";
        
        // }

        $meal_dates_select = DB::table('meal')
                ->selectRaw($meal_dates_select_filterstr)
                ->where('user_id', $user_id)
                ->where('is_eaten', 1)
                ->whereBetween('date', [now()->subDays(14), now()])
                ->orderBy('time_planned', 'desc')
                ->limit(14)
                ->distinct()
                ->get();

        
        $last14Days = now()->subDays(14)->format('d/m/Y');
        $dateNow = now()->format('d/m/Y');

        $strLast14Days = "From $last14Days to $dateNow";

        
        return view('goals_form', ['meal_dates' => $meal_dates_select, 'last14Days' => $strLast14Days]);


    }
}
