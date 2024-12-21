<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Models\Exercise;
use App\Models\ExerciseUnit;
use App\Models\ExerciseType;

use App\Models\UserHealthDetails;


class ExerciseController extends Controller
{
    //

    function calculateCalories($activityType, $speed, $weight, $durationMinutes) {
        // MET tables for different activities
        $MET_tables = [
            'walk' => [
                2.0 => 2.0,   // Very slow walking
                3.0 => 2.5,   // Strolling
                4.0 => 3.3,   // Slow walking
                5.0 => 3.8,   // Brisk walking
                6.0 => 4.8,   // Very brisk walking
                6.5 => 5.0    // Fast walking (race walking)
            ],
            'run' => [
                6.0 => 6.0,   // Light jogging
                8.3 => 8.3,   // Running (9.7 km/h)
                9.8 => 9.8,   // Running (10.8 km/h)
                11.0 => 11.0, // Running (12 km/h)
                12.0 => 12.0, // Running (13 km/h)
                15.0 => 15.1  // Sprinting (19 km/h)
            ],
            'cycle' => [
                4.0 => 4.0,   // Leisurely cycling (10-12 km/h)
                6.0 => 6.0,   // Moderate cycling (13-16 km/h)
                8.0 => 8.0,   // Vigorous cycling (16-19 km/h)
                10.0 => 10.0, // Racing cycling (20-25 km/h)
                12.0 => 12.0  // Very vigorous cycling (25+ km/h)
            ]
        ];
        
        // Ensure the activity type is valid
        if (!array_key_exists($activityType, $MET_tables)) {
            return "Invalid activity type!";
        }
    
        // Use the appropriate MET table based on the activity type
        $MET_table = $MET_tables[$activityType];
        
        // Sort speeds to ensure proper range handling
        $speeds = array_keys($MET_table);
        sort($speeds);
    
        // Determine MET by interpolation
        $MET = 0;
        for ($i = 0; $i < count($speeds) - 1; $i++) {
            if ($speed >= $speeds[$i] && $speed <= $speeds[$i + 1]) {
                // Linear interpolation between speeds[i] and speeds[i+1]
                $MET = $MET_table[$speeds[$i]] + 
                       (($speed - $speeds[$i]) * 
                       ($MET_table[$speeds[$i + 1]] - $MET_table[$speeds[$i]]) / 
                       ($speeds[$i + 1] - $speeds[$i]));
                break;
            }
        }
    
        // Handle edge cases: speed outside the defined range
        if ($MET == 0) {
            if ($speed < $speeds[0]) {
                $MET = $MET_table[$speeds[0]]; // Use the lowest MET
            } elseif ($speed > end($speeds)) {
                $MET = $MET_table[end($speeds)]; // Use the highest MET
            }
        }
    
        // Convert duration to hours
        $durationHours = $durationMinutes / 60.0;
    
        // Calculate calories burned
        $caloriesBurned = $MET * $weight * $durationHours;
    
        return $caloriesBurned;
    }
    
    public function exercise_form()
    {   

        // Food unit options are stored in the database.

        return view('exercise_form');
    }

    public function exercise_store(Request $request) {

        $user_id = Auth::user()->id;

        $active_calories = (float)($request->input('active-calories') ?? 0);
        $total_calories = (float)($request->input('total-calories') ?? 0);
        $avg_heart_rate = (float)($request->input('avg-heart-rate') ?? 0);

        $distance_val = (float)$request->input('exercise-distance');


        // Default duration unit is Minutes (mins).

        $duration_val = (float)$request->input('exercise-duration');

        $exercise_distance_unit = $request->input('exercise-distance-unit');

        if($exercise_distance_unit == 'miles') {

            // Convert to Kilometres.
            $distance_val = round($distance_val * 1.609, 2);

        }



        // either km/h or mph
        $speed_val = round(((float)$distance_val / ((float)$duration_val / 60)), 1);

        $speed_val_display = "$speed_val " . "km/h";

        // dd($speed_val_display);

        // $active_calories = (float)$request->input('active-calories')!=NULL ? (float)$request->input('active-calories') : 0;

        // $total_calories = (float)$request->input('total-calories')!=NULL ? (float)$request->input('total-calories') : 0;

        // $avg_heart_rate = (float)$request->input('avg-heart-rate')!=NULL ? (float)$request->input('avg-heart-rate') : 0;

        // $active_calories = (float)($request->input('active-calories') ?? 0);
        // $total_calories = (float)($request->input('total-calories') ?? 0);
        // $avg_heart_rate = (float)($request->input('avg-heart-rate') ?? 0);
        

        $exercise_time = $request->input('exercise-time');
        $exercise_time_ymdhis = date('Y-m-d H:i:s', strtotime($exercise_time));

        


        $exercise_type = $request->input('exercise-type');

        $exercise_type_id = ExerciseType::where('name', $exercise_type)
                                ->get();

        $exercise_type_id = $exercise_type_id[0]->id;

        // Example Usage
        $speed = $speed_val;             // Average speed in km/h
        $weight = UserHealthDetails::where('user_id', $user_id)->first()->weight ?? 75;        // Weight in kg
        $durationMinutes = $duration_val;    // Duration in minutes

        if ($active_calories == 0 || $total_calories == 0) {

            $active_calories = round($this->calculateCalories($exercise_type, $speed, $weight, $durationMinutes), 0);
            $total_calories = $active_calories;

        }
        
        try {
            $validated = $request->validate([
                'exercise-time' => 'required',
                'exercise-distance' => 'required|decimal:0,2',
                'exercise-duration' => 'required|decimal:0,2',
                'exercise-type' => 'required|in:walk,run,cycle',
                'active-calories' => 'nullable|decimal:0,1',
                'total-calories' => 'nullable|decimal:0,1',
                'avg-heart-rate' => 'nullable|decimal:0,1'
            ]);
            // dd($validated);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }

        // Default distance unit is Kilometres (km).


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
