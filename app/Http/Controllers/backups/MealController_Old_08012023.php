<?php

namespace App\Http\Controllers;

use App\View\Components\MealSearchItem;
use App\View\Components\MealFoodItem;

use Illuminate\Http\Request;

use Auth;

use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;

use App\Models\Macronutrients;

use App\Models\Meal;
use App\Models\MealItems;

class MealController extends Controller
{
    public function meal_form()
    {   
        return view('nutrition_meal_form');
    }

    public function meal_form_store(Request $request) {
        
        

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
                        //    ->groupBy('name')
                           ->get();

        $food_array = [];

        foreach($food_search as $index=>$food) {
            $food_array[] = $food;

            $food_source_search = FoodSource::where('id', $food->source_id)
                                                ->first();
            


            $macronutrients_search = Macronutrients::where('food_id', $food->id)
                                                ->first();

                                                
            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                                        ->first();

            $food_array[$index]['source_name'] = $food_source_search->name;
            
            if ($ignoreServingSize == true) {
                $servingSize = $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            } else {
                // ignore
            }

            $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;

            if($macronutrients_search->serving_size <= 0) {
                $food_array[$index]['serving_size'] = 1;
            }


            $food_array[$index]['calories'] = $macronutrients_search->calories;
            $food_array[$index]['fat'] = $macronutrients_search->fat;
            $food_array[$index]['food_unit_id'] = $food_unit->id; 
            $food_array[$index]['food_unit_short'] = $food_unit->short_name;
            $food_array[$index]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$index]['protein'] = $macronutrients_search->protein;

            

        }                   

        $component = new MealSearchItem($food_array, $servingSize, $quantity);

        return $component->render()->with($component->data());


    }

    public function add_food_to_meal(Request $request) {
        $user_id = Auth::user()->id;

        $noOfFoods = $request->input('no_of_foods');
        $balancer = $request->input('balancer');
        $foods = $request->input('query');
        $servingSize = $request->input('servingSize');
        $quantity = $request->input('quantity');

        $ignoreServingSize = $request->input('ignoreServingSize');

        

        $food_search = Food::where('id', "$foods")
                           ->where('user_id', $user_id)
                           ->groupBy('name', 'source_id')
                           ->get();

        $food_array = [];

        $data_input_to_render = "";

        foreach($food_search as $index=>$food) {
            $food_array[] = $food;

            $food_source_search = FoodSource::where('id', $food->source_id)
                                                ->first();
            
            $food_array[$index]['food_name'] = $food->name;

            $macronutrients_search = Macronutrients::where('food_id', $food->id)
                                                ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                                ->first();

            $food_array[$index]['source_name'] = $food_source_search->name;

            $food_id = $food->id;
            
            if ($ignoreServingSize == true) {
                $servingSize = $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            } else {
                // ignore
            }

            $food_array[$index]['serving_size_input'] = $servingSize;
            $food_array[$index]['quantity'] = $quantity;
            $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$index]['food_unit_id'] = $food_unit->id; 
            $food_array[$index]['food_unit_short'] = $food_unit->short_name;
            $food_array[$index]['calories'] = $macronutrients_search->calories;
            $food_array[$index]['fat'] = $macronutrients_search->fat;
            $food_array[$index]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$index]['protein'] = $macronutrients_search->protein;

            $data_input_to_render .= "<input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$noOfFoods' readonly />";
            $data_input_to_render .= "<input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$noOfFoods' readonly />";
            $data_input_to_render .= "<input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$noOfFoods' readonly />";
            $data_input_to_render .= "<input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$noOfFoods' readonly />";
            $data_input_to_render .= "<input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$noOfFoods' readonly />";
            $data_input_to_render .= "<input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$noOfFoods' readonly />";

        }       

        $component = new MealFoodItem($noOfFoods, $food_array, $servingSize, $quantity);
        
        
        // use this when replacing stuff
        $component_prior = new MealFoodItem($noOfFoods-$balancer, $food_array, $servingSize, $quantity);


        // $data_input_to_render .= "<input id='meal_servingsize_$noOfFoods' type='hidden' name='meal_servingsize_$noOfFoods'>";

        
        return response()->json(['html_replace' => (string)$component_prior->render()->with($component_prior->data()), 'html' => (string)$component->render()->with($component->data()), 'html_input_data' => $data_input_to_render, 'food_array' => $food_array]);  
        // return $component->render()->with($component->data());


    }

}
