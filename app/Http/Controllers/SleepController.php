<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SleepController extends Controller
{
    
    public function sleep_form() {

        return view('sleep_form');

    }


}
