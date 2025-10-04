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

use App\Models\Water;

use App\Http\Traits\CalendarGenerator;

use App\Http\Controllers\MealController;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use IcehouseVentures\LaravelChartjs\Facades\Chartjs;


class DashboardController extends Controller
{   
    
    use CalendarGenerator;

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

        // dd($meal_items);

        // dd($meal_items);

        foreach($meal_items as $meal_item) {

            // $macros[$meal_item->name] = Macronutrients::where('food_id', $meal_item->food_id)?->first();
                                        
            
            // $micros[$meal_item->name] = Micronutrients::where('food_id', $meal_item->food_id)?->first();
            

            // $macros[] = DB::table('macronutrients')
            //                 ->join('meal_items', 'macronutrients.food_id', '=', 'meal_items.food_id')
            //                 ->select('*', DB::raw('(meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity as true_serving_size'))
            //                 ->where('macronutrients.food_id', '=', $meal_item->food_id)
            //                 ->first();

            // $macros[] = DB::table('macronutrients')
            //             ->join('meal_items', 'macronutrients.food_id', '=', 'meal_items.food_id')
            //             ->select(
            //                 'macronutrients.food_id', // Keep non-numeric columns as-is
            //                 DB::raw('(meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity AS true_serving_size'),
            //                 DB::raw('(macronutrients.calories * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)) AS adjusted_calories'),
            //                 DB::raw('(macronutrients.protein * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)) AS adjusted_protein'),
            //                 DB::raw('(macronutrients.carbohydrates * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)) AS adjusted_carbs'),
            //                 DB::raw('(macronutrients.fat * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)) AS adjusted_fat')
            //             )
            //             ->where('macronutrients.food_id', '=', $meal_item->food_id)
            //             ->first();

            $macros[] = DB::table('macronutrients')
            ->join('meal_items', 'macronutrients.food_id', '=', 'meal_items.food_id')
            ->select(
                'macronutrients.food_id',
                'meal_items.name', // Keep non-numeric columns as-is
                'meal_items.serving_size',
                // 'macronutrients.serving_size as mss',
                // DB::raw('ROUND((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity, 1) AS true_serving_size'),
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
                // 'meal_items.serving_size',
                // 'macronutrients.serving_size',
                // 'macronutrients.serving_size as micro_mss',
                // DB::raw('ROUND((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity, 1) AS true_serving_size'),
                DB::raw('ROUND((micronutrients.sugars * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS sugars'),
                DB::raw('ROUND((micronutrients.saturates * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS saturates'),
                DB::raw('ROUND((micronutrients.fibre * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 1) AS fibre'),
                DB::raw('ROUND((micronutrients.salt * ((meal_items.serving_size / macronutrients.serving_size) * meal_items.quantity)), 2) AS salt')
            )
            ->where('macronutrients.food_id', '=', $meal_item->food_id)
            ->where('meal_items.meal_id', '=', $meal_item->meal_id)
            ->first();
            
        
            // $micros[$meal_item->name] = Micronutrients::where('food_id', $meal_item->food_id)?->first();
        }
        
        // dd($macros, $micros);
        // return [$macros, $micros];

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

        // return($macros);

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

        // dd($nutrients);
        
        // dd(['nutrients' => $nutrients, 'macros' => $macros, 'micros' => $micros]);

