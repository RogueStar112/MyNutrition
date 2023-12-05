<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    //
    
    public function exercise_form()
    {   

        // Food unit options are stored in the database.

        return view('exercise_form');
    }
}
