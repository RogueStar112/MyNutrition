<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Food') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="bg-gray-800 /h-32 rounded-lg" method="POST" action="{{ route('food.store')}}">
                    
                    <div id="FOOD_FORM_INPUTS">
                        <div id="food_number_1">
                            <div class="p-6">
                            <h1 class="text-white text-2xl">1. Food Name and Source</h1>
                            <p class="text-gray-500 italic mt-2">The basic information.</p>
                            </div>

                            <div class="mb-3 grid grid-cols-2 gap-1">
                                <label class="block p-6">
                                    <span class="text-white">Food Name</span>
                                    <input type="text" name="food_name_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Ricotta Cheese" />
                                </label>

                                <label class="block p-6">
                                    <span class="text-white">Food Source</span>
                                    <input type="text" name="food_source_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Aldi" />
                                </label>
                            </div> 

                            <div class="p-6">
                            <h1 class="text-white text-2xl">2. Nutritional Info</h1>
                            <p class="text-gray-500 italic mt-2">Per 100g. All fields optional.</p>
                            </div>

                            <div class="mb-3 grid grid-cols-4 gap-1">
                                
                                <label class="block p-6">
                                    <span class="text-white">Calories</span>
                                    <input type="text" name="food_calories_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182kcal" />
                                </label>

                                <label class="block p-6">
                                    <span class="text-white">Fat (g)</span>
                                    <input type="text" name="food_fat_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="14.1g" />
                                </label>

                                
                                <label class="block p-6">
                                    <span class="text-white">Carbs (g)</span>
                                    <input type="text" name="food_carbs_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7g" />
                                </label>

                                
                                <label class="block p-6">
                                    <span class="text-white">Protein (g)</span>
                                    <input type="text" name="food_protein_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="11.7g" />
                                </label>
                            </div>

                            <div class="p-6">
                                <h1 class="text-white text-2xl">3. Extra Info</h1>
                            </div>

                            <div class="mb-3">
                                <label class="block p-6">
                                    <span class="text-white">Description</span>
                                    <input type="text" name="food_description_1" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Tastes good on pizza" />
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="food-media-controls">
                        <div class="flex justify-center">
                            <button type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg disabled opacity-60"><i class="fas fa-arrow-left"></i></button>
                            <button type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-plus"></i></button>
                            <button type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-right"></i></button>
                        </div>

                        <div class="flex justify-center">
                            <p class="text-gray-500 italic mt-2">Food 1 out of 1.</p>
                        </div>

                        <div class="flex justify-center">
                            <button type="button" class="bg-red-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                            <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-eye"></i>  VIEW</button>
                            <button type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
                    </div>
                    


                </form>
            </div>

            <div class="max-w-sm mx-auto /sm:px-6 /lg:px-8 [&>div]:mb-3">

                <x-food-item index="1" name="Ricotta Cheese" calories="380" fat="21.7" carbs="17.4" protein="23.4" />

                <x-food-item index="2" name="Pizza Slice" calories="274" fat="23.3" carbs="27.1" protein="8.4" />

                

                {{-- <div id="food_item_1" class="h-24 bg-gray-800 w-64 rounded-lg p-6 text-white">
                    <ul class="relative">

                        <button id="food_item_revealbtn_1" index="1" class="food_revealbtn absolute right-0 bg-lime-800 text-white p-3 rounded-lg"><i class="fas fa-chevron-down"></i></button>

                        <div id="food_wrapper_1">
                            <li class="font-bold text-left">Number 1</li>
                            <li>Ricotta Cheese</li>
                        </div>
                        
                        <div id="nutritional_wrapper_1" class="collapse">
                            <div class="mt-3">
                                <li class="italic">182kcal</li>

                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 26%"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <li class="italic">14.1g Fat</li>
                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-orange-600 h-2.5 rounded-full" style="width: 47%"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <li class="italic">4.7g Carbs</li>

                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-yellow-600 h-2.5 rounded-full" style="width: 11%"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <li class="italic">11.7g Protein</li>

                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>

                <div id="food_item_2" class="h-24 bg-gray-800 w-64 rounded-lg p-6 text-white">
                    <ul class="relative">

                        <button id="food_item_2_revealbtn" index="2" class="food_revealbtn absolute right-0 bg-lime-800 text-white p-3 rounded-lg"><i class="fas fa-chevron-down"></i></button>

                        <div id="food_wrapper_2">
                            <li class="font-bold text-left">Number 2</li>
                            <li>Ricotta Cheese</li>
                        </div>
                        
                        <div id="nutritional_wrapper_2" class="collapse">
                            <div class="mt-3">
                                <li class="italic">182kcal</li>

                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 26%"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <li class="italic">14.1g Fat</li>
                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-orange-600 h-2.5 rounded-full" style="width: 47%"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <li class="italic">4.7g Carbs</li>

                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-yellow-600 h-2.5 rounded-full" style="width: 11%"></div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <li class="italic">11.7g Protein</li>

                                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div class="bg-green-600 h-2.5 rounded-full" style="width: 70%"></div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div> --}}

            </div>
            {{-- <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <form class="bg-gray-800 /h-32 rounded-lg" method="POST" action="{{ route('food.store')}}">
                    
                    <div class="p-6">
                    <h1 class="text-white text-2xl">1. Food Name and Source</h1>
                    <p class="text-gray-500 italic mt-2">The basic information.</p>
                    </div>
    
                    <div class="mb-3">
                        <label class="block p-6">
                            <span class="text-white">Food Name</span>
                            <input type="text" name="food_name" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Ricotta Cheese" />
                        </label>
                    </div> 
    
                    <div class="p-6">
                    <h1 class="text-white text-2xl">2. Nutritional Info</h1>
                    <p class="text-gray-500 italic mt-2">Per 100g</p>
                    </div>
    
                    <div class="mb-3 grid grid-cols-4 gap-1">
                        
                        <label class="block p-6">
                            <span class="text-white">Calories (kcal)</span>
                            <input type="text" name="food_calories" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182kcal" />
                        </label>
    
                        <label class="block p-6">
                            <span class="text-white">Fat (g)</span>
                            <input type="text" name="food_fat" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182kcal" />
                        </label>
    
                        
                        <label class="block p-6">
                            <span class="text-white">Carbs (g)</span>
                            <input type="text" name="food_carbs" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182kcal" />
                        </label>
    
                        
                        <label class="block p-6">
                            <span class="text-white">Protein (g)</span>
                            <input type="text" name="food_protein" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182kcal" />
                        </label>
                    </div>
    
                    <div class="mb-3">
                        <label class="block p-6">
                            <span class="text-white">Calories</span>
                            <input type="text" name="food_name" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182kcal" />
                        </label>
                    </div>
                </form>
            </div> --}}
        
        </div>

    </div>

    <script>
        $(document).ready(function() {


            $('.food_revealbtn').click(function() {
                var index_selector = $(this).attr('index');
                $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');
                $(`#food_item_${index_selector}`).toggleClass('h-24');
                $(`#item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
                $(`#item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
            });


        });

        
    </script>
</x-app-layout>
