<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center">
            {{ __('Nutrition - Food View Item') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        
        @isset($foods)

        <div class="max-w-md overflow-x-auto bg-slate-800 h-screen w-full m-6 md:w-[1000px] md:h-full md:py-6 rounded-lg">
            
            @foreach($foods as $food)
            <div class="flex flex-col /md:grid /grid-cols-2 gap-x-2 gap-y-3 grid-flow-col ">
                <div class='flex flex-col place-items-center /bg-red-500 text-white rounded-lg shadow-xl min-h-[50px] row-span-2 col-span-1 p-6 items-center'>
                    
                    
                        <div class="flex flex-col text-center h-full items-center justify-center">
                        <p class="font-black text-2xl text-center">{{$food['name']}}</p>
                        <p class="m-0 p-0">{{$food['source_name']}}</p>
                        </div>
                    
                    
                </div>
                
                {{-- <div class='bg-orange-500 rounded-lg shadow-xl min-h-[50px] col-span-3' /></div> --}}

                {{-- 
                        
                --}}
                {{-- <div class='/bg-yellow-500 text-white text-center rounded-lg shadow-xl min-h-[50px] row-span-2 col-span-2 grid grid-cols-4 justify-items-center items-end [&>div]:text-center [&>div]:py-6 /[&>div]:h-full [&>div]:w-full gap-3 px-3'>
                    
                    <!-- Macronutrients -->
                    <div class="bg-blue-800">
                        <p class="font-black">{{$food['calories']}}kcal</p>

                        Calories

                    </div>


                    <div class="bg-orange-800">

                        <p>{{$food['fat']}}g</p>
                        Fat
                    </div>


                    <div class="bg-yellow-800">

                        </p>{{$food['carbohydrates']}}g</p>
                        Carbs
                    </div>


                    <div class="bg-green-800">

                        <p>{{$food['protein']}}g</p>
                        Protein
                    </div>

                </div> --}}
                <div class='bg-gray-500 rounded-lg shadow-xl min-h-[50px] p-4 mx-6' />
                       <img class='mx-auto max-h-[256px]' src="{{  url(''.$food['img_url']) }}" />
                </div>
                
                <p class="text-white m-4">Per {{$food['serving_size']}}{{$food['serving_unit']}}</p>

                <div id="nutritional_wrapper_" class="slide-down text-white m-4 list-none">

                

                    <div class="relative mt-3">
                        <li id="food_text_calories_" class="italic">{{ $food['calories'] }}kcal</li>
        
                        <p class="absolute right-0 top-0 text-gray-500">Calories</p>
        
        
                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div id="food_progressbar_calories_" class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ((float)$food['calories'] / 1500) * 100 }}%"></div>
                        </div>
                    </div>
        
                    <div class="relative mt-3">
                        <li id="food_text_fat_" class="italic">{{$food['fat']}}g</li>
                        <p class="absolute right-0 top-0 text-gray-500">Fat</p>
        
                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div id="food_progressbar_fat_" class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ((float)$food['fat'] / 97) * 100 }}%"></div>
                        </div>
                    </div>
        
                    <div class="relative mt-3">
                        <li id="food_text_carbs_" class="italic">{{ $food['carbohydrates'] }}g</li>
                        <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
        
                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div id="food_progressbar_carbs_" class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ((float)$food['carbohydrates'] / 97) * 100 }}%"></div>
                        </div>
                    </div>
        
                    <div class="relative mt-3">
                        <li id="food_text_protein_" class="italic">{{ $food['protein'] }}g</li>
                        <p class="absolute right-0 top-0 text-gray-500">Protein</p>
        
                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div id="food_progressbar_protein_" class="bg-green-600 h-2.5 rounded-full" style="width: {{ ((float)$food['protein'] / 80) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
                {{-- <div class='bg-teal-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-blue-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-indigo-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-purple-500 rounded-lg shadow-xl min-h-[50px]' />

                
                
                </div>
                <div class='bg-pink-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-slate-500 rounded-lg shadow-xl min-h-[50px]' /></div> --}}
            </div>
            @endforeach

        </div>

        @endisset

    </div>

    <script>

        
            
    </script>
</x-app-layout>
