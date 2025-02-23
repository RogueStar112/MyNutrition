<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function recipe_form() {
        return view('recipe_form');
    }
}
