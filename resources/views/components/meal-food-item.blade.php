
@foreach($foods as $index=>$food)

@php
$food['calories'] = round(($food['calories'] / $food['serving_size']*$servingSize*$quantity), 0);
$food['fat'] = round(($food['fat'] / $food['serving_size']*$servingSize*$quantity), 1);
$food['carbohydrates'] = round(($food['carbohydrates'] / $food['serving_size']*$servingSize*$quantity), 1);
$food['protein'] = round(($food['protein'] / $food['serving_size']*$servingSize*$quantity), 1);


@endphp
<div id="meal_item_{{ $index }}" class="min-h-[120px] active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg p-6 text-white cursor-pointer" onclick="goToPage({{$index}})">
    <ul class="relative">
        <button id="item_revealbtn_{{ $index }}" index="{{ $index }}" class="food_revealbtn absolute right-0 bg-lime-800 text-white p-3 rounded-lg">
            <i id="item_icon_{{ $index }}" class="fas fa-chevron-down"> </i>
        </button>

        <div class="" id="food_wrapper_{{ $index }}">
            <li class="font-bold text-left">Number {{ $index }}</li>
            <li id="food_text_name_{{$index}}">{{ $food['name'] }}</li>
            <span id="food_text_source_{{$index}}"class="text-right text-gray-500">{{ $food['source'] }}</span>
            {{-- <p class="absolute right-0 bottom-0 text-gray-500">100g</p> --}}

        </div>
        
        <div id="nutritional_wrapper_{{ $index }}" class="slide-down">
            <div class="relative mt-3">
                <li id="food_text_calories_{{$index}}" class="italic">{{ $food['calories'] }}kcal</li>

                <p class="absolute right-0 top-0 text-gray-500">Calories</p>


                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_calories_{{$index}}" class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ((float)$food['calories'] / 1500) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_fat_{{$index}}" class="italic">{{$food['fat']}}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Fat</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_fat_{{$index}}" class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ((float)$food['fat'] / 97) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_carbs_{{$index}}" class="italic">{{ $food['carbohydrates'] }}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Carbs</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_carbs_{{$index}}" class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ((float)$food['carbohydrates'] / 97) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_protein_{{$index}}" class="italic">{{ $food['protein'] }}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Protein</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_protein_{{$index}}" class="bg-green-600 h-2.5 rounded-full" style="width: {{ ((float)$food['protein'] / 80) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </ul>
</div>
@endforeach
