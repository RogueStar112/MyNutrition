<?php

namespace App\Http\Controllers;

use App\View\Components\FoodItem;
use App\View\Components\FoodInputItem;
use Illuminate\Http\Request;
use Illuminate\View\Component;


class FoodController extends Controller
{
    public function food_form()
    {   
        return view('nutrition_food_form');
    }

    public function food_form_store()
    {
    
    }

    public function create_new_food_page(Request $request) {
        $index = $request->input('index');

        $component = new FoodInputItem($index);

        return $component->render()->with($component->data());
    }

    public function create_new_food_item(Request $request) {

        $index = $request->input('index');
        $name = $request->input('name');
        $source = $request->input('source');
        $calories = $request->input('calories');
        $fat = $request->input('fat');
        $carbs = $request->input('carbs');
        $protein = $request->input('protein');

        $component = new FoodItem($index, $name, $source, $calories, $fat, $carbs, $protein);

        return $component->render()->with($component->data());
    }


}
