<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreakdownController extends Controller
{
    
    public function breakdown_form()
    {
        return view('nutrition_advanced_breakdown');

    }

}
