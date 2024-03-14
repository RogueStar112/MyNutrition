<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Exercise;
use App\Models\ExerciseUnit;
use App\Models\ExerciseType;




class ExerciseController extends Controller
{
    //
    
    public function exercise_form()
    {   

        // Food unit options are stored in the database.

        return view('exercise_form');
    }

    public function exercise_store(Request $request) {

        $user_id = Auth::user()->id;

        // Default distance unit is Kilometres (kms).
        // Default duration unit is Minutes (mins).

        $distance_val = (float)$request->input('exercise-distance');

        $duration_val = (float)$request->input('exercise-duration');

        $exercise_distance_unit = $request->input('exercise-distance-unit');

        if($exercise_distance_unit == 'miles') {

            // Convert to Kilometres.
            $distance_val = round($distance_val / 1.609, 2);

        }




        $active_calories = (float)$request->input('active-calories')!=NULL ? (float)$request->input('active-calories') : 0;

        $total_calories = (float)$request->input('total-calories')!=NULL ? (float)$request->input('total-calories') : 0;

        $avg_heart_rate = (float)$request->input('avg-heart-rate')!=NULL ? (float)$request->input('avg-heart-rate') : 0;

        $exercise_time = $request->input('exercise-time');
        $exercise_time_ymdhis = date('Y-m-d H:i:s', strtotime($exercise_time));


        $exercise_type = $request->input('exercise-type');

        $exercise_type_id = ExerciseType::where('name', $exercise_type)
                                ->get();

        $exercise_type_id = $exercise_type_id[0]->id;


        // dd($user_id, $distance_val, $duration_val, $exercise_distance_unit, $active_calories, $total_calories, $avg_heart_rate, $exercise_time, $exercise_type, $exercise_type_id, $exercise_time_ymdhis);

        $newExercise = new Exercise();

        $newExercise->user_id = $user_id;
        $newExercise->exercise_type_id = $exercise_type_id;
        $newExercise->distance = $distance_val;
        $newExercise->duration = $duration_val;
        $newExercise->exercise_start = $exercise_time_ymdhis;
        $newExercise->calories_active = $active_calories;
        $newExercise->calories_total = $total_calories;
        $newExercise->average_bpm = $avg_heart_rate;

        $newExercise->save();


                




        return view('exercise_form');

    }
}
