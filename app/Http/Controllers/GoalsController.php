<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoalsController extends Controller
{
    public function goals_form()
    {   
        return view('goals_form');
    }
}