        return ['nutrients' => $nutrients, 'macros' => $macros, 'micros' => $micros];
 
    }

    public function renderDailyMacroIntakeChart() {

        $user_id = Auth::user()->id;

        $start = Carbon::now()->subWeeks(2);
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
            $meals_calories[$key] = ($meals_calories[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['nutrients']['calories'] ?? 0);

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
            ->size(["width" => 3000, "height" => 600])
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
                        'min' => min($meals_calories),
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

        $start = Carbon::now()->subWeeks(2);
        $end = Carbon::now();

        $period = CarbonPeriod::create($start, "1 month", $end);

        $meals_calories = [];
        $meals_fat = [];
        $meals_carbs = [];
        $meals_protein = [];

        $meals_dates = [];

    
        $last_five_meals_calories = [];
        $last_five_meals_fat = [];
        $last_five_meals_carbs = [];
        $last_five_meals_protein = [];

        $last_five_meals_names = [];
        $last_five_meals_dates = [];

        $last_five_meals_macros = [];
        $last_five_meals_micros = [];

        // $meal_select = Meal::where('time_planned', '<=', $date)
        // ->where('user_id', '=', $user_id)
        // ->get();

        $meal_select = Meal::where('time_planned', '<=', $end)
                        ->where('time_planned', '>=', $start)
                        ->where('user_id', '=', $user_id)
                        ->where('is_eaten', '=', 1)
                        ->orderBy('time_planned', 'asc')
                        ->get();

        $last_five_meals = Meal::where('time_planned', '<=', $end)
                            ->where('time_planned', '>=', $start)
                            ->where('user_id', '=', $user_id)
                            ->where('is_eaten', '=', 1)
                            ->orderBy('time_planned', 'desc')
                            ->limit(10)
                            ->get();

        // dd($last_five_meals);
        
         foreach($last_five_meals as $meal) {    

            $key = date('Y-m-d H:i:s', strtotime($meal->time_planned));
            $last_five_meals_names[$key] = $this->get_nutrients_of_meal($meal->id)['nutrients']['meal_name'];
            $last_five_meals_dates[$key] = $key ?? "";
            $last_five_meals_calories[$key] = ($last_five_meals_calories[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['calories'] ?? 0);
            $last_five_meals_fat[$key] = ($last_five_meals_fat[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['fat'] ?? 0);
            $last_five_meals_carbs[$key] = ($last_five_meals_carbs[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['carbohydrates'] ?? 0);
            $last_five_meals_protein[$key] = ($last_five_meals_protein[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['protein'] ?? 0);
            
            $last_five_meals_macros[$key] = $this->get_nutrients_of_meal($meal->id)['macros'];
            $last_five_meals_micros[$key] = $this->get_nutrients_of_meal($meal->id)['micros'];
        }

        




        $last_five_meals_calories = array_values($last_five_meals_calories);
        $last_five_meals_dates = array_values($last_five_meals_dates);

        $last_five_meals_fat = array_values($last_five_meals_fat);
        $last_five_meals_carbs = array_values($last_five_meals_carbs);
        $last_five_meals_protein = array_values($last_five_meals_protein);
        
        $last_five_meals_array = [
            'dates' => $last_five_meals_dates,
            'names' => $last_five_meals_names,
            'calories' => $last_five_meals_calories,
            'fat' => $last_five_meals_fat,
            'carbs' => $last_five_meals_carbs,
            'protein' => $last_five_meals_protein,
            'macros' => $last_five_meals_macros,
            'micros' => $last_five_meals_micros
        ];


        // dd($last_five_meals_array);

        // dd($last_five_meals_array['calories']);

        // dd($last_five_meals_array);

        // dd($last_five_meals);
        
        // dd($meal_select);

        if(count($meal_select) == 0) {

            return view("dashboard_placeholder");

        }
            
        $last_meal_selected = $meal_select->reverse()->first();

        
        $last_meal_nutrients = $this->get_nutrients_of_meal($last_meal_selected?->id)['nutrients'];

      

        $last_fluids_taken = Water::where('time_taken', '<=', $end)
                                ->where('time_taken', '>=', $start)
                                ->where('user_id', '=', $user_id)
                                ->orderBy('time_taken', 'desc')
                                ->get();

        $last_fluids_selected = $last_fluids_taken->reverse()->first();



        foreach($meal_select as $meal) {    

            $key = date('Y-m-d', strtotime($meal->time_planned));
            $meals_calories[$key] = ($meals_calories[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['calories'] ?? 0);
            $meals_fat[$key] = ($meals_fat[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['fat'] ?? 0);
            $meals_carbs[$key] = ($meals_carbs[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['carbohydrates'] ?? 0);
            $meals_protein[$key] = ($meals_protein[$key] ?? 0) + ($this->get_nutrients_of_meal($meal->id)['nutrients']['protein'] ?? 0);
            

        }

        foreach($meal_select as $meal) {    

            $key = date('Y-m-d', strtotime($meal->time_planned));
            $meals_dates[$key] = $key ?? "";

        }

        

        // dd(array_values($meals_calories), array_values($meals_dates));

        $meals_calories = array_values($meals_calories);
        $meals_dates = array_values($meals_dates);

        $meals_fat = array_values($meals_fat);
        $meals_carbs = array_values($meals_carbs);
        $meals_protein = array_values($meals_protein);


        $avg_calories = array_sum($meals_calories) / count($meals_dates);

        $highest_calories = max($meals_calories);

        $lowest_calories = min($meals_calories);

        // dd($meals_dates);
        
        $chart = Chartjs::build()
            ->name("MacroIntakeChart")
            ->size(["width" => "100%", "height" => "33.3%"])
            ->labels($meals_dates)
            ->datasets([
                [
                    "label" => "Calories (kcal)",
                    "type" => "line",
                    "backgroundColor" => "rgba(255, 200, 0, 0.35)",
                    "borderColor" => "rgba(255, 200, 0, 1)",
                    "data" => $meals_calories,
                    "lineTension" => 0.6,
                    "fill" => true,
                ],
            ])
            ->options([
                'labels' => [
                    'color' => 'white',
                    'style' => 'Montserrat'
                ],

                'layout' => [
                    'padding' => '20',
                ],

                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'day'
                        ],
                        
                        'title' => [
                            'display' => 'true',
                            'text' => 'Months'
                        ],
                        
                        'drawTicks' => 'true',

                    

                        'ticks' => [
                            'color' => 'white',
                            'display' => 'true'
                        ],

                        'grid' => [
                            'color' => '#2D2D2D',
                            'display' => 'true',
                            'drawborder' => 'true',
                        ],
                        'min' => min($meals_dates),
                    ],

                    'y' => [
                        'min' => 0,
                        'max' => (round(max($meals_calories) * 1.1, 0)),

                              'drawTicks' => 'true',


                        'ticks' => [
                            'color' => 'white',
                            // 'mirror' => 'true'
                        ],

                        'title' => [
                            'display' => 'true',
                            'text' => 'Calories (kcal)'
                        ],

                        'grid' => [
                            'color' => '#545454',
                            'display' => 'true',
                            'drawBorder' => 'true',
                        ],
                    ]
                ],

                'tooltips' => [
                    'enabled' => 'true',
                ],

                'plugins' => [
                    'title' => [
                        'display' => false,
                        'text' => 'Body Stats'
                    ],

                    'legend' => [
                        'labels' => [
                            'color' => 'transparent',
                            'display' => false,
                        ],

                        'display' => false,
                    ],
                ]
            ]);

            
        $fat_chart = Chartjs::build()
        ->name("FatIntakeChart")
        ->size(["width" => "100%", "height" => "125%"])
        ->labels($meals_dates)
        ->datasets([
            [
                "label" => "Fat (g)",
                "type" => "bar",
                "backgroundColor" => "rgba(185, 0, 0, 1)",
                "borderColor" => "rgba(185, 0, 0, 1)",
                "data" => $meals_fat,
                "lineTension" => 0.6
            ],
        ])
        ->options([
            'labels' => [
                'color' => 'white',
                'style' => 'Montserrat'
            ],

            'responsive' => 'true',
            'maintainAspectRatio' => "false",

            'scales' => [
                'x' => [
                    'type' => 'time',
                    'time' => [
                        'unit' => 'month'
                    ],
                    
                    'drawTicks' => 'false',

                    'ticks' => [
                        'color' => 'orange'
                    ],

                    'grid' => [
                        'color' => 'transparent',
                        'display' => 'false',
                        'drawborder' => 'false',
                    ],
                    'min' => min($meals_dates),
                ],

                'y' => [
                    'min' => 0,
                    'max' => max($meals_fat),

                    
                    'ticks' => [
                        'color' => 'white'
                    ],

                    'grid' => [
                        'color' => 'transparent',
                        'display' => 'false',
                        'drawBorder' => 'false',
                    ],
                ]
            ],

            'tooltips' => [
                'enabled' => 'false',
            ],

            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Fat (g)',
                    'color' => 'white',
                ],

                'legend' => [
                    'labels' => [
                        'color' => 'transparent',
                        'display' => false,
                    ],

                    'display' => false,
                ],
            ]
        ]);

        $carbs_chart = Chartjs::build()
        ->name("CarbsIntakeChart")
        ->size(["width" => "100%", "height" => "125%"])
        ->labels($meals_dates)
        ->datasets([
            [
                "label" => "Carbs (g)",
                "type" => "bar",
                "backgroundColor" => "rgba(0, 185, 0, 1)",
                "borderColor" => "rgba(0, 185, 0, 1)",
                "data" => $meals_carbs,
                "lineTension" => 0.6
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
                    
                    'drawTicks' => 'false',

                    'ticks' => [
                        'color' => 'orange'
                    ],

                    'grid' => [
                        'color' => 'transparent',
                        'display' => 'false',
                        'drawborder' => 'false',
                    ],
                    'min' => min($meals_dates),
                ],

                'y' => [
                    'min' => 0,
                    'max' => max($meals_carbs),

                    
                    'ticks' => [
                        'color' => 'white'
                    ],

                    'grid' => [
                        'color' => 'transparent',
                        'display' => 'false',
                        'drawBorder' => 'false',
                    ],
                ]
            ],

            'tooltips' => [
                'enabled' => 'false',
            ],

            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Carbs (g)',
                    'color' => 'white',
                ],

                'legend' => [
                    'labels' => [
                        'color' => 'transparent',
                        'display' => false,
                    ],

                    'display' => false,
                ],
            ]
        ]);

        $protein_chart = Chartjs::build()
        ->name("ProteinIntakeChart")
        ->size(["width" => "100%", "height" => "125%"])
        ->labels($meals_dates)
        ->datasets([
            [
                "label" => "Protein (g)",
                "type" => "bar",
                "backgroundColor" => "rgba(0, 0, 185, 1)",
                "borderColor" => "rgba(0, 0, 185, 1)",
                "data" => $meals_protein,
                "lineTension" => 0.6
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
                    
                    'drawTicks' => 'false',

                    'ticks' => [
                        'color' => 'orange'
                    ],

                    'grid' => [
                        'color' => 'transparent',
                        'display' => 'false',
                        'drawborder' => 'false',
                    ],
                    'min' => min($meals_dates),
                ],

                'y' => [
                    'min' => 0,
                    'max' => max($meals_protein),

                    
                    'ticks' => [
                        'color' => 'white'
                    ],

                    'grid' => [
                        'color' => 'transparent',
                        'display' => 'false',
                        'drawBorder' => 'false',
                    ],
                ]
            ],

            'tooltips' => [
                'enabled' => 'false',
            ],

            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Protein (g)',
                    'color' => 'white',
                ],

                'legend' => [
                    'labels' => [
                        'color' => 'transparent',
                        'display' => false,
                    ],

                    'display' => false,
                ],
            ]
        ]);
            

            return view("dashboard", compact("chart", "fat_chart", "carbs_chart", "protein_chart", "avg_calories", "highest_calories", "lowest_calories", "last_meal_nutrients", "last_fluids_selected", "last_five_meals_array"));
    }

    public function renderBodyStatsChart() {

        // $user_id = Auth::user()->id;

        // // $start = Carbon::parse(User::min("created_at"));
        // $start = Carbon::now()->subYear();
        // $end = Carbon::now();

        // $period = CarbonPeriod::create($start, "1 month", $end);

        // $bodyStats = collect($period)->map(function ($date) {
        //     $endDate = $date->copy()->endOfMonth();
        //     $user_id = Auth::user()->id;

        //     return [
        //         "weight" => UserHealthLogs::where('time_updated', '<=', $endDate)
        //                                   ->where('user_id', '=', $user_id)
        //                                   ->average('weight'),

        //         "bmi" => UserHealthLogs::where('time_updated', '<=', $endDate)
        //                                   ->where('user_id', '=', $user_id)
        //                                   ->average('bmi'),

        //         "month" => $endDate->format("Y-m-d")
        //     ];
        // });


        // $data = $bodyStats->pluck('weight')->toArray();
        // $data_bmi = $bodyStats->pluck('bmi')->toArray();
        // $labels = $bodyStats->pluck('month')->toArray();

        // // return [$data, $labels];

        
        // // $data_bmi = $bodyStats->pluck('bmi')->toArray();
        // // $data_bodyfat = $bodyStats->pluck('body_fat')->toArray();

        // // $labels = $bodyStats->pluck('weight')->toArray();

        // // return $data_weight[0];


        // // $data_weight_array = [];
        // // $data_weight_bmi = [];

        // // $labels = [];


        // // foreach($data_weight[0] as $data) {

        // //     array_push($data_weight_array, $data['weight'] ?? 0);
        // //     array_push($data_weight_bmi, $data['bmi'] ?? 0);
        // //     array_push($labels, $data['time_updated'] ?? "");
        // // }

        // // dd($data_weight_array, $data_weight_bmi, $labels);

        // $chart = Chartjs::build()
        //     ->name("BodyStatsChart")
        //     ->size(["width" => 800, "height" => 400])
        //     ->labels($labels)
        //     ->datasets([
        //         [
        //             "label" => "Weight (kg)",
        //             "type" => "line",
        //             "backgroundColor" => "rgba(38, 185, 154, 0.31)",
        //             "borderColor" => "rgba(38, 185, 154, 0.7)",
        //             "data" => $data
        //         ],
        //     ])
        //     ->options([
        //         'scales' => [
        //             'x' => [
        //                 'type' => 'time',
        //                 'time' => [
        //                     'unit' => 'month'
        //                 ],
        //                 'min' => $start->format("Y-m-d"),
        //             ],

        //             'y' => [
        //                 'min' => 135,
        //                 'max' => 145
        //             ]
        //         ],
        //         'plugins' => [
        //             'title' => [
        //                 'display' => true,
        //                 'text' => 'Body Stats'
        //             ]
        //         ]
        //     ]);

        // // dd($labels, $data);

        // return view("nutrition_body_stats_chart", compact("chart"));

    }


    public function showMealCalendar() {
        $calendarData = $this->calendar();
    }


    public function dashboard_stats($start_date, $end_date) {
        
        function meal_select($start_date, $end_date, $user_id) {
        $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                            ->where('is_eaten', 1)
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
        // dd($meal_items_array);

        // dd($meal_macro_calculations);
        // return ([
        //     $meal_items_array,
        //     $meal_items_names,
        //     $meal_macro_calculations
        // ]);    

        // dd($meal_items_array);

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
