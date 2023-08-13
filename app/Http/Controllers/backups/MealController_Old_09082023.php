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

    public function meal_form_submission(Request $request) {
        
        $food_pages = $request->input('foods_pages');

        $food_pages = explode(",", $food_pages);

        $food_array = [];

        $food_array_components = [];

        $total_nutrients = ['calories' => 0,
                            'fat' => 0,
                            'carbohydrates' => 0,
                            'protein' => 0];
        
        for ($x=0; $x < count($food_pages); $x++) {
            
            // reset food array each time to prevent multiple rendering
            $food_array = [];

            $food_pages_x = $food_pages[$x];

            // finds the specific food in the loop
            $food_search = Food::find((int)$food_pages_x);

            $food_source_search = FoodSource::where('id', $food_search->source_id)
                                        ->first();

            $macronutrients_search = Macronutrients::where('food_id', $food_search->id)
                                        ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                ->first();

            $validated = $request->validate([

                "meal_foodid_$food_pages_x" => 'required|numeric|max:10000000',

                // amount of food units is 11 for now.

                "meal_foodunitid_$food_pages_x" => 'required|numeric|max:11',
                
                
                
                // "meal_source_$food_pages_x" => 'required|string|max:20',
                "meal_servingsize_$food_pages_x" => 'required|numeric|max:1000',
                "meal_calories_$food_pages_x" => 'nullable|numeric|max:15000',
                "meal_fat_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_carbs_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_protein_$food_pages_x" => 'nullable|numeric|max:1000',

                
            ]);

            $food_name = $request->input("meal_foodname_$food_pages_x");
            $food_calories = $macronutrients_search->calories;
            $food_source = $food_source_search->name;
            $food_servingsize = $request->input("meal_servingsize_$food_pages_x");
            $food_servingunit = $request->input("meal_servingunit_$food_pages_x");
            $food_quantity = $request->input("meal_quantity_$food_pages_x");
            $food_fat = $macronutrients_search->fat;
            $food_carbs = $macronutrients_search->carbohydrates;
            $food_protein = $macronutrients_search->protein;
            
            $food_array[$x]['name'] = $food_name;
            $food_array[$x]['source'] = $food_source;
            $food_array[$x]['serving_size_input'] = $food_servingsize;
            $food_array[$x]['quantity'] = $food_quantity;
            $food_array[$x]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$x]['food_servingunit'] = $food_servingunit; 
            $food_array[$x]['food_unit_id'] = $food_unit->id; 
            $food_array[$x]['food_unit_short'] = $food_unit->short_name;
            $food_array[$x]['calories'] = $food_calories;
            $food_array[$x]['fat'] = $food_fat;
            $food_array[$x]['carbohydrates'] =  $food_carbs;
            $food_array[$x]['protein'] = $food_protein;

            $total_nutrients['calories'] += round(($food_calories/$macronutrients_search->serving_size)*$food_servingsize*$food_quantity, 0);
            $total_nutrients['fat'] += round(($food_fat/$macronutrients_search->serving_size)*$food_servingsize*$food_quantity, 1);
            $total_nutrients['carbohydrates'] += round(($food_carbs/$macronutrients_search->serving_size)*$food_servingsize*$food_quantity, 1);
            $total_nutrients['protein'] += round(($food_protein/$macronutrients_search->serving_size)*$food_servingsize*$food_quantity, 1);

            // $food_array[] = ['index' => $x, 
            // 'food_name' => $food_name, 
            // 'food_source' => $food_source,
            // 'food_servingunit' => $food_servingunit, 
            // 'food_unit_id' => $food_unit->id,
            // 'food_unit_short' => $food_unit->short_name,
            // 'food_servingsize' => $food_servingsize,
            // 'food_quantity' => $food_quantity,
            // 'food_calories' => $food_calories,
            // 'food_fat' => $food_fat,
            // 'food_carbs' => $food_carbs,
            // 'food_protein' => $food_protein
            // ];
            
            // (string)$food_array_component->render()->with($food_array_component->data());
            $mealfooditem_component = '';
            
            $mealfooditem_component = new MealFoodItem($x+1, $food_array, $food_servingsize, $food_servingunit, $food_quantity, true, true);
            
            $food_array_components[$x] = $mealfooditem_component->render()->with($mealfooditem_component->data());

            
        }



        // $food_array['total']['name'] = $food_name;
        // $food_array['total']['source'] = $food_source;
        // $food_array['total']['serving_size_input'] = $food_servingsize;
        // $food_array['total']['quantity'] = $food_quantity;
        // $food_array['total']['serving_size'] = $macronutrients_search->serving_size;
        // $food_array['total']['food_servingunit'] = $food_servingunit; 
        // $food_array['total']['food_unit_id'] = $food_unit->id; 
        // $food_array['total']['food_unit_short'] = $food_unit->short_name;
        // $food_array['total']['calories'] = $food_calories;
        // $food_array['total']['fat'] = $food_fat;
        // $food_array['total']['carbohydrates'] =  $food_carbs;
        // $food_array['total']['protein'] = $food_protein;

        // $food_array_components['total'] = $mealfooditem_component->render()->with($mealfooditem_component->data());

        // $mealfooditem_component = new MealFoodItem($x+1, $food_array, $food_servingsize, $food_servingunit, $food_quantity, true);
            
        // $food_array_components[] = $mealfooditem_component->render()->with($mealfooditem_component->data());

            
        


        // $food_array_component = new MealFoodItem($index_no, $food_array, $servingSize, $quantity);
            
        
        return view('nutrition_meal_form_summary', ['total_nutrients' => $total_nutrients, 'foods' => $food_array, 'food_array_components' => $food_array_components]);

    }


    public function meal_form_store(Request $request) {
        $user_id = Auth::user()->id;

        $array_index = $request->input('foods_pages');
         
        $array_index = explode(",", $array_index);

        // will be used later to visualize what items go through!
        $added_items = [];

        $newMeal = new Meal();

        $newMeal->user_id = $user_id;

        $newMeal->name = $request->input('MEAL_NAME');

        $date_time = strtotime($request->input('MEAL_TIME'));

        $newMeal->time_planned = date('Y-m-d H:i:s', $date_time);

        // if the new meal's planned time is in the past...
        if (date('Y-m-d H:i:s', $date_time) < date('Y-m-d H:i:s')) {
            $newMeal->is_eaten = 1;
        } else {
            $newMeal->is_eaten = 0;
        }

        $newMeal->save();


        $newMeal_search = Meal::where('user_id', $user_id)
                            ->latest('id')
                            ->first();

        for ($x=0; $x < count($array_index); $x++) {
            
            $array_index_x = $array_index[$x];

            $newFoodItem = new MealItems();

            $newFoodItem->name = $request->input("meal_foodname_$array_index_x");
            $newFoodItem->meal_id = $newMeal_search->id;
            $newFoodItem->food_id = $request->input("meal_foodid_$array_index_x");
            $newFoodItem->food_unit_id = $request->input("meal_foodunitid_$array_index_x");
            $newFoodItem->serving_size = $request->input("meal_servingsize_$array_index_x");
            $newFoodItem->quantity = $request->input("meal_quantity_$array_index_x");
            
            $newFoodItem->save();


        }

        return view('nutrition_meal_form');
        
    }

    public function search_food(Request $request) {
        $user_id = Auth::user()->id;

        $foods = $request->input('query');
        $servingSize = $request->input('servingSize');

        // if ($servingSize = 0) {



        // }

        $servingSize = $request->input('servingSize');

        if ($servingSize == 0) {
            $servingSize = 0;
        }

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

        if ($servingSize == "") {

            $component = new MealSearchItem($food_array, $macronutrients_search->serving_size, $quantity);        

        
        } else {

            $component = new MealSearchItem($food_array, $servingSize, $quantity);


        }

        return $component->render()->with($component->data());


    }

    // public function render_arrays($array) {

    //     return (string)$array->render()->with($array->data());

    // }

    public function add_food_to_meal(Request $request) {
        $user_id = Auth::user()->id;

        $food_array_html = [];

        // $data_input_to_render = "";
        $data_input_to_render = [];

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

            $food_name = $food_search->name;

            $macronutrients_search = Macronutrients::where('food_id', $food_search->id)
                                                ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                                ->first();

            $food_array[$index]['source'] = $food_source_search->name;

            $food_id = $food_search->id;

            $food_unit_id = $food_unit->id; 
            
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
            
            $food_array_component = new MealFoodItem($index_no, $food_array, $servingSize, $food_unit->short_name, $quantity, false, false);
            
            $food_array_html[$index]['index'] = (int)$index_no;
            $food_array_html[$index]['query'] = (int)$query_no;
            $food_array_html[$index]['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());
            $food_array_html[$index]['form_data'] = "

            <input id='meal_foodname_$food_id' type='hidden' name='meal_foodname_$food_id' value='$food_name' index='$index_no' readonly />
            <input id='meal_foodid_$food_id' type='hidden' name='meal_foodid_$food_id' value='$food_id' index='$index_no' readonly />
            <input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$index_no' readonly />
              <input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$index_no' readonly />
             <input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$index_no' readonly />
              <input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$index_no' readonly />
              <input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$index_no' readonly />
             <input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$index_no' readonly />
             <input id='meal_foodunitid_$food_id' type='hidden' name='meal_foodunitid_$food_id' value='$food_unit_id' index='$index_no' readonly />
             ";


            // $food_array_html['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());
            

                // $data_input_to_render .= "<input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$index_no' readonly />";
                // $data_input_to_render .= "<input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$index_no' readonly />";
                // $data_input_to_render .= "<input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$index_no' readonly />";
                // $data_input_to_render .= "<input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$index_no' readonly />";
                // $data_input_to_render .= "<input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$index_no' readonly />";
                // $data_input_to_render .= "<input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$index_no' readonly />";

                $data_input_to_render[$query_no] = "
                <input id='meal_foodid_$food_id' type='hidden' name='meal_calories_$food_id' value='$food_id' index='$index_no' readonly />
                <input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$index_no' readonly />
                  <input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$index_no' readonly />
                 <input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$index_no' readonly />
                  <input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$index_no' readonly />
                  <input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$index_no' readonly />
                 <input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$index_no' readonly />
                 <input id='meal_foodunitid_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$index_no' readonly />
                 ";


                // $data_input_to_render[$index] = "<input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$index_no' readonly />
                //   <input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$index_no' readonly />
                //  <input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$index_no' readonly />
                //   <input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$index_no' readonly />
                //   <input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$index_no' readonly />
                //  <input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$index_no' readonly />";
        }
        
        // for($i=0; $food_array_html.length; i++) {
        //     $food_array_html[$i] = $food_array_html[$i]->render()->with($food_array_component->data());
        // }

        // foreach($food_array_html as $index=>$food_array_component) {

        //     $food_array_html[$index]['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());

        // }

        return response()->json(['html' => $food_array_html, 'html_input_data' => $data_input_to_render]);

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

    public function meal_view() {
        $user_id = Auth::user()->id;

        $meal_dates_select = Meal::selectRaw('strftime("%Y-%m-%d", time_planned) as date')
                                ->where('user_id', $user_id)
                                // ->orderBy('time_planned', 'desc')
                                ->orderByRaw('date(time_planned) DESC')
                                ->distinct()
                                ->get();

        $meal_dates_ymd = [];
        // foreach ($meal_dates_select as $meal_date) {

        //     $meal_date = date('Y-m-d', strtotime($meal_date->time_planned));

        //     $meal_dates_ymd[$meal_date .= " 23:59:59"] = '';


        // }

        // return $meal_dates_ymd;

    
        return $meal_dates_select;

        $meal_select = Meal::where('user_id', $user_id)
                            ->orderByRaw('time_planned DESC')
                            ->get();
        
        // return $meal_select;

        $meal_items_array = [];

        foreach($meal_select as $i=>$meal) {

            $meal_items_select = MealItems::where('meal_id', $meal->id)
                                        ->get();

            
            $meal_date = date('Y-m-d', strtotime($meal->time_planned));
            // $meal_items_array = '';

            $meal_items_array[$i]['meal_date'] = $meal_date;
            $meal_items_array[$i]['time_planned'] = date('H:i', strtotime($meal->time_planned));
            $meal_items_array[$i]['meal_name'] = $meal->name;
            $meal_items_array[$i]['calories'] = 0;
            $meal_items_array[$i]['fat'] = 0;
            $meal_items_array[$i]['carbs'] = 0;
            $meal_items_array[$i]['protein'] = 0;
                                    
            foreach($meal_items_select as $food_index=>$meal_item) {


                

                

                // get specific nutrients of food
                $foods = Macronutrients::where('food_id', $meal_item->food_id)
                                            ->get();
                
                // $meal_items_array['name'] = $food_index;                         
                

                foreach($foods as $food) {
                    // $meal_items_array[$food_index]['calories'] = $food->calories;

                    // $meal_items_array[$food_index]['serving_size_food'] = $food->serving_size;

                    // $meal_items_array[$food_index]['serving_size_meal'] = $meal_item->serving_size;

                    // $meal_items_array[$food_index]['time_planned'] = $meal->time_planned;



                    $meal_items_array[$i][$food_index]['food_name'] = $meal_item->name; 

                    $meal_items_array[$i][$food_index]['calories'] = (int)(($food->calories /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity;

                    $meal_items_array[$i]['calories'] += round((($food->calories /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 0);

                    $meal_items_array[$i][$food_index]['fat'] = round((($food->fat /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 1);
                    
                    $meal_items_array[$i]['fat'] += round((($food->fat /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 1);
                    
                    $meal_items_array[$i][$food_index]['carbs'] = round((($food->carbohydrates /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 1);

                    $meal_items_array[$i]['carbs'] += round((($food->carbohydrates /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 1);
                    

                    $meal_items_array[$i][$food_index]['protein'] = round((($food->protein /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 1);

                    $meal_items_array[$i]['protein'] += round((($food->protein /(int) $food->serving_size) * (int)$meal_item->serving_size)*$meal_item->quantity, 1);
                    
                }  

                // Rounding the numbers to prevent trailing decimals.

                $meal_items_array[$i]['calories'] = round($meal_items_array[$i]['calories'], 0);
                $meal_items_array[$i]['fat'] = round($meal_items_array[$i]['fat'], 1);
                $meal_items_array[$i]['carbs'] = round($meal_items_array[$i]['carbs'], 1);
                $meal_items_array[$i]['protein'] = round($meal_items_array[$i]['protein'], 1);

                
            }

        }

        // return $meal_select;

        return $meal_items_array;

        // return view('nutrition_meal_view', ['meals' => $meal_items_array]);

        // return view('nutrition_meal_view', ['meals' => $meal_select]);
    }

}
