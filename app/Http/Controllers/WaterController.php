<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterController extends Controller
{
    
    public function water_form() {

        return view('water_form');

    }

}
