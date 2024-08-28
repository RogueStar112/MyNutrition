<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Auth;

use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;

use App\Models\Macronutrients;

use App\Models\Meal;
use App\Models\MealItems;

use Illuminate\Support\Facades\DB;


class VisualizerController extends Controller
{
    //

    public function visualizer_load($start_date, $end_date) {

        $user_id = Auth::user()->id;


        $tasks = DB::table('meal')
                    ->where('user_id', '=', $user_id)
                    ->whereBetween('time_planned', [date("$start_date 00:00:00"), date("$end_date 23:59:59")])
                    ->groupBy('time_planned')
                    ->orderBy('time_planned', 'asc')
                    ->get();

        $taskData = [];

        function get_calorie_sum_of_meal($meal_id) {

            $meal_items_of_task = DB::table('meal_items')
                                    ->where('meal_id', '=', $meal_id)
                                    ->get();
            
            // $macronutrients_of_meal;

            $calorie_total = 0;
            
            foreach($meal_items_of_task as $meal_item_index=>$meal_item) {

                $meal_item_macros = DB::table('macronutrients')
                                    ->where('food_id', '=', $meal_item->food_id)
                                    ->get();

                foreach($meal_item_macros as $meal_item_macro) {

                    $calorie_total += round((($meal_item_macro->calories / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                
                }

            }

            return $calorie_total;
        

        }

        

        foreach($tasks as $task) {
            $date = Carbon::parse($task->time_planned)->format('d/m/Y');

            $calorie_sum = get_calorie_sum_of_meal($task->id);

            $calorie_limit = 2500;

            $meal_time_multiplier = round(($calorie_sum/$calorie_limit)*24, 0);


            // Check if the date already exists in the taskData array
            if (!isset($taskData[$date])) {
                $taskData[$date] = []; 
            }
            
            $taskData_setup = array(
                "id" => $task->id,
                "date" => Carbon::parse($task->time_planned)->format('d/m/Y h:i'),
                "date_short" => Carbon::parse($task->time_planned)->format('d/m/Y'),
                "task" => $task->name,
                "description" => "...",
                "time_start" => Carbon::parse($task->time_planned)->format('H'),
                "time_end" => Carbon::parse($task->time_planned)->add("$meal_time_multiplier hours")->format('H'), 
                // (int)$task->time_planned+(int)$meal_time_multiplier
                "bg_color" => "EE0000"
            );

            $taskData[$date][] = $taskData_setup;

        }

        return $taskData;

        

    }

    public function visualizer_mealwidget_load($id) {
        
        $user_id = Auth::user()->id;
        /* 
            Breakdown of algorithm:
            1. Get id of meal [x]
            2. Use that id to get the following:
                2.1) Calories
                2.2) Fat
                2.3) Carbs
                2.4) Protein
            
            3. Prepopulate the following widgets:
               3.1) Meal Summary Breakdown (Invoked when switching pages)
               3.2) Meal Item Breakdown (Invoked when clicking on a meal event)
               3.3 
            
        */

        // verify that the meal even exists
        $meal_selected = Meal::find($id);

        $meal_items_of_task = DB::table('meal_items')
                                    ->where('meal_id', '=', $meal_selected->id)
                                    ->get();

        

        function get_macro_sum_of_meal($meal_id) {

            $meal_items_of_task = DB::table('meal_items')
                                    ->where('meal_id', '=', $meal_id)
                                    ->get();
            
            // $macronutrients_of_meal;

            $calorie_total = 0;
            $fat_total = 0;
            $carbs_total = 0;
            $protein_total = 0;
            
            foreach($meal_items_of_task as $meal_item_index=>$meal_item) {

                $meal_item_macros = DB::table('macronutrients')
                                    ->where('food_id', '=', $meal_item->food_id)
                                    ->get();

                foreach($meal_item_macros as $meal_item_macro) {

                    $calorie_total += round((($meal_item_macro->calories / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                    $fat_total += round((($meal_item_macro->fat / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                    $carbs_total += round((($meal_item_macro->carbohydrates / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                    $protein_total += round((($meal_item_macro->protein / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                
                }

            }

            $macro_total = [

                'calories' => $calorie_total,
                'fat' => $fat_total,
                'carbs' => $carbs_total,
                'protein' => $protein_total

            ];

            return $macro_total;
        

        }

        function get_macro_breakdown_of_meal($meal_id) {
            $meal_items_of_task = DB::table('meal_items')
            ->where('meal_id', '=', $meal_id)
            ->get();

            // $macronutrients_of_meal;

            $macro_breakdown = array();

                foreach($meal_items_of_task as $meal_item_index=>$meal_item) {

                $meal_item_macros = DB::table('macronutrients')
                            ->where('food_id', '=', $meal_item->food_id)
                            ->get();

                foreach($meal_item_macros as $meal_item_macro) {
                    
                    $macro_breakdown[$meal_item->name]['img_url'] = asset(Food::find($meal_item->food_id)->img_url) ? asset(Food::find($meal_item->food_id)->img_url) : asset('public\storage\images\food\itemnotfound.png');
                    $macro_breakdown[$meal_item->name]['food_id'] = $meal_item_macro->food_id;
                    $macro_breakdown[$meal_item->name]['calories'] = round((($meal_item_macro->calories / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                    $macro_breakdown[$meal_item->name]['fat'] = round((($meal_item_macro->fat / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                    $macro_breakdown[$meal_item->name]['carbs'] = round((($meal_item_macro->carbohydrates / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);
                    $macro_breakdown[$meal_item->name]['protein'] = round((($meal_item_macro->protein / $meal_item_macro->serving_size)*$meal_item->serving_size*$meal_item->quantity), 0);

                }

                

            }

            return $macro_breakdown;
        }


        return ['name' => $meal_selected->name, 'breakdown' => get_macro_breakdown_of_meal($meal_selected->id), 'total' => get_macro_sum_of_meal($meal_selected->id)];

    }
}
