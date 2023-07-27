<?php

namespace App\Http\Controllers;

use App\View\Components\MealSearchItem;
use App\View\Components\MealFoodItem;

use Illuminate\Http\Request;

use Auth;

use App\Models\FoodSource;
use App\Models\Food;
use App\Models\Macronutrients;

class MealController extends Controller
{
    public function meal_form()
    {   
        return view('nutrition_meal_form');
    }

    public function search_food(Request $request) {
        $user_id = Auth::user()->id;

        $foods = $request->input('query');
        $servingSize = $request->input('servingSize');
        $quantity = $request->input('quantity');

        $ignoreServingSize = $request->input('ignoreServingSize');

        

        $food_search = Food::where('name', 'LIKE', "%{$foods}%")
                           ->where('user_id', $user_id)
                           ->orderBy('id', 'desc')
                           ->groupBy('name')
                           ->get();

        $food_array = [];

        foreach($food_search as $index=>$food) {
            $food_array[] = $food;

            $food_source_search = FoodSource::where('id', $food->source_id)
                                                ->first();
            


            $macronutrients_search = Macronutrients::where('food_id', $food->id)
                                                ->first();

            $food_array[$index]['source_name'] = $food_source_search->name;
            
            if ($ignoreServingSize == true) {
                $servingSize = $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            } else {
                // ignore
            }

            $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$index]['calories'] = $macronutrients_search->calories;
            $food_array[$index]['fat'] = $macronutrients_search->fat;
            $food_array[$index]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$index]['protein'] = $macronutrients_search->protein;

            

        }                   

        $component = new MealSearchItem($food_array, $servingSize, $quantity);

        return $component->render()->with($component->data());


    }

    public function add_food_to_meal(Request $request) {
        $user_id = Auth::user()->id;

        $noOfFoods = $request->input('no_of_foods');
        $foods = $request->input('query');
        $servingSize = $request->input('servingSize');
        $quantity = $request->input('quantity');

        $ignoreServingSize = $request->input('ignoreServingSize');

        

        $food_search = Food::where('id', "$foods")
                           ->where('user_id', $user_id)
                           ->groupBy('name', 'source_id')
                           ->get();

        $food_array = [];

        foreach($food_search as $index=>$food) {
            $food_array[] = $food;

            $food_source_search = FoodSource::where('id', $food->source_id)
                                                ->first();
            


            $macronutrients_search = Macronutrients::where('food_id', $food->id)
                                                ->first();

            $food_array[$index]['source_name'] = $food_source_search->name;
            
            if ($ignoreServingSize == true) {
                $servingSize = $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            } else {
                // ignore
            }

            $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$index]['calories'] = $macronutrients_search->calories;
            $food_array[$index]['fat'] = $macronutrients_search->fat;
            $food_array[$index]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$index]['protein'] = $macronutrients_search->protein;

            

        }       

        $component = new MealFoodItem($noOfFoods, $food_array, $servingSize, $quantity);

        return $component->render()->with($component->data());


    }

}
