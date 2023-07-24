<div class="max-w-7xl overflow-x-auto px-6">
    <table class="px-2 md:w-full table-auto text-white text-center rounded-lg overflow-x-auto">

    {{-- credit to: https://flowbite.com/docs/components/tables/ for table css --}}
    <thead class="rounded-lg">
        <tr class="text-xs text-gray-700 uppercase h-4 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th class="p-6 hidden md:table-cell">#</th>
            <th class="p-6 w-1/3 md:w-auto">Name</th>
            <th class="hidden p-6 w-1/3 md:w-auto">Source</th>
            <th class="p-6 hidden /md:hidden md:table-cell">Serving Size</th>
            <th class="p-6 hidden md:table-cell">Calories</th>
            <th class="p-6 hidden md:table-cell">Fat</th>
            <th class="p-6 hidden md:table-cell">Carbs</th>
            <th class="p-6 hidden md:table-cell">Protein</th>
            <th class="p-6 w-1/3 md:w-auto">Action</th>
        </tr>
    </thead>


        <tbody>
            @foreach($foods as $index=>$food)

                @php

                if ($food['serving_size'] == NULL) {
                    $food['serving_size'] = 100;
                }

                $food['calories'] = round(($food['calories']/($food['serving_size']/$servingSize))*$quantity, 0);
                $food['fat'] = round(($food['fat']/($food['serving_size']/$servingSize))*$quantity, 1);
                $food['carbohydrates'] = round(($food['carbohydrates']/($food['serving_size']/$servingSize))*$quantity, 1);
                $food['protein'] = round(($food['protein']/($food['serving_size']/$servingSize))*$quantity, 1);

                /*
                level guide
                1 - low
                2 - med
                3 - high
                */
                $fat_label_level = 1;
                $carbs_label_level = 1;
                $protein_label_level = 1;

                if(($food['fat']/100)*100 >= 10.25) {
                    $fat_label_level = 2;
                }

                if(($food['fat']/100)*100 >= 17.5) {
                    $fat_label_level = 3;
                }

                if(($food['carbs']/100)*100 >= 13.75) {
                    $fat_label_level = 2;
                }

                if(($food['carbs']/100)*100 >= 22.5) {
                    $carbs_label_level = 3;
                }
         

                @endphp

                {{-- alternating css pattern --}}
                @if($index % 2 == 1)
                <tr class="bg-white dark:bg-gray-900 border-gray-700">
                    <td class="px-6 py-3 hidden md:table-cell">{{$loop->iteration}}</td>
                    <td class="py-3">{{$food['name']}}</td>
                    <td class="hidden px-6 py-3">{{$food['source_name']}}</td>
                    @if($food['serving_size'] != NULL)
                        <td class="px-6 py-3 hidden /md:hidden lg:table-cell">{{$food['serving_size']}}g</td>
                    @else
                        <td class="px-6 py-3 text-gray-500 hidden md:table-cell">N/A</td>
                    @endif
                    <td class="px-6 py-3 hidden md:table-cell">{{$food['calories']}}kcal</td>

                    {{-- Fat --}}

                    @if($fat_label_level == 1)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['fat']}}g</td>
                    @elseif($fat_label_level == 2)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-yellow-500">{{$food['fat']}}g</td>
                    @elseif($fat_label_level == 3)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['fat']}}g</td>
                    @endif

                    {{-- Carbohydrates --}}

                    @if($carbs_label_level == 1)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['carbohydrates']}}g</td>
                    @else

                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['carbohydrates']}}g</td>
                    @endif

                    <td class="px-6 py-3 hidden md:table-cell">{{$food['protein']}}g</td>
                    <td class="px-6 py-3">
                        <a class="p-2 rounded-lg" href="{{ route('food.edit', $food['id'])}}"><i class="fas fa-pencil-alt text-yellow-500"></i></a>
                        <i class="fas fa-plus text-green-500 cursor-pointer add_food_icon" value="{{$food['id']}}"></i>
                        <button class="p-2 rounded-lg visible md:hidden"><i id="food_icon_{{$food['id']}}" class="fas fa-eye text-white"></i></button>
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
                @else
                <tr class="px-6 py-3 md:py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    <td class="px-6 py-3 hidden md:table-cell">{{$loop->iteration}}</td>
                    <td class="py-3">{{$food['name']}}</td>
                    <td class="hidden px-6 py-3">{{$food['source_name']}}</td>
                    @if($food['serving_size'] != NULL)
                        <td class="px-6 py-3 hidden /md:hidden lg:table-cell">{{$food['serving_size']}}g</td>
                    @else
                        <td class="px-6 py-3 hidden md:table-cell text-gray-500">N/A</td>
                    @endif
                    <td class="px-6 py-3 hidden md:table-cell">{{$food['calories']}}kcal</td>
                    @if($fat_label_level == 1)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['fat']}}g</td>
                    @elseif($fat_label_level == 2)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-yellow-500">{{$food['fat']}}g</td>
                    @elseif($fat_label_level == 3)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['fat']}}g</td>
                    @endif

                    {{-- Carbohydrates --}}

                    @if($carbs_label_level == 1)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-green-500">{{$food['carbohydrates']}}g</td>
                    @elseif($carbs_label_level == 2)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-yellow-500">{{$food['carbohydrates']}}g</td>
                    @elseif($carbs_label_level == 3)
                        <td class="px-6 py-3 hidden md:table-cell border-4 border-transparent border-b-red-500">{{$food['carbohydrates']}}g</td>
                    @endif


                    <td class="px-6 py-3 hidden md:table-cell">{{$food['protein']}}g</td>
                    <td class="px-6 py-3">
                        <a class="p-2 rounded-lg" href="{{ route('food.edit', $food['id'])}}"><i class="fas fa-pencil-alt text-yellow-500"></i></a>
                        <i class="fas fa-plus text-green-500 cursor-pointer add_food_icon" value="{{$food['id']}}"></i>
                        <button class="p-2 rounded-lg visible md:hidden"><i id="food_icon_{{$food['id']}}" class="fas fa-eye text-gray-500"></i></button>
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

                    <tr class="hidden px-6 py-3 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400" id="nutritional_info_food_{{$food['id']}}">
                        <td class="py-2 bg-red-400 text-black" colspan="1">HIGH</td>
                        <td class="py-2 bg-yellow-400 text-black" colspan="1">MED</td>
                        <td class="py-2 bg-green-400 text-black" colspan="1">LOW</td>
                    </tr>




                </tr>

                @endif
            @endforeach
        </tbody>

    </table>

    <script>
        $(document).ready(function() {
                $('.add_food_icon').on("click", function(e) {

                    e.preventDefault();
                    
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var query = $('#meal_name_1').val();
                    var servingSize = $('#meal_name_servingsize_1').val();
                    var quantity = $('#meal_name_quantity_1').val();

                    var ignoreServingSize = $("#disable_servingsize_1").is(':checked');

                    $.ajax({
                        url: `/nutrition/meal/create_meal/${query}`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            query: query,
                            servingSize: servingSize,
                            quantity: quantity
                            //ignoreServingSize: ignoreServingSize
                        },
                        success: function(response) {
                            $('#FOOD-ITEMS-CONTAINER').append(response);
                            console.log('success_2');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });


            });
        });
    </script>
</div>