
@foreach($foods as $food)

@php
$food['calories'] = round(($food['calories']/($food['serving_size']))*$servingSize*$quantity, 0);
$food['fat'] = round(($food['fat']/($food['serving_size']))*$servingSize*$quantity, 1);
$food['carbohydrates'] = round(($food['carbohydrates']/($food['serving_size']))*$servingSize*$quantity, 1);
$food['protein'] = round(($food['protein']/($food['serving_size']))*$servingSize*$quantity, 1);

@endphp
<div id="meal_item_{{ $foodIndex }}" class="meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg p-6 text-white shadow-md shadow-black overflow-hidden fooditem-fade" index="{{$foodIndex}}">
    <ul class="@isset($food['img_url']) potato @else relative @endisset">

        {{-- @isset($food['img_url'])
            <img class="w-full h-full object-cover" src="{{ asset($food['img_url']) }}" />
        @endisset --}}

        <button id="item_revealbtn_{{ $foodIndex }}" index="{{ $foodIndex }}" class="food_revealbtn absolute right-0 bg-lime-800 text-white p-3 rounded-lg @if($showMoreButton == true)hidden @endif">
            <i id="item_icon_{{ $foodIndex }}" class="fas fa-chevron-down"> </i>
        </button>

        <div class="select-none max-h-[72px]" id="food_wrapper_{{ $foodIndex }}">
            {{-- <li class="font-bold text-left">#{{ $foodIndex }}</li> --}}

            

            @isset($food['img_url'])
                   @if($food['img_url'] == '') 
                    <p aria-label="index_number" class="absolute @if($showMoreButton==true)left-[75%] top-[0%]@else left-[50%] @endif text-8xl font-black opacity-10 select-none">{{ $foodIndex }}</p>
                    @else
            {{-- <p aria-label="index_number" class="z-50 absolute @if($showMoreButton==true)left-[75%] top-[5%]@else left-[50%] @endif text-8xl font-black opacity-60 select-none">{{ $foodIndex }}</p>
             --}}
            <div style="background-image: url('{{ asset($food['img_url']) }}')" aria-label="index_number" class="bg-center bg-cover bg-gradient-to-r from-transparent to-slate-800 absolute w-1/3 h-full object-cover fooditem-fade m-2 right-0 top-0 /-right-12 /-top-12  shadow-xl shadow-black absolute @if($showMoreButton==true)/left-[75%] /top-[0%]@else /left-[50%] @endif text-8xl font-black /opacity-10 select-none"></div>
            
            @endif
            @else
                <p aria-label="index_number" class="absolute @if($showMoreButton==true)left-[80%] top-[0%]@else left-[50%] @endif text-8xl font-black opacity-10 select-none">{{ $foodIndex }}</p>
            
            @endisset
         

            <li class="text-balance max-w-[144px]" id="food_text_name_{{$foodIndex}}">{{ $food['name'] }}</li>

            
            <p class="text-gray-500">{{ $food['serving_size_input'] }} {{$food['food_unit_short']}}@if($food['serving_size_input'] > 1 && ($food['food_unit_short'] == 'slice' || $food['food_unit_short'] == 'piece'))s @endif x {{ $food['quantity'] }}</p>
            <span id="food_text_source_{{$foodIndex}}"class="text-right text-gray-500">{{ $food['source'] }}</span>
            {{-- <p class="absolute right-0 bottom-0 text-gray-500">100g</p> --}}

        </div>
        
        <div id="nutritional_wrapper_{{ $foodIndex }}" class="@if($showNutrients==true)slide-down @endif">
            <div class="relative mt-3">
                <li id="food_text_calories_{{$foodIndex}}" class="italic">{{ $food['calories'] }}kcal</li>

                <p class="absolute right-0 top-0 text-gray-500">Calories</p>


                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_calories_{{$foodIndex}}" class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ((float)$food['calories'] / 1500) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_fat_{{$foodIndex}}" class="italic">{{$food['fat']}}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Fat</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_fat_{{$foodIndex}}" class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ((float)$food['fat'] / 97) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_carbs_{{$foodIndex}}" class="italic">{{ $food['carbohydrates'] }}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Carbs</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_carbs_{{$foodIndex}}" class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ((float)$food['carbohydrates'] / 97) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_protein_{{$foodIndex}}" class="italic">{{ $food['protein'] }}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Protein</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_protein_{{$foodIndex}}" class="bg-green-600 h-2.5 rounded-full" style="width: {{ ((float)$food['protein'] / 80) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </ul>
</div>
@endforeach
