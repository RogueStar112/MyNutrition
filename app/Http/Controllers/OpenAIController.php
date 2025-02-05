<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;


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

    public function food_prompt(Request $request, $name, $serving_size) {

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => "Responding with pure JSON, can you provide the nutritional content for $name (per $serving_size grams)? Return the following ONLY: Calories (kcal), Fat (g), Carbs (g), Protein (g), Sugars (g), Saturates (g), Fibre (g), Salt (g). "],
            ],
        ]);
        
        // echo $result->choices[0]->message->content; // Hello! How can I assist you today?



        return response()->json(['result' => $result->choices[0]->message->content]);

    }
} 
