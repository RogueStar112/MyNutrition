<?php

namespace App\Http\Controllers;

use App\View\Components\MealSearchItem;
use App\View\Components\MealFoodItem;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Auth;

use App\Models\User;



use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;

use App\Models\Macronutrients;
use App\Models\Micronutrients;

use App\Models\Meal;
use App\Models\MealItems;

use App\Models\UserHealthLogs;

use App\Http\Traits\CalendarGenerator;

use App\Http\Controllers\MealController;

use Illuminate\Support\Collection;

use IcehouseVentures\LaravelChartjs\Facades\Chartjs;


class DashboardController extends Controller
{   
    
    use CalendarGenerator;

    public function get_nutrients_of_meal($meal_id) {

        $meal_items = MealItems::where('meal_id', $meal_id)
                                ->get();

        $meal = Meal::where('id', $meal_id)
                            ->first();

        $meal_name = $meal?->name;
        $meal_time = $meal?->time_planned;


        $meal_array = [];

        $macros = [];
        $micros = [];

        foreach($meal_items as $meal_item) {

            $macros[$meal_item->name] = Macronutrients::where('food_id', $meal_item->food_id)?->first();

            $micros[$meal_item->name] = Micronutrients::where('food_id', $meal_item->food_id)?->first();

        }

        $macro_totals = [];
        $micro_totals = [];

        foreach($macros as $macro) {
            if(isset($macro)) {
                $macro_totals['calories'] = ($macro_totals['calories'] ?? 0) + $macro['calories'];
                $macro_totals['carbohydrates'] = ($macro_totals['carbohydrates'] ?? 0) + $macro['carbohydrates'];
                $macro_totals['fat'] = ($macro_totals['fat'] ?? 0) + $macro['fat'];
                $macro_totals['protein'] = ($macro_totals['protein'] ?? 0) + $macro['protein'];
            }
        }

        foreach($micros as $micro) {
            if(isset($micro)) {
                $micro_totals['sugars'] = ($micro_totals['sugars'] ?? 0) + $micro['sugars'];
                $micro_totals['saturates'] = ($micro_totals['saturates'] ?? 0) + $micro['saturates'];
                $micro_totals['fibre'] = ($micro_totals['fibre'] ?? 0) + $micro['fibre'];
                $micro_totals['salt'] = ($micro_totals['salt'] ?? 0) + $micro['salt'];
            }
        }

        $nutrients = array_merge($macro_totals, $micro_totals);

        $nutrients['meal_name'] = $meal_name;
        $nutrients['meal_time'] = $meal_time;

        return $nutrients;
 
    }

