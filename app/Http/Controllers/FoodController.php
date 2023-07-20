<?php

namespace App\Http\Controllers;

use App\View\Components\FoodItem;
use App\View\Components\FoodInputItem;
use Illuminate\Support\Facades\DB;

use Auth;

use Illuminate\Http\Request;
use Illuminate\View\Component;

use App\Models\FoodSource;
use App\Models\Food;
use App\Models\Macronutrients;

class FoodController extends Controller
{
    public function food_form()
    {   
        return view('nutrition_food_form');
    }

    public function food_form_store(Request $request) 
    {   
         $user = Auth::user();
         
         // will be used later to visualize what items go through!
         $added_items = [];

         if ($user) {
            $user_id = $user->id;
         } else {
            return 'You must be logged in first.';
         }

         $array_index = $request->input('food_pages');
         
         $array_index = explode(",", $array_index);

         for ($x=0; $x < count($array_index); $x++) {
            
            $array_index_x = $array_index[$x];

            $validated = $request->validate([

                "food_name_$array_index_x" => 'required|string|max:20',
                "food_source_$array_index_x" => 'required|string|max:20',
                "food_servingsize_$array_index_x" => 'required|numeric|max:1000',
                "food_calories_$array_index_x" => 'nullable|numeric|max:15000',
                "food_fat_$array_index_x" => 'nullable|numeric|max:1000',
                "food_carbs_$array_index_x" => 'nullable|numeric|max:1000',
                "food_protein_$array_index_x" => 'nullable|numeric|max:1000',

            ]);

            $food_name = $request->input("food_name_$array_index_x");
            $food_calories = $request->input("food_calories_$array_index_x");
            $food_source = $request->input("food_source_$array_index_x");
            $food_servingsize = $request->input("food_servingsize_$array_index_x");
            $food_fat = $request->input("food_fat_$array_index_x");
            $food_carbs = $request->input("food_carbs_$array_index_x");
            $food_protein = $request->input("food_protein_$array_index_x");


            $existingFoodSource = FoodSource::where('name', $food_source)->first();

            if ($existingFoodSource) {
                // do nothing

                $food_source_id = $existingFoodSource->id;
                
            } else {
                
                $newFoodSource = new FoodSource();

                $newFoodSource->name = "$food_source";

                $newFoodSource->save();

                $query = FoodSource::where('name', $food_source)->first();

                $food_source_id = $query->id;

            }


            // Add Food Source
            if ($food_source_id) {

                $newFood = new Food();

                $newFood->name = "$food_name";

                $newFood->user_id = $user_id;

                $newFood->source_id = $food_source_id;

                $newFood->save();

                $food_query = Food::where('name', "$food_name")
                                  ->where('source_id', $food_source_id)
                                  ->where('user_id', $user_id)
                                  ->latest('created_at')
                                  ->first();

                $food_id = $food_query->id;
                if ($food_id) {

                    $newMacronutrients = new Macronutrients();

                    $newMacronutrients->food_id = $food_id;

                    $newMacronutrients->food_unit_id = 1;

                    $newMacronutrients->serving_size = (float)$food_servingsize;

                    $newMacronutrients->calories = (float)$food_calories;

                    $newMacronutrients->fat = (float)$food_fat;

                    $newMacronutrients->carbohydrates = (float)$food_carbs;

                    $newMacronutrients->protein = (float)$food_protein;
                    // $newMacronutrients->calories = round((float)$food_calories / (float)$food_servingsize, 0);

                    // $newMacronutrients->fat = round((float)$food_fat / (float)$food_servingsize, 1);

                    // $newMacronutrients->carbohydrates = round((float)$food_carbs / (float)$food_servingsize, 1);

                    // $newMacronutrients->protein = round((float)$food_protein / (float)$food_servingsize, 1);

                    $newMacronutrients->save();

                    $macronutrients_query = Macronutrients::where('food_id', $food_id)
                                                          ->where('user_id', $user_id)
                                                          ->get();


                    
                    $added_items[] = ['index' => $x, 
                    'food_name' => $food_name, 
                    'food_source' => $food_source, 
                    'food_servingsize' => $food_servingsize,
                    'food_fat' => $food_fat,
                    'food_carbs' => $food_carbs,
                    'food_protein' => $food_protein];


                } else {

                    // do nothing
                    return "Your food doesn't exist";
                
                }    
                
                


            }





            
         }

        return view('nutrition_food_form', ['validated_data' => $added_items]);
        // return $added_items;


         //  return $validated;
    }

    public function food_view() {

        $user_id = Auth::user()->id;


        $food_search = Food::where('user_id', $user_id)
                            ->get();

        $food_array = [];

        foreach($food_search as $index=>$food) {
            $food_array[] = $food;

            $food_source_search = FoodSource::where('id', $food->source_id)
                                              ->first();
            


            $macronutrients_search = Macronutrients::where('food_id', $food->id)
                                                ->first();

            $food_array[$index]['source_name'] = $food_source_search->name;
            $food_array[$index]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$index]['calories'] = $macronutrients_search->calories;
            $food_array[$index]['fat'] = $macronutrients_search->fat;
            $food_array[$index]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$index]['protein'] = $macronutrients_search->protein;

            

        }                   
        
        // return $food_array;

        return view('nutrition_food_view', ['foods' => $food_array]);

        // $food_source_search = FoodSource::where('id', $food_search->source_id)
        //                                 ->get();


        // $food_macronutrients_search = Macronutrients::where('food_id', $id)
        //                                             ->first();


    }

    public function food_form_edit($id) {



        $user_id = Auth::user()->id;

        $food_search = Food::where('id', $id)
                        ->where('user_id', $user_id)
                        ->first();
        
        $food_source_search = FoodSource::where('id', $food_search->source_id)
                                        ->first();


        $food_macronutrients_search = Macronutrients::where('food_id', $id)
                                                ->first();

        if ($food_search['user_id'] === $user_id) {
            return view('nutrition_food_form_edit')->with('food', $food_search)
                                                   ->with('food_source', $food_source_search)
                                                   ->with('food_macronutrients', $food_macronutrients_search);
        } else {
            return view('nutrition_food_form');
        }
        
        // return view('nutrition_food_form_edit')->with('food', $food_search);

    }

    public function food_edit(Request $request, $id) {
        
        $user_id = Auth::user()->id;

        $food_name = $request->input("food_name_1");
        $food_calories = $request->input("food_calories_1");
        $food_source = $request->input("food_source_1");
        $food_servingsize = $request->input("food_servingsize_1");
        $food_fat = $request->input("food_fat_1");
        $food_carbs = $request->input("food_carbs_1");
        $food_protein = $request->input("food_protein_1");

        $food_search = Food::where('id', $id)
                                        ->where('user_id', $user_id)
                                        ->first();

        if ($food_search) {
            $food_to_update = Food::find($id);

            $food_source_search = FoodSource::where('id', $food_search->source_id)
                                        ->first();


            $macronutrients_to_update = Macronutrients::where('food_id', $id)
                                            ->first();

            $food_to_update->name = $food_name;
            $food_to_update->source_id = $food_search->source_id;
            
            $food_to_update->save();
            $food_to_update->touch();

            $macronutrients_to_update->serving_size = $food_servingsize;
            $macronutrients_to_update->calories = $food_calories;
            $macronutrients_to_update->fat = $food_fat;
            $macronutrients_to_update->carbohydrates = $food_carbs;
            $macronutrients_to_update->protein = $food_protein;

            $macronutrients_to_update->save();

            return view('nutrition_food_form');

        } else {

        }

    }

    // PAGE RENDER METHODS

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
