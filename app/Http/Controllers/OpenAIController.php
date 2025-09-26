<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

use App\Models\FoodSource;
use App\Models\Food;
use App\Models\FoodUnit;
use App\Models\Macronutrients;
use App\Models\Micronutrients;
use App\Models\MealItems;

use Auth;



class OpenAIController extends Controller
{
    public function fake_prompt() {

        OpenAI::fake([
            CreateResponse::fake([
                'choices' => [
                    [
                        'text' => 'awesome!',
                    ],
                ],
            ]),
        ]);
        
        $completion = OpenAI::completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => 'PHP is ',
        ]);
        
        dd($completion['choices'][0]['text']);
    }

    public function real_prompt() {

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => 'Responding with pure JSON, can you provide the nutritional content for Chocolate Chip Cookies (per 100g)? Return the following ONLY: Calories (kcal), Fat (g), Carbs (g), Protein (g), Sugars (g), Saturates (g), Fibre (g), Salt (g). '],
            ],
        ]);
        
        echo $result->choices[0]->message->content; // Hello! How can I assist you today?



    }

    public function food_prompt(Request $request, $name, $serving_size, $source, $serving_unit) {

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                // can use 'system' in role alternatively.
                ['role' => 'user', 'content' => "Responding with pure JSON, can you provide the nutritional content for $name (per $serving_size $serving_unit, from $source)? Return the following ONLY: Calories (kcal), Fat (g), Carbs (g), Protein (g), Sugars (g), Saturates (g), Fibre (g), Salt (g). "],
            ],
        ]);
        
        // echo $result->choices[0]->message->content; // Hello! How can I assist you today?



        return response()->json(['result' => $result->choices[0]->message->content]);

    }

    public function empty_food_insertion(Request $request, $name) {

        $user_id = Auth::user()->id;

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                // can use 'system' in role alternatively.
                ['role' => 'user', 'content' => "Responding with pure JSON, can you provide the nutritional content for $name (per recommended serving size, from a reputable source)? Return the following ONLY: Serving size (g), Source, Calories (kcal), Fat (g), Carbs (g), Protein (g), Sugars (g), Saturates (g), Fibre (g), Salt (g). "],
            ],
        ]);

        $resultOutput = response()->json(['result' => $result->choices[0]->message->content]);
        

        $resultJSON = json_decode($resultOutput->getData()->result, true);

        // dd($resultJSON);

        $existingFoodSource = FoodSource::firstOrCreate(['name' => $resultJSON["Source"]]);
        $food_source_id = $existingFoodSource->id;


        // Add Food Source
        if ($food_source_id) {

              $newFood = Food::create([
                    'name' => $name,
                    'user_id' => $user_id,
                    'source_id' => $food_source_id,
                    'img_url' => '',
                    'description' => 'Autocompleted with AI Auto Fill.',
                    'icon_class' => '',
                ]);

                 Macronutrients::create([
                    'food_id' => $newFood->id,
                    'food_unit_id' => 1,
                    'serving_size' => $resultJSON["Serving size (g)"],
                    'calories' => $resultJSON["Calories (kcal)"],
                    'fat' => $resultJSON["Fat (g)"],
                    'carbohydrates' => $resultJSON["Carbs (g)"],
                    'protein' => $resultJSON["Protein (g)"],
                ]);

                Micronutrients::create([
                    'food_id' => $newFood->id,
                    'sugars' => $resultJSON["Sugars (g)"],
                    'saturates' => $resultJSON["Saturates (g)"],
                    'fibre' => $resultJSON["Fibre (g)"],
                    'salt' => $resultJSON["Salt (g)"],
                ]);

        }

    }
} 
