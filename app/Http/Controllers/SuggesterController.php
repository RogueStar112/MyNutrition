<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuggesterController extends Controller
{
    
    public function suggester_form() {
        return view('nutrition_suggester');
    }
}
