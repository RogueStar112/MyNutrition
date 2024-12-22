<?php

namespace App\Http\Controllers;

use App\View\Components\MealSearchItem;
use App\View\Components\MealFoodItem;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;

use App\Models\Food;
use App\Models\FoodSource;
use App\Models\FoodUnit;

use App\Models\Macronutrients;
use App\Models\Micronutrients;

use App\Models\Meal;
use App\Models\MealItems;



use App\Models\MealNotifications;

use App\Models\Exercise;
use App\Models\ExerciseUnit;
use App\Models\ExerciseType;

use Illuminate\Support\Facades\DB;

use Livewire\Livewire;

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

            $food_imgurl = $food_search->img_url;

            $food_source_search = FoodSource::where('id', $food_search->source_id)
                                        ->first();

            $macronutrients_search = Macronutrients::where('food_id', $food_search->id)
                                        ->first();

            $micronutrients_search = Micronutrients::where('food_id', $food_search->id)
                                        ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                ->first();

            $validated = $request->validate([

                "meal_foodid_$food_pages_x" => 'required|numeric|max:10000000',

                // amount of food units is 11 for now.

                "meal_foodunitid_$food_pages_x" => 'required|numeric|max:11',
                
                
                
                // "meal_source_$food_pages_x" => 'required|string|max:20',
                "meal_servingsize_$food_pages_x" => 'required|numeric|max:5000',
                "meal_calories_$food_pages_x" => 'nullable|numeric|max:15000',
                "meal_fat_$food_pages_x" => 'nullable|numeric|max:5000',
                "meal_carbs_$food_pages_x" => 'nullable|numeric|max:5000',
                "meal_protein_$food_pages_x" => 'nullable|numeric|max:5000',
                "meal_sugars_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_saturates_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_fibre_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_salt_$food_pages_x" => 'nullable|numeric|max:1000',


                
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
        
            // $food_sugars = $request->input("meal_sugars_$food_pages_x");
            // $food_saturates = $request->input("meal_saturates_$food_pages_x");
            // $food_fibre = $request->input("meal_fibre_$food_pages_x");
            // $food_salt = $request->input("meal_salt_$food_pages_x");

            $food_sugars = $micronutrients_search->sugars ?? 0;
            $food_saturates = $micronutrients_search->saturates ?? 0;
            $food_fibre = $micronutrients_search->fibre ?? 0;
            $food_salt = $micronutrients_search->salt ?? 0;

            
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
            $food_array[$x]['img_url'] = $food_imgurl;

            $food_array[$x]['sugars'] = $food_sugars;
            $food_array[$x]['saturates'] = $food_saturates;
            $food_array[$x]['fibre'] = $food_fibre;
            $food_array[$x]['salt'] = $food_salt;

            
            if ($food_servingsize == NULL) {
                $food_array[$x]['serving_size_input'] = $macronutrients_search->serving_size;
                $food_servingsize = $macronutrients_search->serving_size;
            }


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


            
            $mealfooditem_component = new MealFoodItem($x+1, $food_array, $food_servingsize, $food_servingunit, $food_quantity, true, true, $food_imgurl);
            

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

            
        


        // $food_array_component = new MealFoodItem($meal_datendex_no, $food_array, $servingSize, $quantity);
            
        
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

        

        // $date_time = strtotime($request->input('MEAL_TIME')) + 60*60;

        // $is_DaylightSavings = date('I');

        // // Get the timezone offset in seconds 
        // $timezone_offset = date('Z'); 

        // // Adjust timestamp if it's Daylight Saving Time 
        $date_time = strtotime($request->input('MEAL_TIME'));
        // if ($is_DaylightSavings) {
        //     $date_time += $timezone_offset; 
        // } 

        $newMeal->time_planned = date('Y-m-d H:i:s', $date_time);

        // if the new meal's planned time is in the past...
        if (date('Y-m-d H:i:s', $date_time) < Carbon::now()->format('Y-m-d H:i:s')) {
            $newMeal->is_eaten = 1;
            $newMeal->is_notified = 0;
        } else {
            $newMeal->is_eaten = 0;
            $newMeal->is_notified = 0;
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

        $newMeal_notification_prompt = new MealNotifications();

        $newMeal_notification_prompt->meal_id = $newMeal_search->id;
        
        $newMeal_name = $newMeal_search->name;
        $newMeal_notification_prompt_time = date("d/m/Y H:i", $date_time);

        $newMeal_notification_prompt->message = "You have planned a meal named '$newMeal_name' for $newMeal_notification_prompt_time. Don't forget about it!";

        $newMeal_notification_prompt->is_accepted = 0;
        $newMeal_notification_prompt->type = 2;

        $newMeal_notification_prompt->save();
        $newMeal_notification_prompt->touch();


        // return view('nutrition_meal_form');
        return redirect()->route('meal.create');
    }

    public function search_food(Request $request) {
        $user_id = Auth::user()->id;
        $user_name = Auth::user()->name;

        $foods = $request->input('query');
        $servingSize = $request->input('servingSize');

        // if ($servingSize = 0) {



        // }

        $servingSize = $request->input('servingSize');

        if ($servingSize == 0) {
            $servingSize = 0;
        }

        $quantity = $request->input('quantity');

        $meal_dategnoreServingSize = $request->input('ignoreServingSize');

        

        $food_search = Food::where('name', 'LIKE', "%{$foods}%")
                        //    ->where('user_id', $user_id)
                           ->orderBy('id', 'desc')
                        //    ->groupBy('name', 'source_id')
                           ->paginate(6);


        // $food_search = Food::selectRaw('MAX(id) as id, name, source_id, MAX(created_at) as created_at, MAX(updated_at) as updated_at')
        //     ->where('name', 'LIKE', "%{$foods}%")
        //     ->orderBy('id', 'desc') // This applies to the aggregated column
        //     ->groupBy('name', 'source_id')
        //     ->paginate(15);

        $food_array = [];

        $current_page = $food_search->currentPage();

        foreach($food_search as $meal_datendex=>$food) {



            $food_array[] = $food;



            $food_source_search = FoodSource::where('id', $food->source_id)
                                                ->first();
            


            $macronutrients_search = Macronutrients::where('food_id', $food->id)
                                                ->first();

                                                
            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                                        ->first();

            $food_array[$meal_datendex]['source_name'] = $food_source_search->name;
            
            if ($meal_dategnoreServingSize == true) {
                $servingSize = $food_array[$meal_datendex]['serving_size'] = $macronutrients_search->serving_size;
            } else {
                // ignore
            }

            $food_array[$meal_datendex]['serving_size'] = $macronutrients_search->serving_size;

            if($macronutrients_search->serving_size <= 0) {
                $food_array[$meal_datendex]['serving_size'] = 1;
            }

            $food_array[$meal_datendex]['food_id'] = $food->id;
            $food_array[$meal_datendex]['user_name'] = $user_name;
            $food_array[$meal_datendex]['img_url'] = $food->img_url;
            $food_array[$meal_datendex]['calories'] = $macronutrients_search->calories;
            $food_array[$meal_datendex]['fat'] = $macronutrients_search->fat;
            $food_array[$meal_datendex]['food_unit_id'] = $food_unit->id; 
            $food_array[$meal_datendex]['food_unit_short'] = $food_unit->short_name;
            $food_array[$meal_datendex]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$meal_datendex]['protein'] = $macronutrients_search->protein;
            $food_array[$meal_datendex]['description'] = $food->description ?? '';
            $food_array[$meal_datendex]['icon_class'] = $food->icon_class ?? '';
            

        }                   

        if ($servingSize == "") {

            $component = new MealSearchItem($food_array, $macronutrients_search->serving_size, $quantity);        

        
        } else {

            $component = new MealSearchItem($food_array, $servingSize, $quantity);


        }

        


        // return $food_array;
        return $food_search->links() . $component->render()->with($component->data());


    }

    // public function render_arrays($array) {

    //     return (string)$array->render()->with($array->data());

    // }

    public function add_food_to_meal(Request $request) {
        $user_id = Auth::user()->id;

        $food_array_html = [];

        // $data_input_to_render = "";
        $data_input_to_render = [];

        $meal_datendex_array = [];

        $meals = $request->input('meals');

        foreach($meals as $meal_datendex=>$meal) {

            $food_array = [];

            $meal_datendex_no = $meal['index'];
            $query_no = $meal['query'];
            $servingSize = $meal['servingSize'];
            $quantity = $meal['quantity'];

            $food_array[$meal_datendex]['food_id'] = $query_no;
            
            $food_array[$meal_datendex]['index'] = $meal_datendex_no;

    

            $food_search = Food::where('id', "$query_no")
                            // ->where('user_id', $user_id)
                            // ->groupBy('name', 'source_id')
                            ->first();

            $food_source_search = FoodSource::where('id', $food_search->source_id)
                                                ->first();
            
            $food_array[$meal_datendex]['name'] = $food_search->name;

            $food_name = $food_search->name;

            $macronutrients_search = Macronutrients::where('food_id', $food_search->id)
                                                ->first();

            $micronutrients_search = Micronutrients::where('food_id', $food_search->id)
                                                ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                                ->first();

            $food_array[$meal_datendex]['source'] = $food_source_search->name;

            $food_id = $food_search->id;

            $food_unit_id = $food_unit->id; 

            // $food_search = Food::find((int)$food_pages_x);
            $food_imgurl = $food_search->img_url;
            
            // if ($meal_dategnoreServingSize == true) {
            //     $servingSize = $food_array[$meal_datendex]['serving_size'] = $macronutrients_search->serving_size;
            // } else {
            //     // ignore
            // }
            
            $food_array[$meal_datendex]['serving_size_input'] = $servingSize;
            $food_array[$meal_datendex]['quantity'] = $quantity;
            $food_array[$meal_datendex]['serving_size'] = $macronutrients_search->serving_size;
            $food_array[$meal_datendex]['food_unit_id'] = $food_unit->id; 
            $food_array[$meal_datendex]['food_unit_short'] = $food_unit->short_name;
            $food_array[$meal_datendex]['calories'] = $macronutrients_search->calories;
            $food_array[$meal_datendex]['fat'] = $macronutrients_search->fat;
            $food_array[$meal_datendex]['carbohydrates'] = $macronutrients_search->carbohydrates;
            $food_array[$meal_datendex]['protein'] = $macronutrients_search->protein;
            $food_array[$meal_datendex]['img_url'] = $food_imgurl;
            
            $food_array[$meal_datendex]['sugars'] = $micronutrients_search->sugars ?? 0 ;
            $food_array[$meal_datendex]['saturates'] = $micronutrients_search->saturates ?? 0;
            $food_array[$meal_datendex]['fibre'] = $micronutrients_search->fibre ?? 0 ;
            $food_array[$meal_datendex]['salt'] = $micronutrients_search->salt ?? 0;

            $food_sugars = $micronutrients_search->sugars ?? 0 ;
            $food_saturates = $micronutrients_search->saturates ?? 0;
            $food_fibre = $micronutrients_search->fibre ?? 0 ;
            $food_salt = $micronutrients_search->salt ?? 0;

            // $food_array_html[$meal_datendex] = new MealFoodItem($query_no, $food_array, $servingSize, $quantity);
            
            $food_array_component = new MealFoodItem($meal_datendex_no, $food_array, $servingSize, $food_unit->short_name, $quantity, false, false, $food_imgurl);
            
            $food_array_html[$meal_datendex]['index'] = (int)$meal_datendex_no;
            $food_array_html[$meal_datendex]['query'] = (int)$query_no;
            $food_array_html[$meal_datendex]['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());
            $food_array_html[$meal_datendex]['form_data'] = "

            <input class='meal_$food_id' id='meal_foodname_$food_id' type='hidden' name='meal_foodname_$food_id' value='$food_name' index='$meal_datendex_no' readonly />
            <input class='meal_$food_id'   id='meal_foodid_$food_id' type='hidden' name='meal_foodid_$food_id' value='$food_id' index='$meal_datendex_no' readonly />
            <input class='meal_$food_id'  id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$meal_datendex_no' readonly />
              <input class='meal_$food_id'  id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$meal_datendex_no' readonly />
             <input class='meal_$food_id'  id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id'    value='$macronutrients_search->carbohydrates' index='$meal_datendex_no' readonly />
              <input class='meal_$food_id'  id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$meal_datendex_no' readonly />
              <input class='meal_$food_id'  id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$meal_datendex_no' readonly />
             <input class='meal_$food_id'  id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$meal_datendex_no' readonly />
             <input class='meal_$food_id'  id='meal_foodunitid_$food_id' type='hidden' name='meal_foodunitid_$food_id' value='$food_unit_id' index='$meal_datendex_no' readonly />
             <input class='meal_$food_id'  id='meal_sugars_$food_id' type='hidden' name='meal_sugars_$food_id' value='$food_sugars' index='$meal_datendex_no' readonly />
              <input class='meal_$food_id'  id='meal_saturates_$food_id' type='hidden' name='meal_saturates_$food_id' value='$food_saturates' index='$meal_datendex_no' readonly />
             <input class='meal_$food_id'  id='meal_fibre_$food_id' type='hidden' name='meal_fibre_$food_id' value='$food_fibre' index='$meal_datendex_no' readonly />
             <input class='meal_$food_id'  id='meal_salt_$food_id' type='hidden' name='meal_salt_$food_id' value='$food_salt' index='$meal_datendex_no' readonly />
             
             
             
             
             ";


            // $food_array_html['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());
            

                // $data_input_to_render .= "<input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$meal_datendex_no' readonly />";
                // $data_input_to_render .= "<input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$meal_datendex_no' readonly />";
                // $data_input_to_render .= "<input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$meal_datendex_no' readonly />";
                // $data_input_to_render .= "<input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$meal_datendex_no' readonly />";
                // $data_input_to_render .= "<input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$meal_datendex_no' readonly />";
                // $data_input_to_render .= "<input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$meal_datendex_no' readonly />";

                $data_input_to_render[$query_no] = "
                <input id='meal_foodid_$food_id' type='hidden' name='meal_calories_$food_id' value='$food_id' index='$meal_datendex_no' readonly />
                <input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$meal_datendex_no' readonly />
                  <input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$meal_datendex_no' readonly />
                 <input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$meal_datendex_no' readonly />
                  <input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$meal_datendex_no' readonly />
                  <input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$meal_datendex_no' readonly />
                 <input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$meal_datendex_no' readonly />
                 <input id='meal_foodunitid_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$meal_datendex_no' readonly />
                <input id='meal_sugars_$food_id' type='hidden' name='meal_sugars_$food_id' value='$food_sugars' index='$meal_datendex_no' readonly />
                <input id='meal_saturates_$food_id' type='hidden' name='meal_saturates_$food_id' value='$food_saturates' index='$meal_datendex_no' readonly />
                <input id='meal_fibre_$food_id' type='hidden' name='meal_fibre_$food_id' value='$food_fibre' index='$meal_datendex_no' readonly />
                <input id='meal_salt_$food_id' type='hidden' name='meal_salt_$food_id' value='$food_salt' index='$meal_datendex_no' readonly />

                 ";


                // $data_input_to_render[$meal_datendex] = "<input id='meal_calories_$food_id' type='hidden' name='meal_calories_$food_id' value='$macronutrients_search->calories' index='$meal_datendex_no' readonly />
                //   <input id='meal_fat_$food_id' type='hidden' name='meal_fat_$food_id' value='$macronutrients_search->fat' index='$meal_datendex_no' readonly />
                //  <input id='meal_carbs_$food_id' type='hidden' name='meal_carbs_$food_id' value='$macronutrients_search->carbohydrates' index='$meal_datendex_no' readonly />
                //   <input id='meal_protein_$food_id' type='hidden' name='meal_protein_$food_id' value='$macronutrients_search->protein' index='$meal_datendex_no' readonly />
                //   <input id='meal_servingsize_$food_id' type='hidden' name='meal_servingsize_$food_id' value='$servingSize' index='$meal_datendex_no' readonly />
                //  <input id='meal_quantity_$food_id' type='hidden' name='meal_quantity_$food_id' value='$quantity' index='$meal_datendex_no' readonly />";
        }
        
        // for($meal_date=0; $food_array_html.length; i++) {
        //     $food_array_html[$meal_date] = $food_array_html[$meal_date]->render()->with($food_array_component->data());
        // }

        // foreach($food_array_html as $meal_datendex=>$food_array_component) {

        //     $food_array_html[$meal_datendex]['render_html'] = (string)$food_array_component->render()->with($food_array_component->data());

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

    public function calendar($date = null)
    {
        // credit to: https://jonathanbriehl.com/posts/build-a-simple-calendar-with-carbon-and-laravel#disqus_thread

        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
    
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

        $html = '<div class="calendar">';

        $html .= '<div class="month-year">';
        $html .= '<span class="month">' . $date->format('M') . '</span>';
        $html .= '<span class="year">' . $date->format('Y') . '</span>';
        $html .= '</div>';

        $html .= '<div class="days">';

        $dayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        foreach ($dayLabels as $dayLabel)
        {
            $html .= "<span class='day-label'>" . $dayLabel . '</span>';
        }

        while($startOfCalendar <= $endOfCalendar)
        {
            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
            $extraClass .= $startOfCalendar->isToday() ? ' today' : '';

            $day = $startOfCalendar->format('j');

            $html .= '<span class="day '.$extraClass.'"><span id="content-day-' . $day .'" class="content">' . $day . '</span></span>';
            $startOfCalendar->addDay();
        }
        $html .= '</div></div>';
        return $html;

        

    }

    public function meal_view() {
        $user_id = Auth::user()->id;

        $calendar = $this->calendar();

        // returns a series of Y-m-d dates.
        // $meal_dates_select = Meal::selectRaw('DATE_FORMAT("%Y-%m-%d", time_planned) as date')
        //                         ->where('user_id', $user_id)
        //                         // ->orderBy('time_planned', 'desc')
        //                         ->where('is_eaten', 1)
        //                         ->orderByRaw('date(time_planned) DESC')
        //                         ->distinct()
        //                         ->get();

        $check_if_local = env('DB_CONNECTION') === 'sqlite';
    

        if ($check_if_local) {
            // Local Environment

            $meal_dates_select_filterstr = "strftime('%Y-%m-%d', time_planned) as date, time_planned";
            $exercise_dates_select_filterstr = "strftime('%Y-%m-%d', exercise_start) as date, exercise_start";

            $meal_dates_select =        DB::table('meal')
                                            ->selectRaw($meal_dates_select_filterstr)
                                            ->where('user_id', 1)
                                            ->where('is_eaten', 1)
                                            ->groupBy('time_planned')
                                            ->orderBy('time_planned', 'desc')
                                            ->distinct()
                                            ->limit(14)
                                            ->get();


        } else {
            // Deployment Environment
            $meal_dates_select_filterstr = "DISTINCT DATE_FORMAT(time_planned, '%Y-%m-%d') as date, time_planned";
            $exercise_dates_select_filterstr = "DISTINCT DATE_FORMAT(exercise_start, '%Y-%m-%d') as date, exercise_start";
            
            $meal_dates_select =        DB::table('meal')
                                            ->selectRaw($meal_dates_select_filterstr)
                                            ->where('user_id', 1)
                                            ->where('is_eaten', 1)
                                            ->orderBy('time_planned', 'desc')
                                            ->limit(14)
                                            ->get();

        }



        // $meal_dates_select =        DB::table('meal')
        //         ->selectRaw("$meal_dates_select_filterstr")
        //         ->where('user_id', $user_id)
        //         ->where('is_eaten', 1)
        //         ->orderBy('time_planned', 'desc')
        //         ->limit(14)
        //         ->get();

        $exercise_dates_select = DB::table('exercise')
                ->selectRaw("$exercise_dates_select_filterstr")
                ->where('user_id', $user_id)
                ->orderBy("exercise_start", "desc")
                ->distinct()
                ->limit(14)
                ->get();

        // dd($exercise_dates_select);

        $meal_dates_ymd = [];

        foreach($exercise_dates_select as $exercise_date) {

            $exercise_time = date('H:i:s', strtotime($exercise_date->exercise_start));
            $exercise_date = date('Y-m-d', strtotime($exercise_date->date));


            $meal_dates_ymd[0][$exercise_date]['calories'] = 0;


            $meal_dates_ymd[0][$exercise_date]['times_planned'] = [];

            array_push($meal_dates_ymd[0][$exercise_date]['times_planned'], $exercise_time);
            
            $meal_dates_ymd[0][$exercise_date][$exercise_time]['calories'] = 0;
            // $meal_dates_ymd[0][$exercise_date]['fat'] = 0;
            // $meal_dates_ymd[0][$exercise_date]['carbs'] = 0;
            // $meal_dates_ymd[0][$exercise_date]['protein'] = 0;
            
            $exercise_select = Exercise::where('user_id', $user_id)
                                    ->whereBetween('exercise_start', [$exercise_date . ' 00:00:00', $exercise_date . ' 23:59:59'])
                                    ->orderByRaw('exercise_start ASC')
                                    ->get();

            foreach($exercise_select as $index=>$exercise) {
        

                $exercise_type_id = ExerciseType::where('id', $exercise->exercise_type_id)
                                        ->first();
                
                $exercise_name = $exercise_type_id->name;

                $exercise_distance = $exercise->distance;

                $exercise_duration = $exercise->duration;

                // $meal_dates_ymd[0][$exercise_date][$exercise_time]['fat'] = 0;
                // $meal_dates_ymd[0][$exercise_date][$exercise_time]['carbs'] = 0;
                // $meal_dates_ymd[0][$exercise_date][$exercise_time]['protein'] = 0;

                $meal_dates_ymd[0][$exercise_date]['calories'] -= $exercise->calories_total;

                $meal_dates_ymd[0][$exercise_date][$exercise_time]['calories'] -= $exercise->calories_total;

                $meal_dates_ymd[0][$exercise_date][$exercise_time]['meal_name'] = "Exercise: $exercise_distance" . "km " . $exercise_name . ", $exercise_duration min.";

                $meal_dates_ymd[0][$exercise_date][$exercise_time]['food_name'] = "$exercise_distance" . "km" . " $exercise_name";
                
                $meal_dates_ymd[0][$exercise_date][$exercise_time][$index]['food_name'] = "$exercise_distance" . "km" . " $exercise_name";

                $meal_dates_ymd[0][$exercise_date][$exercise_time][$index]['serving_size'] = 0;

                $meal_dates_ymd[0][$exercise_date][$exercise_time][$index]['fat'] = 0;

                $meal_dates_ymd[0][$exercise_date][$exercise_time][$index]['carbs']
                = 0;

                $meal_dates_ymd[0][$exercise_date][$exercise_time][$index]['protein']
                = 0;


                $meal_dates_ymd[0][$exercise_date][$exercise_time][$index]['calories'] = "-" . $exercise->calories_total;



            }


        }

        // dd($meal_dates_ymd);

        foreach ($meal_dates_select as $meal_date) {

            $meal_date = date('Y-m-d', strtotime($meal_date->date));

            // $meal_dates_ymd[$meal_date] = '';
            

            /* Data Structure Breakdown.

                

            */
            // $meal_dates_ymd[0][$meal_date]['meal_name'] = $meal_dates_select->


  
            if($meal_dates_ymd[0][$meal_date] ?? "") {
               
            } else {
                $meal_dates_ymd[0][$meal_date]['calories'] = 0;
            }

            $meal_dates_ymd[0][$meal_date]['fat'] = 0;
            $meal_dates_ymd[0][$meal_date]['carbs'] = 0;
            $meal_dates_ymd[0][$meal_date]['protein'] = 0;
            $meal_dates_ymd[0][$meal_date]['times_planned'] = [];
            $meal_dates_ymd[0][$meal_date]['serving_size'] = 0;
            $meal_dates_ymd[0][$meal_date]['serving_unit_short'] = "";


            $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$meal_date . ' 00:00:00', $meal_date . ' 23:59:59'])
                            ->where('is_eaten', 1)
                            ->orderByRaw('time_planned ASC')

                            ->get();


            
            foreach($meal_select as $meal_date=>$meal) {
                
                $meal_items_select = MealItems::where('meal_id', $meal->id)
                                        ->get();

                $meal_date = date('Y-m-d', strtotime($meal->time_planned));

                $meal_time = date('H:i:s', strtotime($meal->time_planned));

                

                // Push times planned so we can go through the process
                array_push($meal_dates_ymd[0][$meal_date]['times_planned'], $meal_time);
                
                
                $meal_dates_ymd[0][$meal_date][$meal_time]['serving_size'] = round($meal->serving_size ?? 1 * $meal->quantity ?? 1, 2);
            
                


                // $meal_dates_ymd[$meal_date]['meal_date'] = $meal_date;
                // $meal_dates_ymd[$meal_date]['time_planned'] = date('H:i', strtotime($meal->time_planned));
                $meal_dates_ymd[0][$meal_date][$meal_time]['meal_name'] = $meal->name;
                $meal_dates_ymd[0][$meal_date][$meal_time]['meal_id'] = $meal->id;
                
                // $meal_dates_ymd[$meal_date]['calories'] = 0;
                // $meal_dates_ymd[$meal_date]['fat'] = 0;
                // $meal_dates_ymd[$meal_date]['carbs'] = 0;
                // $meal_dates_ymd[$meal_date]['protein'] = 0;

                $meal_dates_ymd[0][$meal_date][$meal_time]['calories'] = 0;
                $meal_dates_ymd[0][$meal_date][$meal_time]['fat'] = 0;
                $meal_dates_ymd[0][$meal_date][$meal_time]['carbs'] = 0;
                $meal_dates_ymd[0][$meal_date][$meal_time]['protein'] = 0;

                $meal_dates_ymd[0][$meal_date][$meal_time]['serving_unit_short'] = "";
                                        
                foreach($meal_items_select as $food_index=>$meal_item) {




                    // get specific nutrients of food
                    $foods = Macronutrients::where('food_id', $meal_item->food_id)
                                                ->get();
                    
                    // $meal_dates_ymd['name'] = $food_index;                         
                    
                    $food_img = DB::table('food')
                                    ->select('img_url')
                                    ->where("id", "=", $meal_item->food_id)
                                    ->get();

                    // $meal_portion = (float)$meal_item->serving_size*$meal_item->quantity;

                    // $meal_dates_ymd[0][$meal_date][$meal_time]['serving_size'] 
                     

                    foreach($foods as $food) {
                        // $meal_dates_ymd[$food_index]['calories'] = $food->calories;

                        // $meal_dates_ymd[$food_index]['serving_size_food'] = $food->serving_size;

                        // $meal_dates_ymd[$food_index]['serving_size_meal'] = $meal_item->serving_size;

                        // $meal_dates_ymd[$food_index]['time_planned'] = $meal->time_planned;

                        
                         $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['serving_unit_short'] = FoodUnit::find($meal_item->food_unit_id)->short_name;
        

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['img_url'] = $food_img[0];

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['food_id'] = $meal_item->food_id; 

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['food_name'] = $meal_item->name; 

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['calories'] = (int)(($food->calories /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity;

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['serving_size'] = $meal_item->serving_size;

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['quantity'] = $meal_item->quantity;

                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['serving_x_quantity'] = round($meal_item->serving_size*$meal_item->quantity, 0);

                        

                        $meal_dates_ymd[0][$meal_date]['calories'] += round((($food->calories /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 0);

                        $meal_dates_ymd[0][$meal_date][$meal_time]['calories'] += round((($food->calories /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 0);

                        
                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['fat'] = round((($food->fat /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time]['fat'] += round((($food->fat /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);


                        $meal_dates_ymd[0][$meal_date]['fat'] += round((($food->fat /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        // $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['fat'] += round((($food->fat /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['carbs'] = round((($food->carbohydrates /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        $meal_dates_ymd[0][$meal_date]['carbs'] += round((($food->carbohydrates /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);


                        $meal_dates_ymd[0][$meal_date][$meal_time]['carbs'] += round((($food->carbohydrates /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time][$food_index]['protein'] = round((($food->protein /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        $meal_dates_ymd[0][$meal_date]['protein'] += round((($food->protein /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);
                        
                        $meal_dates_ymd[0][$meal_date][$meal_time]['protein'] += round((($food->protein /(float) $food->serving_size) * (float)$meal_item->serving_size)*$meal_item->quantity, 1);

                        
                    }  

                    // Rounding the numbers to prevent trailing decimals.

                    // $meal_dates_ymd[$meal_date]['calories'] = round($meal_dates_ymd[$meal_date]['calories'], 0);
                    // $meal_dates_ymd[$meal_date]['fat'] = round($meal_dates_ymd[$meal_date]['fat'], 1);
                    // $meal_dates_ymd[$meal_date]['carbs'] = round($meal_dates_ymd[$meal_date]['carbs'], 1);
                    // $meal_dates_ymd[$meal_date]['protein'] = round($meal_dates_ymd[$meal_date]['protein'], 1);

                    $meal_dates_ymd[0][$meal_date]['calories'] = round($meal_dates_ymd[0][$meal_date]['calories'], 0);
                    $meal_dates_ymd[0][$meal_date]['fat'] = round($meal_dates_ymd[0][$meal_date]['fat'], 1);
                    $meal_dates_ymd[0][$meal_date]['carbs'] = round($meal_dates_ymd[0][$meal_date]['carbs'], 1);
                    $meal_dates_ymd[0][$meal_date]['protein'] = round($meal_dates_ymd[0][$meal_date]['protein'], 1);
                    
                    $meal_dates_ymd[0][$meal_date][$meal_time]['calories'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['calories'], 0);
                    $meal_dates_ymd[0][$meal_date][$meal_time]['fat'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['fat'], 1);
                    $meal_dates_ymd[0][$meal_date][$meal_time]['carbs'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['carbs'], 1);
                    $meal_dates_ymd[0][$meal_date][$meal_time]['protein'] = round($meal_dates_ymd[0][$meal_date][$meal_time]['protein'], 1);
                    
                   
                }       


            }
        }

        // return $meal_dates_ymd;

        // dd ($meal_dates_ymd);


        // dd($meal_dates_ymd);

        return view('nutrition_meal_view', ['meals' => $meal_dates_ymd, 'calendar' => $calendar, 'user_id' => $user_id]);

    
        // return $meal_dates_select;

        // $meal_select = Meal::where('user_id', $user_id)
        //                     ->orderByRaw('time_planned DESC')
        //                     ->get();
        
        // return $meal_select;

        // $meal_dates_ymd = [];

        // foreach($meal_select as $meal_date=>$meal) {

        //     $meal_items_select = MealItems::where('meal_id', $meal->id)
        //                                 ->get();

            
        //     $meal_date = date('Y-m-d', strtotime($meal->time_planned));
        //     // $meal_dates_ymd = '';

        //     $meal_dates_ymd[$meal_date]['meal_date'] = $meal_date;
        //     $meal_dates_ymd[$meal_date]['time_planned'] = date('H:i', strtotime($meal->time_planned));
        //     $meal_dates_ymd[$meal_date]['meal_name'] = $meal->name;
        //     $meal_dates_ymd[$meal_date]['calories'] = 0;
        //     $meal_dates_ymd[$meal_date]['fat'] = 0;
        //     $meal_dates_ymd[$meal_date]['carbs'] = 0;
        //     $meal_dates_ymd[$meal_date]['protein'] = 0;
                                    
        //     foreach($meal_items_select as $food_index=>$meal_item) {


                

                

        //         // get specific nutrients of food
        //         $foods = Macronutrients::where('food_id', $meal_item->food_id)
        //                                     ->get();
                
        //         // $meal_dates_ymd['name'] = $food_index;                         
                

        //         foreach($foods as $food) {
        //             // $meal_dates_ymd[$food_index]['calories'] = $food->calories;

        //             // $meal_dates_ymd[$food_index]['serving_size_food'] = $food->serving_size;

        //             // $meal_dates_ymd[$food_index]['serving_size_meal'] = $meal_item->serving_size;

        //             // $meal_dates_ymd[$food_index]['time_planned'] = $meal->time_planned;



        //             $meal_dates_ymd[$meal_date][$food_index]['food_name'] = $meal_item->name; 

        //             $meal_dates_ymd[$meal_date][$food_index]['calories'] = (int)(($food->calories /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity;

        //             $meal_dates_ymd[$meal_date]['calories'] += round((($food->calories /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 0);

        //             $meal_dates_ymd[$meal_date][$food_index]['fat'] = round((($food->fat /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);
                    
        //             $meal_dates_ymd[$meal_date]['fat'] += round((($food->fat /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);
                    
        //             $meal_dates_ymd[$meal_date][$food_index]['carbs'] = round((($food->carbohydrates /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);

        //             $meal_dates_ymd[$meal_date]['carbs'] += round((($food->carbohydrates /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);
                    

        //             $meal_dates_ymd[$meal_date][$food_index]['protein'] = round((($food->protein /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);

        //             $meal_dates_ymd[$meal_date]['protein'] += round((($food->protein /(float) $food->serving_size) * ()$meal_item->serving_size)*$meal_item->quantity, 1);
                    
        //         }  

        //         // Rounding the numbers to prevent trailing decimals.

        //         $meal_dates_ymd[$meal_date]['calories'] = round($meal_dates_ymd[$meal_date]['calories'], 0);
        //         $meal_dates_ymd[$meal_date]['fat'] = round($meal_dates_ymd[$meal_date]['fat'], 1);
        //         $meal_dates_ymd[$meal_date]['carbs'] = round($meal_dates_ymd[$meal_date]['carbs'], 1);
        //         $meal_dates_ymd[$meal_date]['protein'] = round($meal_dates_ymd[$meal_date]['protein'], 1);

                
        //     }

        // }

        // return $meal_select;

        // return $meal_dates_ymd;

        // return view('nutrition_meal_view', ['meals' => $meal_dates_ymd]);

        // return view('nutrition_meal_view', ['meals' => $meal_select]);
    }

    public function meal_view_stats($start_date, $end_date) {

        $user_id = Auth::user()->id;
        
        $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                            ->orderByRaw('time_planned ASC')
                            ->get();
        
        return view('nutrition_meal_view_statistics', ['meals' => $meal_select]);

        
    }

    public function get_meals_from_dates($start_date, $end_date) {

        $user_id = Auth::user()->id;

        $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', [$start_date . ' 00:00:00', $end_date . ' 23:59:59'])
                            ->orderByRaw('time_planned ASC')
                            ->get();

        return $meal_select;

    }

    public function meal_edit_form($id) {

        $user_id = Auth::user()->id;

        $meals_array = [];

        $meal_select = Meal::where('user_id', $user_id)
                            ->where('id', $id)
                            ->get();

        foreach($meal_select as $meal_date=>$meal) {
                
                $meal_items_select = MealItems::where('meal_id', $meal->id)
                                        ->get();

        }

        // return $meal_items_select;

        foreach($meal_items_select as $key => $value) {
            $meals_array[$key]['name'] = $value->name;
            $meals_array[$key]['food_id'] = $value->food_id;
            $meals_array[$key]['servingSize'] = $value->serving_size;
            $meals_array[$key]['quantity'] = $value->quantity;
            
        }
        
        // dd($meals_array);
        
        return view('nutrition_meal_edit_form', ['meals' => $meal_select, 'meals_array' => $meals_array]);
    }

    public function load_meal_notifications() {

        $user_id = Auth::user()->id;

        $get_all_mealids_from_user = DB::table('meal')
                                        ->select('id')
                                        ->where('user_id', $user_id)
                                        ->where('is_eaten', 0)
                                        ->orderBy('id', 'desc')
                                        ->get();

        $meal_notifications_array = [];



        foreach ($get_all_mealids_from_user as $index => $meal_id) {

            $meal_notifications_array[$index+1] = DB::table('meal_notifications')->select('id', 'meal_id', 'message', 'type')->where('meal_id', $meal_id->id)->first();


        }
        
        // dd($meal_notifications_array);
        $meal_notifications_html = "";
        
        


            $meal_message = $meal_notification->message ?? "waiting";

     
            

            $meal_notifications_html = "";

            $meal_notifications_html .= '<div class="text-2xl mb-2 border-b-2 border-b-slate-500 italic text-left font-extrabold p-4" >NOTIFICATIONS</div>';

            
            $renderedComponents = [];

            $renderedComponents[] = '<div class="text-2xl mb-2 border-b-2 border-b-slate-500 italic text-left font-extrabold p-4" >NOTIFICATIONS</div>';

            // dd($meal_notifications_array);

            foreach ($meal_notifications_array as $meal_idkey => $meal_notification) {
                $meal_message = $meal_notification->message ?? "waiting";

                $meal_id = $meal_notification->id ?? "NaN";

                
                    $renderedComponents[] = view('livewire.meal-notification', [
                        'key' => $meal_notification->id ?? "NaN",
                        'mealId' => $meal_notification->meal_id ?? "NaN",
                        'message' => $meal_notification->message ?? "NaN", 
                    ])->render();

                    

            
            //     $meal_notifications_html .= '
            //     <div id="notification-meal-' . $meal_idkey . '" class="py-4 w-full bg-slate-900 text-white text-[12px] whitespace-normal indent-0 leading-none text-center px-4 relative z-50 flex flex-col justify-left gap-4 items-start">
            //         <div class="grow">
            //             <span class="text-slate-400 grow">' . $meal_idkey . ')</span> ' . $meal_message . '
            //         </div>
            //         <div class="flex w-full px-4 justify-around gap-4 items-end [&>*]:p-2 [&>*]:rounded-lg [&>*]:w-fit gap-6 [&>*]:text-center [&>*]:cursor-pointer mt-2 min-w-max">
            //             <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white" wire:click.prevent="markAsEaten(' . $meal_id . ')">Yes</button>
            //             <button type="button"  class="bg-red-600 hover:bg-red-700 text-white" wire:click.prevent="markAsDeleted(' . $meal_id . ')">No</button>
            //             <button type="button"  class="bg-yellow-600 hover:bg-yellow-700">Edit</button> 
            //         </div>
            //     </div>
            // ';
            }


            return response()->json(['components' => $renderedComponents]);
        // $meal_notifications_html = `
        // <div id="notification-meal-$meal_idkey" class="w-full bg-slate-900 text-white text-[12px] whitespace-normal indent-0 leading-none text-justify px-4 relative">
                                
        //                         <span class="text-slate-400">1)</span>
        //                         Your meal named Meal Deal has passed the time planned (08/08/2023 11:00). Have you eaten this meal?


        //                         <div class="flex w-full px-4 justify-around items-end [&>*]:p-2 [&>*]:w-full [&>*]:text-center mt-2 gap-4">
        //                             <div class="bg-green-600">YES</div>
        //                             <div class="bg-red-600">NO</div>
        //                         </div>

        //                     </div>
        // `

        



    }

    public function load_meal_notifications_count() {

        $user_id = Auth::user()->id;

        $get_all_mealids_from_user = DB::table('meal')
                                        ->select('id')
                                        ->where('user_id', $user_id)
                                        ->where('is_eaten', 0)
                                        ->get();

        // dd($get_all_mealids_from_user);

        $meal_notifications_array = [];

        // $meal_notifications_array[$user_id] = [];

        // foreach ($get_all_mealids_from_user as $meal_id) {

        //     $meal_notifications_array[$meal_id->id] = DB::table('meal_notifications')->select('id', 'message', 'type')->where('meal_id', $meal_id->id)->get();

        $notificationsCount = 0;
        // }
        foreach ($get_all_mealids_from_user as $index => $meal_id) {

        $meal_notifications_search = DB::table('meal_notifications')->select('id', 'meal_id', 'message', 'type')->where('meal_id', $meal_id->id)->get() ?? null;
                
                foreach ($meal_notifications_search as $notification) {

                    $meal_notifications_array[$index+1][$notification->type] = $notification;

                    $notificationsCount += 1;

                }
        
        // dd($meal_notifications_array);
        }

        // foreach ($meal_notifications_array as $meal_idkey => $meal_notification) {

            


        // }

        return $notificationsCount;

    }


    public function meal_form_edit_submission(Request $request) {
        
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

            $food_imgurl = $food_search->img_url;

            $food_source_search = FoodSource::where('id', $food_search->source_id)
                                        ->first();

            $macronutrients_search = Macronutrients::where('food_id', $food_search->id)
                                        ->first();

            $micronutrients_search = Micronutrients::where('food_id', $food_search->id)
                                        ->first();

            $food_unit = FoodUnit::where('id', $macronutrients_search->food_unit_id)
                ->first();

            $validated = $request->validate([

                "meal_foodid_$food_pages_x" => 'required|numeric|max:10000000',

                // amount of food units is 11 for now.

                "meal_foodunitid_$food_pages_x" => 'required|numeric|max:11',
                
                
                
                // "meal_source_$food_pages_x" => 'required|string|max:20',
                "meal_servingsize_$food_pages_x" => 'required|numeric|max:5000',
                "meal_calories_$food_pages_x" => 'nullable|numeric|max:15000',
                "meal_fat_$food_pages_x" => 'nullable|numeric|max:5000',
                "meal_carbs_$food_pages_x" => 'nullable|numeric|max:5000',
                "meal_protein_$food_pages_x" => 'nullable|numeric|max:5000',
                "meal_sugars_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_saturates_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_fibre_$food_pages_x" => 'nullable|numeric|max:1000',
                "meal_salt_$food_pages_x" => 'nullable|numeric|max:1000',


                
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
        
            // $food_sugars = $request->input("meal_sugars_$food_pages_x");
            // $food_saturates = $request->input("meal_saturates_$food_pages_x");
            // $food_fibre = $request->input("meal_fibre_$food_pages_x");
            // $food_salt = $request->input("meal_salt_$food_pages_x");

            $food_sugars = $micronutrients_search->sugars ?? 0;
            $food_saturates = $micronutrients_search->saturates ?? 0;
            $food_fibre = $micronutrients_search->fibre ?? 0;
            $food_salt = $micronutrients_search->salt ?? 0;

            
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
            $food_array[$x]['img_url'] = $food_imgurl;

            $food_array[$x]['sugars'] = $food_sugars;
            $food_array[$x]['saturates'] = $food_saturates;
            $food_array[$x]['fibre'] = $food_fibre;
            $food_array[$x]['salt'] = $food_salt;

            
            if ($food_servingsize == NULL) {
                $food_array[$x]['serving_size_input'] = $macronutrients_search->serving_size;
                $food_servingsize = $macronutrients_search->serving_size;
            }


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


            
            $mealfooditem_component = new MealFoodItem($x+1, $food_array, $food_servingsize, $food_servingunit, $food_quantity, true, true, $food_imgurl);
            

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

            
        


        // $food_array_component = new MealFoodItem($meal_datendex_no, $food_array, $servingSize, $quantity);
            
        
        return view('nutrition_meal_form_edit_summary', ['total_nutrients' => $total_nutrients, 'foods' => $food_array, 'food_array_components' => $food_array_components]);

    }
}
