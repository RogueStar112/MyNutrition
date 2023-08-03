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

    public function render_arrays($array) {

        return (string)$array->render()->with($array->data());

    }

    public function add_food_to_meal(Request $request) {
        $user_id = Auth::user()->id;

        $food_array_html = [];

        $index_array = [];

        $meals = $request->input('meals');

        foreach($meals as $index=>$meal) {

            $food_array = [];

            $index_no = $meal['index'];
            $query_no = $meal['query'];
            $servingSize = $meal['servingSize'];
            $quantity = $meal['quantity'];

            $food_array[$index]['index'] = $index_no;

            $food_search = Food::where('id', "$query_no")
                            ->where('user_id', $user_id)
                            ->groupBy('name', 'source_id')
                            ->first();

            $food_source_search = FoodSource::where('id', $food_search->source_id)
                                                ->first();
            
            $food_array[$index]['name'] = $food_search->name;

            $macronutrients_search = Macronutrients::where('food_id', $food_search->id)
                                                ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                                ->first();

            $food_array[$index]['source'] = $food_source_search->name;

            $food_id = $food_search->id;
            
            // if ($ignoreServingSize == true) {
            //     $servingSize = $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            // } else {
            //     // ignore
            // }

            $food_array[$index]['serving_size_input'] = $servingSize;
            $food_array[$index]['quantity'] = $quantity;
            $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$index]['food_unit_id'] = $food_unit->id; 
            $food_array[$index]['food_unit_short'] = $food_unit->short_name;
            $food_array[$index]['calories'] = $macronutrients_search->calories;
            $food_array[$index]['fat'] = $macronutrients_search->fat;
            $food_array[$index]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$index]['protein'] = $macronutrients_search->protein;


            // $food_array_html[$index] = new MealFoodItem($query_no, $food_array, $servingSize, $quantity);
            
            $food_array_component = new MealFoodItem($index_no, $food_array, $servingSize, $quantity);
    
            $food_array_html[$index]['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());


            // $food_array_html['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());
            
        }
        
        // for($i=0; $food_array_html.length; i++) {
        //     $food_array_html[$i] = $food_array_html[$i]->render()->with($food_array_component->data());
        // }

        // foreach($food_array_html as $index=>$food_array_component) {

        //     $food_array_html[$index]['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());

        // }

        return response()->json(['html' => $food_array_html]);

        //     $data_input_to_render .= "<input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$noOfFoods' readonly />";
        //     $data_input_to_render .= "<input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$noOfFoods' readonly />";
        //     $data_input_to_render .= "<input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$noOfFoods' readonly />";
        //     $data_input_to_render .= "<input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$noOfFoods' readonly />";
        //     $data_input_to_render .= "<input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$noOfFoods' readonly />";
        //     $data_input_to_render .= "<input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$noOfFoods' readonly />";

        // }       

        // $component = new MealFoodItem($noOfFoods, $food_array, $servingSize, $quantity);
        
        
        // use this when replacing stuff

        // $data_input_to_render .= "<input id='meal_servingsize_$noOfFoods' type='hidden' name='meal_servingsize_$noOfFoods'>";

        
        // return response()->json(['html' => (string)$component->render()->with($component->data()), 'html_input_data' => $data_input_to_render, 'food_array' => $food_array]);  
        // // return $component->render()->with($component->data());


    }

}
