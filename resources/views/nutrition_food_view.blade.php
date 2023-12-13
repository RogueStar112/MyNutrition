<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center">
            {{ __('Nutrition - Food View') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        
        @isset($foods)

        <div class="max-w-7xl overflow-x-auto ">
            
            @foreach($foods as $index=>$food)

                <div class="grid grid-cols-[50px_1fr_1fr] grid-rows-4 bg-[#1E293B] rounded-lg w-1/2 mx-auto my-6 p-6">

                    <p class="text-2xl text-[#334155]">{{$loop->iteration}}</p>
                    
                    <div class="col-start-2 col-end-3 row-start-1 row-end-2">
                        <p class="text-2xl text-white font-extrabold">{{$food['name']}}</p>
                        
                    </div>
                    
                    <div class="col-start-2 col-end-3 row-start-2 row-end-3 flex justify-between text-gray-500">
                        <td class="px-6 py-3 hidden md:table-cell">Per {{$food['serving_size'] . $food['serving_unit']}}</td>

                            
                            {{-- <div class="flex flex-row-reverse">
                                <p class="mx-3">{{$user_name}}</p>
                                <img src="{{url('/img/blankpfp.png')}}" width="40" height="24">
                            </div> --}}
        
                    </div>

                    <div class="col-start-2 col-end-3 row-start-3 row-end-4 flex justify-between text-gray-500">
                        <p class="italic">{{$food['source_name']}}</p>
                    </div>

                    <div class="row-span-4">
                        <div id="nutritional_wrapper_{{ $loop->iteration }}" class="visible text-gray-500 opacity-100 slide-down">
                            <div class="relative">
                                <li id="food_text_calories_{{$loop->iteration}}" class="italic">{{ $food['calories'] }}kcal</li>
                
                                <p class="absolute right-0 top-0 text-gray-500">Calories</p>
                
                
                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div id="food_progressbar_calories_{{$loop->iteration}}" class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ((float)$food['calories'] / 1500) * 100 }}%"></div>
                                </div>
                            </div>
                
                            <div class="relative mt-3">
                                <li id="food_text_fat_{{$loop->iteration}}" class="italic">{{$food['fat']}}g</li>
                                <p class="absolute right-0 top-0 text-gray-500">Fat</p>
                
                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div id="food_progressbar_fat_{{$loop->iteration}}" class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ((float)$food['fat'] / 97) * 100 }}%"></div>
                                </div>
                            </div>
                
                            <div class="relative mt-3">
                                <li id="food_text_carbs_{{$loop->iteration}}" class="italic">{{ $food['carbohydrates'] }}g</li>
                                <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
                
                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div id="food_progressbar_carbs_{{$loop->iteration}}" class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ((float)$food['carbohydrates'] / 97) * 100 }}%"></div>
                                </div>
                            </div>
                
                            <div class="relative mt-3">
                                <li id="food_text_protein_{{$loop->iteration}}" class="italic">{{ $food['protein'] }}g</li>
                                <p class="absolute right-0 top-0 text-gray-500">Protein</p>
                
                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div id="food_progressbar_protein_{{$loop->iteration}}" class="bg-green-600 h-2.5 rounded-full" style="width: {{ ((float)$food['protein'] / 80) * 100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach

            <table class="px-2 md:w-full table-fixed text-white text-center rounded-lg overflow-x-auto">

            {{-- credit to: https://flowbite.com/docs/components/tables/ for table css --}}
            <thead class="rounded-lg">
                <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th class="p-6 hidden md:table-cell">#</th>
                    <th class="p-6 w-1/3 md:w-auto">Name</th>
                    <th class="p-6 w-1/3 md:w-auto">Source</th>
                    <th class="p-6 hidden md:table-cell">Serving Size</th>
                    <th class="p-6 hidden md:table-cell">Calories</th>
                    <th class="p-6 hidden md:table-cell">Fat</th>
                    <th class="p-6 hidden md:table-cell">Carbohydrates</th>
                    <th class="p-6 hidden md:table-cell">Protein</th>
                    <th class="p-6 w-1/3 md:w-auto">Action</th>
                </tr>
            </thead>


                <tbody>
                    @foreach($foods as $index=>$food)


                        {{-- alternating css pattern --}}
                        @if($index % 2 == 1)
                        <tr class="bg-white dark:bg-gray-900 border-gray-700">
                            <td class="px-6 py-3 hidden md:table-cell">{{$loop->iteration}}</td>
                            <td class="py-3">{{$food['name']}}</td>
                            <td class="px-6 py-3">{{$food['source_name']}}</td>
                            @if($food['serving_size'] != NULL)
                                <td class="px-6 py-3 hidden md:table-cell">{{$food['serving_size']}}g</td>
                            @else
                                <td class="px-6 py-3 text-gray-500 hidden md:table-cell">N/A</td>
                            @endif
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['calories']}}kcal</td>
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['fat']}}g</td>
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['carbohydrates']}}g</td>
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['protein']}}g</td>
                            <td class="px-6 py-3">
                                <a class="p-2 rounded-lg" href="{{ route('food.edit', $food['id'])}}"><i class="fas fa-pencil-alt text-white"></i></a>
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
                            <td class="px-6 py-3">{{$food['source_name']}}</td>
                            @if($food['serving_size'] != NULL)
                                <td class="px-6 py-3 hidden md:table-cell">{{$food['serving_size']}}g</td>
                            @else
                                <td class="px-6 py-3 hidden md:table-cell text-gray-500">N/A</td>
                            @endif
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['calories']}}kcal</td>
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['fat']}}g</td>
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['carbohydrates']}}g</td>
                            <td class="px-6 py-3 hidden md:table-cell">{{$food['protein']}}g</td>
                            <td class="px-6 py-3">
                                <a class="p-2 rounded-lg" href="{{ route('food.edit', $food['id'])}}"><i class="fas fa-pencil-alt text-gray-500"></i></a>
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
        </div>
        @endisset

    </div>

    <script>

            
    </script>
</x-app-layout>
