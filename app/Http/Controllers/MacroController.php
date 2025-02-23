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
                $meal_dates_select_filterstr = "strftime('%Y-%m-%d', time_planned) as date";

        // Deployment MySQL Version
            // } else {
            //     $meal_dates_select_filterstr = "DATE_FORMAT(time_planned, '%Y-%m-%d') as date";
            
            // }

        $meal_dates_select = DB::table('meal')
                ->selectRaw($meal_dates_select_filterstr)
                ->where('user_id', $user_id)
                ->where('is_eaten', 1)
                ->whereBetween('date', [now()->subDays(28), now()])
                ->orderBy('time_planned', 'desc')
                ->limit(28)
                ->distinct()
                ->get();

        
        $last14Days = now()->subDays(28)->format('d/m/Y');
        $dateNow = now()->format('d/m/Y');

        $strLast14Days = "From $last14Days to $dateNow";

        $check_if_local = env('DB_CONNECTION') === 'sqlite';

        // dd(env('DB_CONNECTION'));
    

        // if ($check_if_local) {
            // Local Environment

            $meal_dates_select_filterstr = "strftime('%Y-%m-%d', time_planned) as date, time_planned";
            $exercise_dates_select_filterstr = "strftime('%Y-%m-%d', exercise_start) as date, exercise_start";

            $meal_dates_select =        DB::table('meal')
                                            ->selectRaw($meal_dates_select_filterstr)
                                            ->where('user_id', 1)
                                            ->where('is_eaten', 1)
                                            ->groupBy('time_planned')
                                            ->orderBy('time_planned', 'desc')
                                            ->distinct()
                                            ->limit(28)
                                            ->get();


        // } else {
        //     // Deployment Environment
        //     $meal_dates_select_filterstr = "DISTINCT DATE_FORMAT(time_planned, '%Y-%m-%d') as date, time_planned";
        //     $exercise_dates_select_filterstr = "DISTINCT DATE_FORMAT(exercise_start, '%Y-%m-%d') as date, exercise_start";
            
        //     $meal_dates_select =        DB::table('meal')
        //                                     ->selectRaw($meal_dates_select_filterstr)
        //                                     ->where('user_id', 1)
        //                                     ->where('is_eaten', 1)
        //                                     ->orderBy('time_planned', 'desc')
        //                                     ->limit(14)
        //                                     ->get();

        // }

        
        // dd($meal_dates_select);

        foreach ($meal_dates_select as $meal_date) {

            $meal_date = date('Y-m-d', strtotime($meal_date->date));

            // $meal_dates_ymd[$meal_date] = '';
            

            /* Data Structure Breakdown.

                

            */
            // $meal_dates_ymd[0][$meal_date]['meal_name'] = $meal_dates_select->


  
            if($meal_dates_ymd[0][$meal_date] ?? "") {
                $meal_dates_ymd[0][$meal_date]['calories'] = 0;
                $meal_dates_ymd[1]['calories_avg'] = [];
            } else {
                $meal_dates_ymd[0][$meal_date]['calories'] = 0;
                $meal_dates_ymd[1]['calories_avg'] = [];
            }

            $meal_dates_ymd[0][$meal_date]['fat'] = 0;
            $meal_dates_ymd[0][$meal_date]['carbs'] = 0;
            $meal_dates_ymd[0][$meal_date]['protein'] = 0;
            $meal_dates_ymd[0][$meal_date]['times_planned'] = [];
            $meal_dates_ymd[0][$meal_date]['serving_size'] = 0;
            $meal_dates_ymd[0][$meal_date]['serving_unit_short'] = "";


            $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$meal_date . ' 00:00:00', $meal_date . ' 23:59:59'])
                            ->where('is_eaten', 1)
                            ->orderByRaw('time_planned ASC')

                            ->get();


            
            foreach($meal_select as $meal_date=>$meal) {
                
                $meal_items_select = MealItems::where('meal_id', $meal->id)
                                        ->get();

                $meal_date = date('Y-m-d', strtotime($meal->time_planned));

                $meal_time = date('H:i:s', strtotime($meal->time_planned));

                

                // Push times planned so we can go through the process
                array_push($meal_dates_ymd[0][$meal_date]['times_planned'], $meal_time);
                
                
                $meal_dates_ymd[0][$meal_date][$meal_time]['serving_size'] = round($meal->serving_size ?? 1 * $meal->quantity ?? 1, 2);
            
                


                // $meal_dates_ymd[$meal_date]['meal_date'] = $meal_date;
                // $meal_dates_ymd[$meal_date]['time_planned'] = date('H:i', strtotime($meal->time_planned));
                $meal_dates_ymd[0][$meal_date][$meal_time]['meal_name'] = $meal->name;
                $meal_dates_ymd[0][$meal_date][$meal_time]['meal_id'] = $meal->id;
                
                // $meal_dates_ymd[$meal_date]['calories'] = 0;
                // $meal_dates_ymd[$meal_date]['fat'] = 0;
                // $meal_dates_ymd[$meal_date]['carbs'] = 0;
                // $meal_dates_ymd[$meal_date]['protein'] = 0;

                $meal_dates_ymd[0][$meal_date][$meal_time]['calories'] = 0;
                $meal_dates_ymd[0][$meal_date][$meal_time]['fat'] = 0;
                $meal_dates_ymd[0][$meal_date][$meal_time]['carbs'] = 0;
                $meal_dates_ymd[0][$meal_date][$meal_time]['protein'] = 0;

                $meal_dates_ymd[0][$meal_date][$meal_time]['serving_unit_short'] = "";
                                        
                foreach($meal_items_select as $food_index=>$meal_item) {




                    // get specific nutrients of food
                    $foods = Macronutrients::where('food_id', $meal_item->food_id)
                                                ->get();
                    
                    // $meal_dates_ymd['name'] = $food_index;                         
                    
                    $food_img = DB::table('food')
                                    ->select('img_url')
                                    ->where("id", "=", $meal_item->food_id)
                                    ->get();

                    // $meal_portion = (float)$meal_item->serving_size*$meal_item->quantity;

                    // $meal_dates_ymd[0][$meal_date][$meal_time]['serving_size'] 

                    
                     

                    foreach($foods as $food) {
                        // $meal_dates_ymd[$food_index]['calories'] = $food->calories;

                        // $meal_dates_ymd[$food_index]['serving_size_food'] = $food->serving_size;

                        // $meal_dates_ymd[$food_index]['serving_size_meal'] = $meal_item->serving_size;

                        // $meal_dates_ymd[$food_index]['time_planned'] = $meal->time_planned;

                        
                         $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['serving_unit_short'] = FoodUnit::find($meal_item->food_unit_id)->short_name;
        

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['img_url'] = $food_img[0];

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['food_id'] = $meal_item->food_id; 

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['food_name'] = $meal_item->name; 

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['calories'] = (int)(($food->calories /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity;

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['serving_size'] = $meal_item->serving_size;

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['quantity'] = $meal_item->quantity;

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['serving_x_quantity'] = round($meal_item->serving_size*$meal_item->quantity, 0);

                        

                        $meal_dates_ymd[0][$meal_date]['calories'] += round((($food->calories /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 0);

                   

                        $meal_dates_ymd[0][$meal_date][$meal_time]['calories'] += round((($food->calories /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 0);

                        
                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['fat'] = round((($food->fat /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time]['fat'] += round((($food->fat /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);


                        $meal_dates_ymd[0][$meal_date]['fat'] += round((($food->fat /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        // $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['fat'] += round((($food->fat /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['carbs'] = round((($food->carbohydrates /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        $meal_dates_ymd[0][$meal_date]['carbs'] += round((($food->carbohydrates /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);


                        $meal_dates_ymd[0][$meal_date][$meal_time]['carbs'] += round((($food->carbohydrates /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['protein'] = round((($food->protein /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        $meal_dates_ymd[0][$meal_date]['protein'] += round((($food->protein /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time]['protein'] += round((($food->protein /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                   
                    }  

            
                    // Rounding the numbers to prevent trailing decimals.

                    // $meal_dates_ymd[$meal_date]['calories'] = round($meal_dates_ymd[$meal_date]['calories'], 0);
                    // $meal_dates_ymd[$meal_date]['fat'] = round($meal_dates_ymd[$meal_date]['fat'], 1);
                    // $meal_dates_ymd[$meal_date]['carbs'] = round($meal_dates_ymd[$meal_date]['carbs'], 1);
                    // $meal_dates_ymd[$meal_date]['protein'] = round($meal_dates_ymd[$meal_date]['protein'], 1);

                    $meal_dates_ymd[0][$meal_date]['calories'] = round($meal_dates_ymd[0][$meal_date]['calories'], 0);
                    $meal_dates_ymd[0][$meal_date]['fat'] = round($meal_dates_ymd[0][$meal_date]['fat'], 1);
                    $meal_dates_ymd[0][$meal_date]['carbs'] = round($meal_dates_ymd[0][$meal_date]['carbs'], 1);
                    $meal_dates_ymd[0][$meal_date]['protein'] = round($meal_dates_ymd[0][$meal_date]['protein'], 1);
                    
                    $meal_dates_ymd[0][$meal_date][$meal_time]['calories'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['calories'], 0);
                    $meal_dates_ymd[0][$meal_date][$meal_time]['fat'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['fat'], 1);
                    $meal_dates_ymd[0][$meal_date][$meal_time]['carbs'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['carbs'], 1);
                    $meal_dates_ymd[0][$meal_date][$meal_time]['protein'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['protein'], 1);
                    
                    array_push($meal_dates_ymd[1]['calories_avg'], $meal_dates_ymd[0][$meal_date]['calories']);
                }       

               
            }

        }
    
        dd($meal_dates_ymd);

        return view('goals_form', ['meal_dates' => $meal_dates_select, 'last14Days' => $strLast14Days]);


    }
}