    public function renderDailyMacroIntakeChart() {

        $user_id = Auth::user()->id;

        $start = Carbon::now()->subWeeks(3);
        $end = Carbon::now();

        $period = CarbonPeriod::create($start, "1 month", $end);

        $meals_calories = [];

        $meals_dates = [];

        

        // $meal_select = Meal::where('time_planned', '<=', $date)
        // ->where('user_id', '=', $user_id)
        // ->get();

        $meal_select = Meal::where('time_planned', '<=', $end)
                        ->where('time_planned', '>=', $start)
                        ->where('user_id', '=', $user_id)
                        ->where('is_eaten', '=', 1)
                        ->orderBy('time_planned', 'asc')
                        ->get();

        foreach($meal_select as $meal) {    

            $key = date('Y-m-d', strtotime($meal->time_planned));
            $meals_calories[$key] = ($meals_calories[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['calories'] ?? 0);

        }

        foreach($meal_select as $meal) {    

            $key = date('Y-m-d', strtotime($meal->time_planned));
            $meals_dates[$key] = $key ?? "";

        }

        // dd(array_values($meals_calories), array_values($meals_dates));

        $meals_calories = array_values($meals_calories);
        $meals_dates = array_values($meals_dates);

        // dd($meals_dates);
        
        $chart = Chartjs::build()
            ->name("MacroIntakeChart")
            ->size(["width" => 600, "height" => 300])
            ->labels($meals_dates)
            ->datasets([
                [
                    "label" => "Calories (kcal)",
                    "type" => "bar",
                    "backgroundColor" => "rgba(255, 200, 0, 1)",
                    "borderColor" => "rgba(255, 200, 0, 1)",
                    "data" => $meals_calories
                ],
            ])
            ->options([
                'labels' => [
                    'color' => 'white',
                    'style' => 'Montserrat'
                ],

                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'month'
                        ],
                        'ticks' => [
                            'color' => 'white'
                        ],

                        'grid' => [
                            'color' => 'grey'
                        ],
                        'min' => $start->format("Y-m-d"),
                    ],

                    'y' => [
                        'min' => min($meals_calories),
                        'max' => max($meals_calories) + 100,
                        'ticks' => [
                            'color' => 'white'
                        ],

                        'grid' => [
                            'color' => 'grey'
                        ],
                    ]
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Body Stats'
                    ],

                    'legend' => [
                        'labels' => [
                            'color' => 'white'
                        ]
                    ],
                ]
            ]);

        return view("dashboard", compact("chart"));



    }

    public function dashboard_view() {
        $user_id = Auth::user()->id;

        $start = Carbon::now()->subWeeks(6);
        $end = Carbon::now();

        $period = CarbonPeriod::create($start, "1 month", $end);

        $meals_calories = [];

        $meals_dates = [];

        

        // $meal_select = Meal::where('time_planned', '<=', $date)
        // ->where('user_id', '=', $user_id)
        // ->get();

        $meal_select = Meal::where('time_planned', '<=', $end)
                        ->where('time_planned', '>=', $start)
                        ->where('user_id', '=', $user_id)
                        ->where('is_eaten', '=', 1)
                        ->orderBy('time_planned', 'asc')
                        ->get();

        foreach($meal_select as $meal) {    

            $key = date('Y-m-d', strtotime($meal->time_planned));
            $meals_calories[$key] = ($meals_calories[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['calories'] ?? 0);

        }

        foreach($meal_select as $meal) {    

            $key = date('Y-m-d', strtotime($meal->time_planned));
            $meals_dates[$key] = $key ?? "";

        }

        // dd(array_values($meals_calories), array_values($meals_dates));

        $meals_calories = array_values($meals_calories);
        $meals_dates = array_values($meals_dates);

        // dd($meals_dates);
        
        $chart = Chartjs::build()
            ->name("MacroIntakeChart")
            ->size(["width" => 600, "height" => 300])
            ->labels($meals_dates)
            ->datasets([
                [
                    "label" => "Calories (kcal)",
                    "type" => "bar",
                    "backgroundColor" => "rgba(255, 200, 0, 1)",
                    "borderColor" => "rgba(255, 200, 0, 1)",
                    "data" => $meals_calories
                ],
            ])
            ->options([
                'labels' => [
                    'color' => 'white',
                    'style' => 'Montserrat'
                ],

                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'month'
                        ],
                        'ticks' => [
                            'color' => 'white'
                        ],

                        'grid' => [
                            'color' => 'grey'
                        ],
                        'min' => $start->format("Y-m-d"),
                    ],

                    'y' => [
                        'min' => 0,
                        'max' => max($meals_calories) + 100,
                        'ticks' => [
                            'color' => 'white'
                        ],

                        'grid' => [
                            'color' => 'grey'
                        ],
                    ]
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Body Stats'
                    ],

                    'legend' => [
                        'labels' => [
                            'color' => 'white'
                        ]
                    ],
                ]
            ]);

        return view("dashboard", compact("chart"));
    }

    public function renderBodyStatsChart() {

        $user_id = Auth::user()->id;

        // $start = Carbon::parse(User::min("created_at"));
        $start = Carbon::now()->subYear();
        $end = Carbon::now();

        $period = CarbonPeriod::create($start, "1 month", $end);

        $bodyStats = collect($period)->map(function ($date) {
            $endDate = $date->copy()->endOfMonth();
            $user_id = Auth::user()->id;

            return [
                "weight" => UserHealthLogs::where('time_updated', '<=', $endDate)
                                          ->where('user_id', '=', $user_id)
                                          ->average('weight'),

                "bmi" => UserHealthLogs::where('time_updated', '<=', $endDate)
                                          ->where('user_id', '=', $user_id)
                                          ->average('bmi'),

                "month" => $endDate->format("Y-m-d")
            ];
        });


        $data = $bodyStats->pluck('weight')->toArray();
        $data_bmi = $bodyStats->pluck('bmi')->toArray();
        $labels = $bodyStats->pluck('month')->toArray();

        // return [$data, $labels];

        
        // $data_bmi = $bodyStats->pluck('bmi')->toArray();
        // $data_bodyfat = $bodyStats->pluck('body_fat')->toArray();

        // $labels = $bodyStats->pluck('weight')->toArray();

        // return $data_weight[0];


        // $data_weight_array = [];
        // $data_weight_bmi = [];

        // $labels = [];


        // foreach($data_weight[0] as $data) {

        //     array_push($data_weight_array, $data['weight'] ?? 0);
        //     array_push($data_weight_bmi, $data['bmi'] ?? 0);
        //     array_push($labels, $data['time_updated'] ?? "");
        // }

        // dd($data_weight_array, $data_weight_bmi, $labels);

        $chart = Chartjs::build()
            ->name("BodyStatsChart")
            ->size(["width" => 800, "height" => 400])
            ->labels($labels)
            ->datasets([
                [
                    "label" => "Weight (kg)",
                    "type" => "line",
                    "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                    "borderColor" => "rgba(38, 185, 154, 0.7)",
                    "data" => $data
                ],
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'month'
                        ],
                        'min' => $start->format("Y-m-d"),
                    ],

                    'y' => [
                        'min' => 135,
                        'max' => 145
                    ]
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Body Stats'
                    ]
                ]
            ]);

        // dd($labels, $data);

        return view("nutrition_body_stats_chart", compact("chart"));

    }


    public function showMealCalendar() {
        $calendarData = $this->calendar();
    }


    public function dashboard_stats($start_date, $end_date) {
        
        function meal_select($start_date, $end_date, $user_id) {
        $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                            ->orderByRaw('time_planned ASC')
                            ->get();

        return $meal_select;
        }
    

        $user_id = Auth::user()->id;

    


        $meal_select = meal_select($start_date, $end_date, $user_id);

        // $meal_names = [];

        $meal_times = [];

        $meal_items_array = [];

        $meal_items_names = [];

        $meal_macro_calculations = [];

    

        foreach ($meal_select as $index => $meal) {

            $meal_names[$index] = ['meal_name' => $meal->name, 'meal_id' => $meal->id];


        }

        for ($meal=0; $meal < count($meal_select); $meal++) {


            $meal_items_select = MealItems::where('meal_id', $meal_select[$meal]->id)
                                            ->get();

            $meal_items_array[$meal_select[$meal]->time_planned] = $meal_items_select;

            $meal_items_names[$meal_select[$meal]->time_planned]["meal_name"] = $meal_select[$meal]->name;
            // $meal_items_array[$meal_select[$meal]->time_planned][$meal] = $meal_items_select;
             $meal_items_names[$meal_select[$meal]->time_planned]["meal_id"] = $meal_select[$meal]->id;

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


                    $macros['name'] = Food::find($macro_select[0]->food_id)->name;
                    $macros['serving_size'] = $macro_select[0]->serving_size ? $macro_select[0]->serving_size : 1 ;
                    $macros['quantity'] = $quantity;
                    
                    $macros['calories'] = round((float)($macro_select[0]->calories / $macros['serving_size']) * $serving_size * $quantity, 1);
                    
                    $macros['fat'] = round((float)($macro_select[0]->fat / $macros['serving_size']) * $serving_size * $quantity, 1);
                    $macros['carbohydrates'] = round((float)($macro_select[0]->carbohydrates / $macros['serving_size']) * $serving_size * $quantity, 1);
                    $macros['protein'] = round((float)($macro_select[0]->protein / $macros['serving_size']) * $serving_size * $quantity, 1);

                    $macro_totals['calories'] += $macros['calories'];
                    $macro_totals['fat'] += $macros['fat'];
                    $macro_totals['carbohydrates'] += $macros['carbohydrates'];
                    $macro_totals['protein'] += $macros['protein'];
                    
                    $meal_macros_no_total[$meal_items_array_keys[$x]][$y] = $macros;
 
                    $meal_macro_calculations[$meal_items_array_keys[$x]][$y] = $macros;
                    $meal_macro_calculations[$meal_items_array_keys[$x]]['total'] = $macro_totals;
                } else {
                    $meal_macro_calculations[$meal_items_array_keys[$x]][$y] = "irrelevant";
                }



                // $meal_macro_calculations[$meal_items_array_keys[$x]][$y] = $meal_items_array[$meal_items_array_keys[$x]][$y];

                // $meal_items_array[$meal_items_array_keys[$x]][$y] = [];

            } 


        }

        // return $meal_macro_calculations;

        $meal_times = array_keys($meal_items_array);

        // return $meal_items_array;

        // return ([
        //     $meal_items_array,
        //     $meal_items_names,
        //     $meal_macro_calculations
        // ]);    

        return view('dashboard_2024', ['start_date' => $start_date, 'end_date' => $end_date, 'meal_times' => $meal_times, 'meal_items' => $meal_items_array, 'meal_macros_no_total' => $meal_macros_no_total, 'meal_macros' => $meal_macro_calculations, 'meal_names' => $meal_items_names, 'calendar' => $this->calendar(null, $start_date, $end_date), 'load_date_calories' => $this->viewModeCalories()]);
        // return $meal_items_array;

    }


    public function visualizer_show() {

        return view('visualizer');
    }

    public function advanced_menu() {

        return view('nutrition_advanced');
    }

    public function get_calorie_info() {

        
    }

    // public function calorie_intake_per_day() {


    //     MealController::class->get_nutrients_of_meal()


    // }
}
