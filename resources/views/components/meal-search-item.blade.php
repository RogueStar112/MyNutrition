<div class="max-w-7xl overflow-x-auto px-6">
    @php
        function getInitials($str) {
            $words = explode(" ", $str); // Split the string into an array of words
            $initials = "";

            foreach ($words as $word) {
                $initials .= $word[0]; // Append the first letter of each word
            }

            return strtoupper($initials); // Convert to uppercase and return
        }
    @endphp

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
        

        

        $food_name_initials = getInitials($food['name']);

        $food_class = $food['icon_class'] ?? false;

        @endphp

        <div class="md:grid md:grid-cols-[auto_minmax(150px,_1fr)_2fr] mb-6 bg-slate-200 dark:bg-[#111827] rounded-lg relative p-6" id="food-item-{{$food['food_id']}}" x-data="{ serving_size: {{$servingSize}}, quantity: {{$quantity}} }">

            <div class="bg-transparent self-center flex justify-center items-center h-[128px] w-[128px] max-w-[128px] max-h-[128px] {{ $food_class ? "[&>img]:hidden [&>i]:scale-150" : "[&>img]:flex" }} [&>img]:justify-evenly [&>img]:items-center rounded-full border-4 border-slate-500">

                <i class="{{ empty($food_class) ? "hidden" : "$food_class bg-gray dark:text-white scale-150 /leading-[128px] /h-[128px] /w-[128px] /max-w-[128px] /max-h-[128px] text-center " }} text-2xl sm:text-3xl md:text-4xl"></i>
                
                <img class="/p-6 object-cover {{ empty($food['img_url']) ? "hidden" : "" }} rounded-full {{  $food_class ? "hidden" : "" }} text-center leading-[128px] bg-gray dark:text-white text-2xl font-extrabold m-auto /min-h-full h-[128px] w-[128px] max-w-[128px] max-h-[128px]"    src="{{ asset($food['img_url']) }}"  alt="{{empty($food_class) ? $food_name_initials : ""}}  " />
            </div>

            <div class="desc-box m-4 md:m-0 md:pl-6 self-center">

                <div class="h-full">
                    <div class="h-1/2">
                        <p class="dark:text-white font-extrabold text-xl">{{$food['name']}}</p>
                        <p class="text-gray-500 text-lg">{{$food['source_name']}}</p>

                        <div class="flex items-center">
                            {{-- <img src="{{url('/img/blankpfp.png')}}" width="24" height="24"> --}}
                            <i class="fa-solid fa-user text-center text-md bg-gray dark:text-white"></i>
                            <p class="mx-3 text-gray-500">{{$food['user_name']}}</p>
                        </div>
                    </div>

                    {{-- <div class="h-1/2 block md:hidden">
                        <p class="bg-gray dark:text-white font-extrabold text-xl">{{$food['name']}}</p>
                        
                        <div class="flex justify-between mb-3 border-b-2 border-b-orange-400 border-opacity-40" >
                            <p class="text-gray-500 text-lg grow">{{$food['source_name']}}</p>

                            <div class="flex grow flex-row-reverse text-lg">
                            <i class="fa-solid fa-user text-center bg-gray dark:text-white"></i>
                            <p class="mx-3 text-gray-500">by {{$food['user_name']}}</p>
                            </div>
                        </div>
                        
                    </div> --}}
                </div>

            </div>

                
            <div class="bg-gray dark:text-white h-full text-center mr-2 self-center" aria-label="food-macros">
                <div class="flex justify-center gap-6 [&>button]:w-[16px] [&>button]:h-[16px]">

                    {{-- <div class="flex gap-3 justify-center">
                        <button class="text-red-600" x-on:click.prevent="serving_size -= 10"><i class="fa fa-minus"></i></button>
                    
                        <button class="text-red-400" x-on:click.prevent="parseFloat((serving_size -= 1).toFixed(1))"><i class="fa fa-minus"></i></button>

                        <button class="text-red-200" x-on:click.prevent="serving_size = parseFloat((serving_size - 0.1).toFixed(1))"><i class="fa fa-minus"></i></button>
                    </div> --}}


                    {{-- <p class="w-fit">Per {{($servingSize != $food['serving_size']) ? $servingSize : $food['serving_size']}}{{$food['food_unit_short']}}. (normally {{$food['serving_size'] . $food['food_unit_short']}}) </p> --}}

                    <p class="w-fit">Per <span x-text="serving_size"> </span>{{$food['food_unit_short']}} {{($quantity != 1) ? "x $quantity" : ""}}</p>

                    {{-- <div class="flex gap-3 justify-center">
                        <button class="text-green-200" x-on:click.prevent="serving_size = parseFloat((serving_size + 0.1).toFixed(1))"><i class="fa fa-plus"></i></button>

                        <button class="text-green-400" x-on:click.prevent="serving_size += 1"><i class="fa fa-plus"></i></button>

                        <button class="text-green-600" x-on:click.prevent="serving_size += 10"><i class="fa fa-plus"></i></button>
                    </div> --}}
                </div>
                {{-- <div class="h-full"></div> --}}

                {{-- Food Nutrients. --}}
                
                <div class="h-fit flex px-6 pt-4 pb-2 gap-3 [&>*]:text-clip [&>*]:flex-1 [&>*]:text-lg [&>*]:text-center [&>*]:flex [&>*]:flex-col [&>*>p]:text-clip">
                

                    <section>
                        <p>{{ ($food['calories'] > 1000) ? round($food['calories']/1000) . 'k ' : $food['calories'] . 'kcal' }}</p>
                        <div class="w-full mt-1 bg-gray-100 /dark:bg-gray-200 rounded-full h-2.5 bg-blue-100 dark:bg-blue-900">
                            <div id="food_progressbar_calories_{{$index}}" class="bg-blue-600 h-2.5 rounded-full {{$calorieExceedGlow ? "drop-shadow-glow animate-pulse" : ""}}" style="width: {{ $caloriePerc }}%"></div>
                        </div>
                        <p class="mt-1 text-blue-600">Calories</p>
                    {{-- <br>
                        {{$food['calories']}}cal --}}
                    </section>

                    <section>
                        <p>{{($food['fat'] > 1000) ? round($food['fat']/1000) . 'kg ' : $food['fat'] . 'g'}}</p>
                        <div class="w-full mt-1 bg-gray-100 dark:bg-gray-200 rounded-full h-2.5 bg-orange-100 dark:bg-orange-900">
                            <div id="food_progressbar_fat_{{$index}}" class="bg-orange-600 h-2.5 rounded-full {{$fatExceedGlow ? "drop-shadow-glow animate-pulse" : ""}}" style="width: {{ $fatPerc }}%"></div>
                        </div>
                        <p class="mt-1 text-orange-600">Fat</p>
                    {{-- <br>
                        {{$food['fat'] ? $food['fat'] : "0" }}g --}}
                    </section>


                    <section>
                        <p>{{($food['carbohydrates'] > 1000) ? round($food['carbohydrates']/1000) . 'kg ' : $food['carbohydrates'] . 'g'}}
                        </p>

                        <div class="w-full mt-1 bg-gray-100 dark:bg-gray-200 rounded-full h-2.5 bg-yellow-100 dark:bg-yellow-900">
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

                        <div class="w-full mt-1 bg-gray-100 dark:bg-gray-200 rounded-full h-2.5 dark:bg-green-900">
                            <div id="food_progressbar_protein_{{$index}}" class="bg-green-600 h-2.5 rounded-full {{$proteinExceedGlow ? "drop-shadow-glow animate-pulse w-[110%] max-w-full overflow-hidden" : ""}}" style="width: {{ $proteinPerc }}%"></div>
                        </div>

                        <p class="mt-1 text-green-600">Protein</p>
                    </section>

                    {{-- <br>{{$food['protein'] ? $food['protein'] : "0" }}g --}}
                   

                </div>

                <p class="w-full text-center text-gray-500 select-none">{{$food['description']}}</p>

                {{-- <div class="h-full"></div> --}}
            </div>

            <div id="food-add-{{$food['food_id']}}" class="absolute top-0 md:top-auto flex flex-col gap-8 md:gap-0 justify-center items-center h-min md:h-full md:rounded-r-lg right-0 cursor-pointer md:max-w-[44px] p-4 md:p-0">
                    
                    <button type="button" class="grow flex justify-center items-center add_food_icon bg-green-500 rounded-full md:rounded-none py-[6px] md:py-0 md:rounded-tr-lg text-md" value="{{$food['id']}}">
                    <i id="food-add-icon-{{$food['food_id']}}" class="flex fas fa-plus fa-2x bg-gray dark:text-white self-center cursor-pointer py-auto px-2 rounded-tr-lg"></i>
                    </button>

                    <button type="button" class="grow bg-red-800 rounded-full md:rounded-none py-[6px] md:py-0 md:rounded-br-lg flex justify-center items-center delete_food_icon text-md" value="{{$food['id']}}" value="{{$food['food_id']}}">
                    <i id="food-del-icon-{{$food['food_id']}}" class="flex fas fa-trash fa-2x bg-gray dark:text-white self-center cursor-pointer py-auto px-2"></i>
                    </button>
                    
            </div>
        </div>


    @endforeach

    {{-- {{ $foods->links() }} --}}
    


 
    

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
                        // console.log('MEAL JSON QUERY ALREADY EXISTS. VAL RETAINED.');
                        var no_of_foods = parseInt($("#no_of_foods").val());
                    } else {
                        // console.log('NO OF FOODS INCREASED BY 1.')
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
                    
                    // console.log('FOOD ARRAY', food_array)

                    // Object.keys(meal_json).foreach()

                    // meal_json = Object.values(meal_json_array).sort(function(obj1, obj2) {
                    //     return obj1.index.localeCompare(obj2.index);

                    // })

                    // meal_json = Object.assign({}, meal_json)

                    // console.log('SORTED MEAL JSON', meal_json);

                    // let i=1;

                    
                    

                               

                    

                    $.ajax({
                        url: `/nutrition/meal/create_meal/${query}`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            meals: meal_json,
                            food_id: query
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
                            $('#FOOD-ITEMS-CONTAINER-MOBILE').empty();
                            $('#form-meal-foods').empty();

                            foods_pages = [];
                            $("#foods_pages").val(foods_pages);
                            
                            // console.log('RESPONSE HTML', Object.entries(response['html']));
                            
                            for (let i = 0; i < food_array.length; i++) {

                                if (response['html'][food_array[i]['index']] == i) {
                                    // console.log('Food already exists. Array length retained.')
                                    $("#no_of_foods").val(no_of_foods-1); 
                                } else {
                                    // console.log('RESPONSE HTML FOOD ARRAY I INDEX', response['html'][food_array[i]['index']])
                                    // console.log('I:', i)
                                    // console.log('Food array length increased.')


                                    $('#FOOD-ITEMS-CONTAINER').append(response['html'][food_array[i]['query']]['render_html']);

                                    $('#FOOD-ITEMS-CONTAINER-MOBILE').append(response['html'][food_array[i]['query']]['render_html']);

                                    // console.log('FOODS PAGES PUSH', response['html'][food_array[i]['query']]);

                                    foods_pages.push(response['html'][food_array[i]['query']]['query']);

                                    $("#foods_pages").val(foods_pages);

                                    // console.log('HTML INPUT DATA LAZARUS', response['html_input_data'][query])

                                    // console.log('HTML INPUT DATA LAZARUS', response['html_input_data'][query])

                                    // $("#form-meal-foods").append(response['html_input_data'][query]);

                                    $("#form-meal-foods").append(response['html'][food_array[i]['query']]['form_data']);
                                    
                                    $("#no_of_foods").val(no_of_foods); 
                                    
                                    // console.log('FOOD_ARRAY JACKSON', food_array);

                                    // $(`#food-add-${query}`).addClass(`bg-yellow-500 [&>*]:text-black`);
                                    
                                    // $(`#food-add-icon-${query}`).addClass(`fa-pencil`);

                                    // $(`#food-add-icon-${query}`).removeClass(`fa-plus`);

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
                            
                            $("#ITEMS-COUNT-MOBILE").text(`${Object.keys(meal_json).length}`)
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });

                    
                    


            });

            $('.delete_food_icon').on("click", function(e) {
                e.preventDefault();

                var query_delete = $(this).attr('value');

                var newArray = foods_pages.filter(function(e) { 
                    return e != query_delete; // Removed template literal
                });

                console.log('NEW DELETED ARRAY', newArray);

                foods_pages = newArray;

                delete meal_json[`${query_delete}`];

                console.log('MEAL_JSON DELETION', meal_json);

                $('#foods_pages').val(newArray);

                

                $(`.meal_${query_delete}`).remove();

                $("#FOOD-ITEMS-CONTAINER").trigger("change");

                var no_of_foods = parseInt($("#no_of_foods").val());

                $("#no_of_foods").val(no_of_foods - 1)

            });
            
            
        });

    </script>
</div>