<div class="max-w-7xl overflow-x-auto px-6">
    
    @foreach($foods as $index=>$food)
        
        @php

        // if ($food['serving_size'] == NULL) {
        //     $food['serving_size'] = 100;
        // }

        if($servingSize == 0 or $servingSize == "") {
            
            $servingSize = $food['serving_size'];

            $food['calories'] = round(($food['calories']/($food['serving_size']/$servingSize))*$quantity, 0);
            $food['fat'] = round($food['fat']*$quantity, 1);
            $food['carbohydrates'] = round($food['carbohydrates']*$quantity, 1);
            $food['protein'] = round($food['protein']*$quantity, 1);
        } else {

            $food['calories'] = round(($food['calories']/($food['serving_size']/$servingSize))*$quantity, 0);
            $food['fat'] = round(($food['fat']/($food['serving_size']/$servingSize))*$quantity, 1);
            $food['carbohydrates'] = round(($food['carbohydrates']/($food['serving_size']/$servingSize))*$quantity, 1);
            $food['protein'] = round(($food['protein']/($food['serving_size']/$servingSize))*$quantity, 1);
        }

        


        /*
        level guide
        1 - low
        2 - med
        3 - high
        */
        $calories_label_level = 1;
        $fat_label_level = 1;
        $carbs_label_level = 1;
        $protein_label_level = 1;

        if(($food['calories']/$food['serving_size'])*$servingSize >= 300) {
            $calories_label_level = 2;
        }

        if(($food['calories']/$food['serving_size'])*$servingSize >= 600) {
            $calories_label_level = 3;
        }

        if(($food['fat']/$food['serving_size'])*$servingSize >= 10.25) {
            $fat_label_level = 2;
        }

        if(($food['fat']/$food['serving_size'])*$servingSize >= 17.5) {
            $fat_label_level = 3;
        }

        if(($food['carbs']/$food['serving_size'])*$servingSize >= 13.75) {
            $fat_label_level = 2;
        }

        if(($food['carbs']/$food['serving_size'])*$servingSize >= 22.5) {
            $carbs_label_level = 3;
        }

        if($index % 2 == 0) {
            $isEven = true;
        } else {
            $isEven = false;
        }


        // Breakdown:
        // (FoodIntake / FoodAllowance) * 100

        $caloriePerc = ((float)$food['calories'] / 1250) * 100;
        $fatPerc = ((float)$food['fat'] / 90) * 100;
        $carbsPerc = ((float)$food['carbohydrates'] / 120) * 100;
        $proteinPerc = ((float)$food['protein'] / 96) * 100;

        $calorieExceedGlow = false;
        $fatExceedGlow = false;
        $carbsExceedGlow = false;
        $proteinExceedGlow = false;

        if($caloriePerc > 100) {
            $caloriePerc = 100;       
            $calorieExceedGlow = true;
        }

        if($fatPerc > 100) {
            $fatPerc = 100;
            $fatExceedGlow = true;
        }

        if($carbsPerc > 100) {
            $carbsPerc = 100;
            $carbsExceedGlow = true;
        }

        if($proteinPerc > 100) {
            $proteinPerc = 100;
            $proteinExceedGlow = true;
        } 
        

        @endphp

        <div class="grid grid-cols-[auto_minmax(150px,_1fr)_2fr] mb-6 bg-[#111827] rounded-lg relative p-6" id="food-item-{{$food['food_id']}}" x-data="{ serving_size: {{$servingSize}}, quantity: {{$quantity}} }">

            <div class="bg-transparent self-center">
                <img class="/p-6 object-cover rounded-full /min-h-full h-[128px] w-[128px] max-w-[128px] max-h-[128px]"    src="{{ asset($food['img_url']) }}"  alt="" />
            </div>

            <div class="desc-box m-6 self-center">

                <div class="h-full">
                    <div class="h-1/2">
                        <p class="text-white font-extrabold text-xl">{{$food['name']}}</p>
                        <p class="text-gray-500 text-lg">{{$food['source_name']}}</p>

                        <div class="flex">
                            <img src="{{url('/img/blankpfp.png')}}" width="24" height="24">
                            <p class="mx-3 text-gray-500">{{$food['user_name']}}</p>
                        </div>
                    </div>
                </div>

            </div>

                
            <div class="text-white h-full text-center mr-2 self-center" aria-label="food-macros">
                <div class="flex justify-center gap-6 [&>button]:w-[16px] [&>button]:h-[16px]">

                    <div class="flex gap-3 justify-center">
                        <button class="text-red-600" x-on:click.prevent="serving_size -= 10"><i class="fa fa-minus"></i></button>
                    
                        <button class="text-red-400" x-on:click.prevent="parseFloat((serving_size -= 1).toFixed(1))"><i class="fa fa-minus"></i></button>

                        <button class="text-red-200" x-on:click.prevent="serving_size = parseFloat((serving_size - 0.1).toFixed(1))"><i class="fa fa-minus"></i></button>
                    </div>


                    {{-- <p class="w-fit">Per {{($servingSize != $food['serving_size']) ? $servingSize : $food['serving_size']}}{{$food['food_unit_short']}}. (normally {{$food['serving_size'] . $food['food_unit_short']}}) </p> --}}

                    <p class="w-fit">Per <span x-text="serving_size"> </span>{{$food['food_unit_short']}}</p>

                    <div class="flex gap-3 justify-center">
                        <button class="text-green-200" x-on:click.prevent="serving_size = parseFloat((serving_size + 0.1).toFixed(1))"><i class="fa fa-plus"></i></button>

                        <button class="text-green-400" x-on:click.prevent="serving_size += 1"><i class="fa fa-plus"></i></button>

                        <button class="text-green-600" x-on:click.prevent="serving_size += 10"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
                {{-- <div class="h-full"></div> --}}

                {{-- Food Nutrients. --}}
                
                <div class="h-fit flex px-6 pt-4 pb-2 gap-3 [&>*]:text-clip [&>*]:flex-1 [&>*]:text-lg [&>*]:text-center [&>*]:flex [&>*]:flex-col [&>*>p]:text-clip">
                

                    <section>
                        <p x-text="parseFloat(serving_size * {{$food['calories']}}).toFixed(0) + 'kcal'">{{ ($food['calories'] > 1000) ? round($food['calories']/1000) . 'k ' : $food['calories'] . 'kcal' }}</p>
                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-blue-900">
                            <div id="food_progressbar_calories_{{$index}}" class="bg-blue-600 h-2.5 rounded-full {{$calorieExceedGlow ? "drop-shadow-glow animate-pulse" : ""}}" style="width: {{ $caloriePerc }}%"></div>
                        </div>
                        <p class="mt-1 text-blue-600">Calories</p>
                    {{-- <br>
                        {{$food['calories']}}cal --}}
                    </section>

                    <section>
                        <p>{{($food['fat'] > 1000) ? round($food['fat']/1000) . 'kg ' : $food['fat'] . 'g'}}</p>
                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-orange-900">
                            <div id="food_progressbar_fat_{{$index}}" class="bg-orange-600 h-2.5 rounded-full {{$fatExceedGlow ? "drop-shadow-glow animate-pulse" : ""}}" style="width: {{ $fatPerc }}%"></div>
                        </div>
                        <p class="mt-1 text-orange-600">Fat</p>
                    {{-- <br>
                        {{$food['fat'] ? $food['fat'] : "0" }}g --}}
                    </section>


                    <section>
                        <p>{{($food['carbohydrates'] > 1000) ? round($food['carbohydrates']/1000) . 'kg ' : $food['carbohydrates'] . 'g'}}
                        </p>

                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-yellow-900">
                            <div id="food_progressbar_carbs_{{$index}}" class="bg-yellow-500 h-2.5 rounded-full {{$carbsExceedGlow ? "drop-shadow-glow animate-pulse" : ""}}" style="width: {{ $carbsPerc }}%"></div>
                        </div>

                        <p class="mt-1 text-yellow-500">Carbs</p>
                    </section>
{{-- 
                    <br>
                        {{$food['carbohydrates'] ? $food['carbohydrates'] : "0" }}g --}}

                    <section>
                        <p>{{($food['protein'] > 1000) ? round($food['protein']/1000) . 'kg ' : $food['protein'] . 'g'}}
                        </p>

                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-green-900">
                            <div id="food_progressbar_protein_{{$index}}" class="bg-green-600 h-2.5 rounded-full {{$proteinExceedGlow ? "drop-shadow-glow animate-pulse w-[110%] max-w-full overflow-hidden" : ""}}" style="width: {{ $proteinPerc }}%"></div>
                        </div>

                        <p class="mt-1 text-green-600">Protein</p>
                    </section>

                    {{-- <br>{{$food['protein'] ? $food['protein'] : "0" }}g --}}
                   

                </div>

                <p class="w-full text-center text-gray-500 select-none">{{$food['description']}}</p>

                {{-- <div class="h-full"></div> --}}
            </div>

            <div id="food-add-{{$food['food_id']}}" class="absolute flex flex-col justify-center items-center h-full rounded-r-lg right-0 bg-green-500 add_food_icon cursor-pointer max-w-[44px]" value="{{$food['id']}}">
                    
                    <div class="grow flex justify-center items-center">
                    <i id="food-add-icon-{{$food['food_id']}}" class="flex fas fa-plus fa-2x text-white self-center cursor-pointer py-auto px-2"></i>
                    </div>

                    <div class="grow bg-red-800 rounded-br-lg flex justify-center items-center" >
                    <i id="food-del-icon-{{$food['food_id']}}" class="flex fas fa-trash fa-2x text-white self-center cursor-pointer py-auto px-2"></i>
                    </div>
                    
            </div>
        </div>


    @endforeach

    {{-- {{ $foods->links() }} --}}
    


    <div class="hidden old-v">
        <table class="px-2 md:w-full table-auto text-white text-center rounded-lg overflow-x-auto">

        <thead class="rounded-lg">
            <tr class="text-xs text-gray-700 uppercase h-4 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="p-4 hidden md:table-cell">#</th>
                <th class="p-4 w-[80%] md:w-auto">Name</th>
                <th class="hidden p-4 w-1/3 md:w-auto">Source</th>
                <th class="p-4 hidden /md:hidden md:table-cell">Serving Size</th>
                <th class="p-4 hidden md:table-cell">Calories</th>
                <th class="p-4 hidden md:table-cell">Fat</th>
                <th class="p-4 hidden md:table-cell">Carbs</th>
                <th class="p-4 hidden md:table-cell">Protein</th>
                <th class="p-4 w-[20px] md:w-auto">Action</th>
            </tr>
        </thead>
            
            
            @if(count($foods) === 0) 
                <tr>
                    <td class="px-6 py-3 hidden md:table-cell" colspan="9">No search results found.</td>
                </tr>
            
            @endif

            @php
                
                $isEven = false;

            @endphp

            <tbody>
                @foreach($foods as $index=>$food)

                    @php

                    // if ($food['serving_size'] == NULL) {
                    //     $food['serving_size'] = 100;
                    // }

                    if($servingSize == 0 or $servingSize == "") {
                        
                        $servingSize = $food['serving_size'];

                        $food['calories'] = round(($food['calories']/($food['serving_size']/$servingSize))*$quantity, 0);
                        $food['fat'] = round($food['fat']*$quantity, 1);
                        $food['carbohydrates'] = round($food['carbohydrates']*$quantity, 1);
                        $food['protein'] = round($food['protein']*$quantity, 1);
                    } else {

                        $food['calories'] = round(($food['calories']/($food['serving_size']/$servingSize))*$quantity, 0);
                        $food['fat'] = round(($food['fat']/($food['serving_size']/$servingSize))*$quantity, 1);
                        $food['carbohydrates'] = round(($food['carbohydrates']/($food['serving_size']/$servingSize))*$quantity, 1);
                        $food['protein'] = round(($food['protein']/($food['serving_size']/$servingSize))*$quantity, 1);
                    }

                    
        

                    /*
                    level guide
                    1 - low
                    2 - med
                    3 - high
                    */
                    $calories_label_level = 1;
                    $fat_label_level = 1;
                    $carbs_label_level = 1;
                    $protein_label_level = 1;

                    if(($food['calories']/$food['serving_size'])*$servingSize >= 300) {
                        $calories_label_level = 2;
                    }

                    if(($food['calories']/$food['serving_size'])*$servingSize >= 600) {
                        $calories_label_level = 3;
                    }

                    if(($food['fat']/$food['serving_size'])*$servingSize >= 10.25) {
                        $fat_label_level = 2;
                    }

                    if(($food['fat']/$food['serving_size'])*$servingSize >= 17.5) {
                        $fat_label_level = 3;
                    }

                    if(($food['carbs']/$food['serving_size'])*$servingSize >= 13.75) {
                        $fat_label_level = 2;
                    }

                    if(($food['carbs']/$food['serving_size'])*$servingSize >= 22.5) {
                        $carbs_label_level = 3;
                    }

                    if($index % 2 == 0) {
                        $isEven = true;
                    } else {
                        $isEven = false;
                    }
            

                    @endphp

                    {{-- alternating css pattern --}}
                    <tr class="border-gray-700 @if(!$isEven)dark:bg-gray-900 @endif">

                        {{-- text-gray-900 whitespace-nowrap dark:text-white --}}
                        <td class="px-6 py-3 hidden md:table-cell">{{$loop->iteration}}</td>
                        <td class="py-3">{{$food['name']}}<br><p class="hidden md:block text-gray-500">{{$food['source_name']}}</p></td>
                        <td class="hidden px-6 py-3"><p class="text-gray-500">{{$food['source_name']}}</p></td>
                        @if($food['serving_size'] != NULL)
                            @if($food['food_unit_short'] == 'slice')
                                <td class="px-6 py-3 hidden /md:hidden lg:table-cell">{{$food['serving_size']}} slices<br><p class="invisible">_</p></td>
                            @else
                                <td class="px-6 py-3 hidden /md:hidden lg:table-cell">{{$food['serving_size']}}{{$food['food_unit_short']}}<br><p class="invisible">_</p></td>
                            @endif  
                        @else
                            <td class="px-6 py-3 text-gray-500 hidden md:table-cell">N/A</td>
                        @endif

                        @if($calories_label_level == 1)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['calories']}}kcal<br><p class="uppercase text-gray-500 text-sm">LOW</p></td>
                        @elseif ($calories_label_level == 2)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-yellow-500">{{$food['calories']}}kcal<br><p class="uppercase text-gray-500 text-sm">MID</p></td>
                        @elseif ($calories_label_level == 3)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['calories']}}kcal<br><p class="uppercase text-gray-500 text-sm">HIGH</p></td>
                        @endif

                        {{-- Fat --}}

                        @if($fat_label_level == 1)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['fat']}}g<br><p class="uppercase text-gray-500 text-sm">LOW</p></td>
                        @elseif($fat_label_level == 2)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-yellow-500">{{$food['fat']}}g<br><p class="uppercase text-gray-500 text-sm">MID</p></td>
                        @elseif($fat_label_level == 3)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['fat']}}g<br><p class="uppercase text-gray-500 text-sm">HIGH</p></td>
                        @endif

                        {{-- Carbohydrates --}}

                        @if($carbs_label_level == 1)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['carbohydrates']}}g<br><p class="uppercase text-gray-500 text-sm">LOW</p></td>
                        @elseif($carbs_label_level == 2)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-yellow-500">{{$food['carbohydrates']}}g<br><p class="uppercase text-gray-500 text-sm">MID</p></td>
                        @elseif($carbs_label_level == 3)
                            <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['carbohydrates']}}g<br><p class="uppercase text-gray-500 text-sm">HIGH</p></td>
                        @endif

                        <td class="px-6 py-3 hidden md:table-cell">{{$food['protein']}}g<br><p class="invisible">_</p></td>
                        <td class="flex px-6 py-3 place-items-center justify-center gap-3">
                            <a class="rounded-lg hidden md:block" href="{{ route('food.edit', $food['id'])}}"><i class="fas fa-pencil-alt text-yellow-500"></i></a>
                            <a href="" class="hidden md:block"><i class="fas fa-eye text-blue-500 cursor-pointer hidden md:block" value="{{$food['id']}}"></i></a>
                            <i class="fas fa-plus text-green-500 cursor-pointer add_food_icon" value="{{$food['id']}}"></i>
                            {{-- <br><p class="invisible">_</p> --}}
                            <button class="p-2 rounded-lg hidden"><i id="food_icon_{{$food['id']}}" class="fas fa-eye text-white"></i></button>
                        </td>

                        <tr class="hidden px-6 py-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400" id="nutritional_info_food_{{$food['id']}}">
                            <td class="py-2" colspan="3">Nutritional Info (per {{$food['serving_size']}}g)</td>
                        </tr>

                        <tr class="hidden px-6 py-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400" id="nutritional_info_food_{{$food['id']}}">
                            <td class="py-2" colspan="1">Calories</td>
                            <td class="py-2" colspan="1">Fat</td>
                            <td class="py-2" colspan="1">Carbs</td>
                        </tr>

                        <tr class="hidden px-6 py-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400" id="nutritional_info_food_{{$food['id']}}">
                            <td class="py-2" colspan="1">{{$food['calories']}}kcal</td>
                            <td class="py-2" colspan="1">{{$food['fat']}}g</td>
                            <td class="py-2" colspan="1">{{$food['carbohydrates']}}g</td>
                        </tr>

                    </tr>

                @endforeach
            </tbody>

        </table>
    </div>

    

    <script>
        
        // noOfFoods is referred in nutrition_meal_form!
        

        $(document).ready(function() {

                /* Food can be added into meals through two ways

                    1. Adding a brand new food, to be put into meals.

                        

                    2. Using existing foods for meals.

                */

                // $('#add_new_food_icon').on("click", function(e) {

                    


                // })

                $('.add_food_icon').on("click", function(e) {

                    no_of_foods = 0;

                    // $("#no_of_foods").val(no_of_foods)

                    e.preventDefault();

                    if (meal_json[query]) {
                        console.log('MEAL JSON QUERY ALREADY EXISTS. VAL RETAINED.');
                        var no_of_foods = parseInt($("#no_of_foods").val());
                    } else {
                        console.log('NO OF FOODS INCREASED BY 1.')
                        var no_of_foods = parseInt($("#no_of_foods").val()) + 1;
                    }

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var query = $(this).attr('value');
                    var servingSize = $('#meal_servingsize_1').val();
                    var quantity = $('#meal_quantity_1').val();

                    var ignoreServingSize = $("#disable_servingsize_1").is(':checked');

                    // let x=1;

                    // for (x; x<=no_of_foods; x++) {
                        
                    //     if (meal_json[x]['query'] == query) {
 
                    //          console.log('CONFLICT FOUND', meal_json);


                             

                    //     } else {
                    //         meal_json[`${no_of_foods}`] = {'query': query,'servingSize': servingSize,'quantity': quantity};
                    //     }
 
                    // }
                    
                    // console.log('QUERY ', query);
                    
                    // console.log('MEAL JSON BLEURGH', meal_json);
                    // if (meal_json[query]) {
                    //     food_array
                    // } else {
                    //     food_array.push(meal_json[query]);
                    // }

                    meal_json[query] = {'index': no_of_foods, 'query': query, 'servingSize': servingSize,'quantity': quantity};
                    
                    // meal_json_array = [meal_json];
                    

                    var food_already_exists = false;

                    for (let i = 0; i < Object.keys(meal_json).length; i++) {
                        
                        try {

                            if (food_array[i]['query'] == query) {

                                meal_json[query]['index'] = i+1;

                                food_array[i] = meal_json[query];

                                var no_of_foods = parseInt($("#no_of_foods").val());


                            } else {
                                // food_array.push(meal_json[query])
                            }

                        } catch (e) {
                            console.log('ERROR FOOD ARRAY', e)

                            food_array.push(meal_json[query])
                            // food_array.push(meal_json[query])
                        }

                        // if (food_array[i]['query'] == query) {

                        // } else {
                        //     food_array.push(meal_json[query]);
                        // }
                        
                    }
                    
                    console.log('FOOD ARRAY', food_array)

                    // Object.keys(meal_json).foreach()

                    // meal_json = Object.values(meal_json_array).sort(function(obj1, obj2) {
                    //     return obj1.index.localeCompare(obj2.index);

                    // })

                    // meal_json = Object.assign({}, meal_json)

                    console.log('SORTED MEAL JSON', meal_json);

                    // let i=1;

                    
                    

                               

                    

                    $.ajax({
                        url: `/nutrition/meal/create_meal/${query}`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            meals: meal_json
                            // no_of_foods: no_of_foods,
                            // balancer: replacement_balancer,
                            // query: query,
                            // servingSize: servingSize,
                            // quantity: quantity
                            // ignoreServingSize: ignoreServingSize
                        },
                        success: function(response) {

                            // forEach(response['html']) {

                            // }
                            
                            // console.log('successful response: ', Object.keys(response['html']).length);
                            
                            // console.log('successful response to render: ' response['html'])
                            // $('#FOOD-ITEMS-CONTAINER').append(response['html']['render_html']);
                            
                            $('#FOOD-ITEMS-CONTAINER').empty();
                            $('#form-meal-foods').empty();

                            foods_pages = [];
                            $("#foods_pages").val(foods_pages);
                            
                            console.log('RESPONSE HTML', Object.entries(response['html']));
                            
                            for (let i = 0; i < food_array.length; i++) {

                                if (response['html'][food_array[i]['index']] == i) {
                                    // console.log('Food already exists. Array length retained.')
                                    $("#no_of_foods").val(no_of_foods-1); 
                                } else {
                                    // console.log('RESPONSE HTML FOOD ARRAY I INDEX', response['html'][food_array[i]['index']])
                                    // console.log('I:', i)
                                    // console.log('Food array length increased.')


                                    $('#FOOD-ITEMS-CONTAINER').append(response['html'][food_array[i]['query']]['render_html']);

                                    // console.log('FOODS PAGES PUSH', response['html'][food_array[i]['query']]);

                                    foods_pages.push(response['html'][food_array[i]['query']]['query']);

                                    $("#foods_pages").val(foods_pages);

                                    // console.log('HTML INPUT DATA LAZARUS', response['html_input_data'][query])

                                    // console.log('HTML INPUT DATA LAZARUS', response['html_input_data'][query])

                                    // $("#form-meal-foods").append(response['html_input_data'][query]);

                                    $("#form-meal-foods").append(response['html'][food_array[i]['query']]['form_data']);
                                    
                                    $("#no_of_foods").val(no_of_foods); 
                                    
                                    // console.log('FOOD_ARRAY JACKSON', food_array);

                                    $(`#food-add-${query}`).addClass(`bg-yellow-500 [&>*]:text-black`);
                                    
                                    $(`#food-add-icon-${query}`).addClass(`fa-pencil`);

                                    $(`#food-add-icon-${query}`).removeClass(`fa-plus`);

                                }
                            }

                            // for (const [key, value] of Object.entries(response['html'])) {
                                
                            //     $('#FOOD-ITEMS-CONTAINER').append(response['html'][key]['render_html']);
                            //     $("#no_of_foods").val(no_of_foods);

                            // }
                            // for (let i = 1; i <= Object.keys(response['html']).length; i++) {
                            //     console.log('successful response to render: ', response['html'][i]['render_html'])

                                

                            //     $('#FOOD-ITEMS-CONTAINER').append(response['html'][i]['render_html']);
                            // } 

                            // console.log('FULL RESPONSE HTML ', response['html'])
                            
                            // test
                            // $("#no_of_foods").val(0)

                            console.log('NO OF FOODS: SUCCESS', no_of_foods);
                            
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });

                    


            });

        });
    </script>
</div>