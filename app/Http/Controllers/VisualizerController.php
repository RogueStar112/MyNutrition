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
                    ->get();

        $taskData = [];

        foreach($tasks as $task) {
            $date = Carbon::parse($task->time_planned)->format('d/m/Y');

            // Check if the date already exists in the taskData array
            if (!isset($taskData[$date])) {
                $taskData[$date] = []; 
            }
            
            $taskData_setup = array(
                "date" => Carbon::parse($task->time_planned)->format('d/m/Y h:i'),
                "date_short" => Carbon::parse($task->time_planned)->format('d/m/Y'),
                "task" => $task->name,
                "description" => "...",
                "time_start" => Carbon::parse($task->time_planned)->format('H'),
                "time_end" => Carbon::parse($task->time_planned)->add('5 hours')->format('H'), 
                "bg_color" => "EE0000"
            );

            $taskData[$date][] = $taskData_setup;

        }

        return $taskData;

        

    }
}
