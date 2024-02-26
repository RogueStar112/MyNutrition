<?php

namespace App\Http\Controllers;

use App\View\Components\MealSearchItem;
use App\View\Components\MealFoodItem;

use Illuminate\Http\Request;
use Carbon\Carbon;


use Auth;



use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;

use App\Models\Macronutrients;

use App\Models\Meal;
use App\Models\MealItems;


class DashboardController extends Controller
{   
    

    public function dashboard_stats($start_date, $end_date) {
        
        $user_id = Auth::user()->id;

        $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                            ->orderByRaw('time_planned ASC')
                            ->get();

        $meal_items_array = [];

        $meal_items_names = [];

        $meal_macro_calculations = [];

        for ($meal=0; $meal < count($meal_select); $meal++) {


            $meal_items_select = MealItems::where('meal_id', $meal_select[$meal]->id)
                                            ->get();

            $meal_items_array[$meal_select[$meal]->time_planned] = $meal_items_select;

            $meal_items_names[$meal_select[$meal]->time_planned]["meal_name"] = $meal_select[$meal]->name;
            // $meal_items_array[$meal_select[$meal]->time_planned][$meal] = $meal_items_select;

            $meal_items_names[$meal_select[$meal]->time_planned]["is_eaten"] = $meal_select[$meal]->is_eaten;
            

        } 

        // return $meal_items_array;
        
        // return view('nutrition_meal_view_statistics', ['meals' => $meal_select]);

        $meal_items_array_keys = array_keys($meal_items_array);

        // return $meal_items_array_keys;

        for ($x = 0; $x < count($meal_items_array); $x++) {

             $meal_macro_calculations[$meal_items_array_keys[$x]] = [];

            $macro_totals = array(
                "fat" => 0,
                "calories" => 0,
                "carbohydrates" => 0,
                "protein" => 0
            );

        //    return  $meal_items_array[$meal_items_array_keys[$x]] 
            for ($y = 0; $y < count($meal_items_array[$meal_items_array_keys[$x]]); $y++) {


                // create an empty array for each different date-time
               
                
                // create an empty cell for each meal-item.

                // FOOD ITEM: $meal_items_array[$meal_items_array_keys[$x]][$y]->id


                if (isset($meal_items_array[$meal_items_array_keys[$x]][$y])) {

                    $meal_item_to_calculate = $meal_items_array[$meal_items_array_keys[$x]][$y];
                    $food_id = $meal_item_to_calculate->food_id;
                    $serving_size = $meal_item_to_calculate->serving_size;
                    $quantity = $meal_item_to_calculate->quantity;
                
                    $macros = [];


                    $macro_select = Macronutrients::where('food_id', $food_id)
                                        ->get();



                    $macros['serving_size'] = $macro_select[0]->serving_size ? $macro_select[0]->serving_size : 1 ;
                    $macros['quantity'] = $quantity;

                    $macros['fat'] = round((float)($macro_select[0]->fat / $macros['serving_size']) * $serving_size * $quantity, 1);
                    $macros['calories'] = round((float)($macro_select[0]->calories / $macros['serving_size']) * $serving_size * $quantity, 1);
                    $macros['carbohydrates'] = round((float)($macro_select[0]->carbohydrates / $macros['serving_size']) * $serving_size * $quantity, 1);
                    $macros['protein'] = round((float)($macro_select[0]->protein / $macros['serving_size']) * $serving_size * $quantity, 1);

                    $macro_totals['fat'] += $macros['fat'];
                    $macro_totals['calories'] += $macros['calories'];
                    $macro_totals['carbohydrates'] += $macros['carbohydrates'];
                    $macro_totals['protein'] += $macros['protein'];
                    

 
                    $meal_macro_calculations[$meal_items_array_keys[$x]][$y] = $macros;
                    $meal_macro_calculations[$meal_items_array_keys[$x]]['total'] = $macro_totals;
                } else {
                    $meal_macro_calculations[$meal_items_array_keys[$x]][$y] = "irrelevant";
                }



                // $meal_macro_calculations[$meal_items_array_keys[$x]][$y] = $meal_items_array[$meal_items_array_keys[$x]][$y];

                // $meal_items_array[$meal_items_array_keys[$x]][$y] = [];

            } 


        }

        return $meal_macro_calculations;

        // return $meal_items_array;

    }
}
