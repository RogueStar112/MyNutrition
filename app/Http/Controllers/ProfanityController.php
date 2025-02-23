<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Blaspsoft\Blasp\Facades\Blasp;

class ProfanityController extends Controller
{
    public function profanity_test() {

        $sentence = '';
        
        $check = Blasp::check($sentence);

        dd($check->hasProfanity());



    }
}
