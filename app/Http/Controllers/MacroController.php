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

use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\DB;


class MacroController extends Controller
{
    public function get_nutrients_of_meal($meal_id) {

        $meal_items = MealItems::where('meal_id', $meal_id)
                                ->get();

        // dd($meal_items);

        $meal = Meal::where('id', $meal_id)
                            ->first();

        $meal_name = $meal?->name;
        $meal_time = $meal?->time_planned;


        $meal_array = [];

        $macros = [];
        $micros = [];

        foreach($meal_items as $meal_item) {

            $macros[] = DB::table('macronutrients')
            ->join('meal_items', 'macronutrients.food_id', '=', 'meal_items.food_id')
            ->select(
                'macronutrients.food_id',
                'meal_items.name', // Keep non-numeric columns as-is
                'meal_items.serving_size',
                DB::raw('ROUND((macronutrients.calories * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 0) AS calories'),
                DB::raw('ROUND((macronutrients.protein * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS protein'),
                DB::raw('ROUND((macronutrients.carbohydrates * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS carbohydrates'),
                DB::raw('ROUND((macronutrients.fat * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS fat')
            )
            ->where('macronutrients.food_id', '=', $meal_item->food_id)
            ->where('meal_items.meal_id', '=', $meal_item->meal_id)
            ->first();

            $micros[] = DB::table('macronutrients')
            ->join('meal_items', 'macronutrients.food_id', '=', 'meal_items.food_id')
            ->join('micronutrients', 'micronutrients.food_id', '=', 'meal_items.food_id')
            ->select(
                'macronutrients.food_id',
                'meal_items.name', // Keep non-numeric columns as-is
                DB::raw('ROUND((micronutrients.sugars * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS sugars'),
                DB::raw('ROUND((micronutrients.saturates * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS saturates'),
                DB::raw('ROUND((micronutrients.fibre * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS fibre'),
                DB::raw('ROUND((micronutrients.salt * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 2) AS salt')
            )
            ->where('macronutrients.food_id', '=', $meal_item->food_id)
            ->where('meal_items.meal_id', '=', $meal_item->meal_id)
            ->first();
            
        }
        
        $macro_totals = [];
        $micro_totals = [];

        foreach($macros as $macro) {


            if(isset($macro)) {
                $macro_totals['calories'] = ($macro_totals['calories'] ?? 0) + $macro->calories;
                $macro_totals['carbohydrates'] = ($macro_totals['carbohydrates'] ?? 0) + $macro->carbohydrates;
                $macro_totals['fat'] = ($macro_totals['fat'] ?? 0) + $macro->fat;
                $macro_totals['protein'] = ($macro_totals['protein'] ?? 0) + $macro->protein;
            }
        }

        foreach($micros as $micro) {
            if(isset($micro)) {
                $micro_totals['sugars'] = ($micro_totals['sugars'] ?? 0) + $micro->sugars;
                $micro_totals['saturates'] = ($micro_totals['saturates'] ?? 0) + $micro->saturates;
                $micro_totals['fibre'] = ($micro_totals['fibre'] ?? 0) + $micro->fibre;
                $micro_totals['salt'] = ($micro_totals['salt'] ?? 0) + $micro->salt;
            }
        }

        $nutrients = array_merge($macro_totals, $micro_totals);

        $nutrients['meal_name'] = $meal_name;
        $nutrients['meal_time'] = $meal_time;

        return ['nutrients' => $nutrients, 'macros' => $macros, 'micros' => $micros];
 
    }

    public function goals_form(Request $request) {

        $user_id = Auth::user()->id;

        // last 30 meals within 10 weeks

        $start = Carbon::now()->subWeeks(10);
        $end = Carbon::now();

        $last_ten_meals = Meal::where('time_planned', '<=', $end)
                            ->where('time_planned', '>=', $start)
                            ->where('user_id', '=', $user_id)
                            ->where('is_eaten', '=', 1)
                            ->orderBy('time_planned', 'desc')
                            ->limit(30)
                            ->get();

        $last_ten_meals_array = [
            'dates' => [],
            'names' => [],
            'calories' => [],
            'fat' => [],
            'carbs' => [],
            'protein' => [],
            'macros' => [],
            'micros' => [],
            'sugars' => [],
            'saturates' => [],
            'fibre' => [],
            'salt' => []
        ];

        foreach($last_ten_meals as $meal) {  
            $key = date('Y-m-d H:i:s', strtotime($meal->time_planned));
            $key_ymd = date('Y-m-d', strtotime($meal->time_planned));

            // Initialize only if not already set
            if (!isset($last_ten_meals_array['dates'][$key_ymd])) {
                $last_ten_meals_array['dates'][$key_ymd] = [];
            }

            if (!isset($last_ten_meals_array['names'][$key])) {
                $last_ten_meals_array['names'][$key] = [];
            }

            
            $last_ten_meals_array['dates'][$key_ymd][] = $key;
            $last_ten_meals_array['names'][$key][] = $this->get_nutrients_of_meal($meal->id)['nutrients']['meal_name'];




             $last_ten_meals_array['calories'][$key] = ($last_ten_meals_array['calories'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['calories'] ?? 0);
             $last_ten_meals_array['fat'][$key] = ($last_ten_meals_array['fat'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['fat'] ?? 0);
             $last_ten_meals_array['carbs'][$key] = ($last_ten_meals_array['carbs'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['carbohydrates'] ?? 0);
             $last_ten_meals_array['protein'][$key] = ($last_ten_meals_array['protein'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['protein'] ?? 0);

            $last_ten_meals_array['saturates'][$key] = ($last_ten_meals_array['saturates'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['saturates'] ?? 0);
            $last_ten_meals_array['sugars'][$key] = ($last_ten_meals_array['sugars'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['sugars'] ?? 0);
            $last_ten_meals_array['fibre'][$key] = ($last_ten_meals_array['fibre'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['fibre'] ?? 0);
            $last_ten_meals_array['salt'][$key] = ($last_ten_meals_array['salt'][$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['salt'] ?? 0);
            
            
             $last_ten_meals_array['macros'][$key] = $this->get_nutrients_of_meal($meal->id)['macros'];
             $last_ten_meals_array['micros'][$key] = $this->get_nutrients_of_meal($meal->id)['micros'];
         }

        //  dd($last_ten_meals_array);


        $meals_calories = array_values($last_ten_meals_array['calories']);
        $meals_dates = array_values($last_ten_meals_array['dates']);

        $meals_fat = array_values($last_ten_meals_array['fat']);
        $meals_carbs = array_values($last_ten_meals_array['carbs']);
        $meals_protein = array_values($last_ten_meals_array['protein']);


        $average_macros = [
            'calories' => round(array_sum($meals_calories) / count($meals_dates), 0),
            'fat' => round(array_sum($meals_fat) / count($meals_dates), 0),
            'carbs' => round(array_sum($meals_carbs) / count($meals_dates), 0),
            'protein' => round(array_sum($meals_protein) / count($meals_dates), 0),
        ];

        return view('goals_form', ['average_macros' => $average_macros]);


    }
}
