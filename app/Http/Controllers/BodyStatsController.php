<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\View\Components\FoodItem;
use App\View\Components\FoodInputItem;
use Illuminate\Support\Facades\DB;

use Auth;
use Illuminate\View\Component;

use App\Models\FoodSource;
use App\Models\Food;
use App\Models\FoodUnit;
use App\Models\Macronutrients;

class BodyStatsController extends Controller
{
    public function body_stats_form() {

        return view('nutrition_body_stats_form');

    }
}
