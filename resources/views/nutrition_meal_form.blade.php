<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Meal') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success max-w-7xl rounded-lg mx-auto text-center bg-green-800 dark:text-white p-6" id="success-message-received">
        {{ session('success') }}
    </div>

        <script>
            setTimeout(() => {
                document.getElementById('success-message-received').style.display = 'none';
            }, 6000); // Disappears after 6 seconds
        </script>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger max-w-7xl rounded-lg mx-auto text-center bg-red-800 dark:text-white" id="error-message-received">
        <h2 class="text-2xl font-extrabold">Input Error</h2>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('error-message-received').style.display = 'none';
        }, 6000); // Disappears after 6 seconds
    </script>
    @endif


    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl flex-col-reverse md:flex-row relative mx-auto">

            <div class="max-w-7xl /w-[768px] mx-auto sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="dark:bg-gray-800 max-w-[65rem] /h-32 rounded-lg mx-4" method="GET" action="{{ route('meal.create_p2')}}">
                    @csrf

                    
                    <div id="FOOD_FORM_INPUTS" class="relative bg-gray-50 dark:bg-gray-800 w-full max-w-[400px] md:max-w-full md:max-h-[682px] overflow-hidden">
                       <x-meal-input-item index="1"/>

                    </div>

                    <div id="food-media-controls" class="sticky top-0 z-0 md:z-50 bg-gray-50 dark:bg-gray-800 hidden md:block">
                        {{-- <div class="flex justify-center">
                            <button id="PREV-PAGE-BTN" type="button" class="bg-lime-800 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-left"></i></button>
                            <button id="ADD-FOOD-BTN" type="button" class="bg-lime-800 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-plus"></i></button>
                            <button id="NEXT-PAGE-BTN" type="button" class="bg-lime-800 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-right"></i></button>
                        </div>

                        <div class="flex justify-center">
                            <p id="page-number-text" class="text-gray-500 italic mt-2">Food 1 out of 1.</p>
                        </div> --}}

                        <div class="flex justify-center z-[9999]">
                            <input type="hidden" id="pages" name="food_pages" value="1"/>
                            <button type="button" class="bg-red-600 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                            <button type="button" class="bg-blue-600 dark:text-white p-4 m-4 rounded-lg"><a href="{{ route('meal.view') }}"><i class="fas fa-eye"></i> VIEW</a></button>
                            <button type="submit" class="bg-lime-600 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
                    </div>


            
                    <div id="FOOD-ITEMS-CONTAINER-MOBILE" class="hidden sm:hidden max-w-sm mx-auto max-h-screen pb-4 /sm:px-6 /lg:px-8 [&>*]:my-3 [&>*]:mx-auto [&>div]:bg-slate-900">
                
                        <h2 class="text-center dark:text-white text-2xl italic mt-4 font-extrabold opacity-40">FOOD LIST</h2>

                        <p class="text-center text-gray-400 opacity-40">An example of what adding these items look like!</p>
                        
                        <div id="meal_item_1" class="opacity-40 meal_248 bg-gray-50 meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg    pt-6 dark:text-white shadow-md shadow-black overflow-hidden" index="1">
                            <ul class="relative ">
                                <button type="button" id="item_revealbtn_1" index="1" class="item_revealbtn_1 food_revealbtn absolute right-0 bg-lime-800 dark:text-white p-3 mr-6 rounded-lg ">
                                    <i id="item_icon_1" class="item_icon_1 fas fa-chevron-up"> </i>
                                </button>
                        
                                <div class="px-6">
                                    <div class="select-none max-h-[108px]" id="food_wrapper_1">
                                        
                        
                                        
                        
                                                            <p aria-label="index_number" class="absolute  left-[50%]  text-8xl font-black opacity-10 select-none">1</p>
                                        
                                                    
                        
                                        <li class="text-balance max-w-[144px]" id="food_text_name_1">Sweet Potato Fries</li>
                        
                                        
                                        <p class="text-gray-500"><span id="food_servingsize_1">100 g</span> x 1</p>
                                        <span id="food_text_source_1" class="text-right text-gray-500">Lidl</span>
                                        
                        
                                    </div>
                                    
                                    <div id="nutritional_wrapper_1" class="nutritional_wrapper_1 relative slide-down">
                                        <div class="relative mt-3">
                                            <li id="food_text_calories_1" class="italic">240kcal</li>
                        
                                            <p class="absolute right-0 top-0 text-gray-500">Calories</p>
                        
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_calories_1" class="bg-blue-600 h-2.5 rounded-full" style="width: 16%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_fat_1" class="italic">13.6g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Fat</p>
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_fat_1" class="bg-orange-600 h-2.5 rounded-full" style="width: 14.020618556701%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_carbs_1" class="italic">21.6g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_carbs_1" class="bg-yellow-600 h-2.5 rounded-full" style="width: 22.268041237113%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_protein_1" class="italic">16.9g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Protein</p>
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_protein_1" class="bg-green-600 h-2.5 rounded-full" style="width: 21.125%"></div>
                                            </div>
                                        </div>
                        
                                        
                                    </div>
                                </div>
                        
                                <div id="nutritional-media-buttons-1" class="nutritional-media-buttons-1 nutritional-media-buttons w-full flex text-center mt-3 [&amp;>*]:my-auto absolute left-0 bottom-0 duration-200 [&amp;>*]:cursor-pointer [&amp;>*>*]:cursor-pointer">
                        
                                    <div id="mealitem-edit-btn-1" class="w-full bg-yellow-500 hover:bg-yellow-600 duration-150 text-black">EDIT</div>
                                    <div id="mealitem-delete-btn-1" class="w-full bg-red-500 hover:bg-red-600 duration-150 dark:text-white" data-id="248" data-index="1">DELETE</div>
                        
                                    <div id="mealitem-delete-btn-confirmcontainer-1" class="w-full flex p-0 hidden" data-id="248">
                                        <div id="mealitem-delete-btn-no-1" class="w-full bg-red-500">X</div>
                                        <div id="mealitem-delete-btn-yes-1" class="w-full bg-green-500">🗑️</div>
                                    </div>
                        
                                </div>
                            </ul>
                        </div>

                        <div id="meal_item_2" class="opacity-40 meal_97 meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg    pt-6 dark:text-white shadow-md shadow-black overflow-hidden" index="2">
                            <ul class="relative  ">
                                <button type="button" id="item_revealbtn_2" index="2" class="item_revealbtn_2 food_revealbtn absolute right-0 bg-lime-800 dark:text-white p-3 mr-6 rounded-lg ">
                                    <i id="item_icon_2" class="item_icon_2 fa-chevron-down fas"> </i>
                                </button>
                        
                                <div class="px-6">
                                    <div class="select-none max-h-[108px]" id="food_wrapper_2">
                                        
                        
                                        
                        
                                                                            
                                        
                                        <p aria-label="index_number" class="absolute  left-[50%]  text-8xl font-black opacity-10 select-none">2</p>
                                        
                                                                    
                        
                                        <li class="text-balance max-w-[144px]" id="food_text_name_2">Hummus and Carrot Fries</li>
                        
                                        
                                        <p class="text-gray-500"><span id="food_servingsize_2">100 g</span> x 1</p>
                                        <span id="food_text_source_2" class="text-right text-gray-500">Homemade</span>
                                        
                        
                                    </div>
                                    
                                    <div id="nutritional_wrapper_2" class="nutritional_wrapper_2 relative">
                                        <div class="relative mt-3">
                                            <li id="food_text_calories_2" class="italic">127kcal</li>
                        
                                            <p class="absolute right-0 top-0 text-gray-500">Calories</p>
                        
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_calories_2" class="bg-blue-600 h-2.5 rounded-full" style="width: 8.4666666666667%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_fat_2" class="italic">8.5g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Fat</p>
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_fat_2" class="bg-orange-600 h-2.5 rounded-full" style="width: 8.7628865979381%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_carbs_2" class="italic">11g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_carbs_2" class="bg-yellow-600 h-2.5 rounded-full" style="width: 11.340206185567%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_protein_2" class="italic">4g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Protein</p>
                        
                                            <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_protein_2" class="bg-green-600 h-2.5 rounded-full" style="width: 5%"></div>
                                            </div>
                                        </div>
                        
                                        
                                    </div>
                                </div>
                        
                                <div id="nutritional-media-buttons-2" class="nutritional-media-buttons-2 nutritional-media-buttons w-full flex text-center mt-3 [&amp;>*]:my-auto absolute left-0 bottom-0 duration-200 [&amp;>*]:cursor-pointer [&amp;>*>*]:cursor-pointer hidden">
                        
                                    <div id="mealitem-edit-btn-2" class="w-full bg-yellow-500 hover:bg-yellow-600 duration-150 text-black">EDIT</div>
                                    <div id="mealitem-delete-btn-2" class="w-full bg-red-500 hover:bg-red-600 duration-150 dark:text-white" data-id="97" data-index="2">DELETE</div>
                        
                                    <div id="mealitem-delete-btn-confirmcontainer-2" class="w-full flex p-0 hidden" data-id="97">
                                        <div id="mealitem-delete-btn-no-2" class="w-full bg-red-500">X</div>
                                        <div id="mealitem-delete-btn-yes-2" class="w-full bg-green-500">🗑️</div>
                                    </div>
                        
                                </div>
                            </ul>
                        </div>
                        {{-- <div id="food-media-controls-mobile" class="sticky top-0 z-0 md:z-50 bg-gray-800 sm:hidden">
                         
                            <div class="flex justify-center">
                                <input type="hidden" id="pages" name="food_pages" value="1"/>
                                <button type="button" class="bg-red-600 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                                <button type="button" class="bg-blue-600 dark:text-white p-4 m-4 rounded-lg"><a href="{{ route('meal.view') }}"><i class="fas fa-eye"></i> VIEW</a></button>
                                <button type="submit" class="bg-lime-600 dark:text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                            </div>
                        </div> --}}
                    </div>

                    

                    <div id="FOOD-SEARCH-CONTAINER" class="[&>div]:m-4 pb-4 bg-gray-50 dark:bg-gray-800">
                        <!-- x-meal-search-items -->

                        <p class="text-center text-gray-400 opacity-40">An example of what searching looks like...</p>

                        <div class="md:grid md:grid-cols-[auto_minmax(150px,_1fr)_2fr] mb-6 bg-slate-300 dark:bg-[#111827] rounded-lg relative p-6 opacity-40 select-none" id="" x-data="{ serving_size: 100, quantity: 1 }">

                            <div class="bg-transparent self-center flex justify-center items-center h-[128px] w-[128px] max-w-[128px] max-h-[128px] [&amp;>img]:hidden [&amp;>i]:scale-150 [&amp;>img]:justify-evenly [&amp;>img]:items-center rounded-full border-4 border-slate-500">
                
                                <i class="fa-solid fa-carrot dark:text-white scale-150 /leading-[128px] /h-[128px] /w-[128px] /max-w-[128px] /max-h-[128px] text-center  text-2xl sm:text-3xl md:text-4xl"></i>
                                
                                <img class="/p-6 object-cover hidden rounded-full hidden text-center leading-[128px] dark:text-white text-2xl font-extrabold m-auto /min-h-full h-[128px] w-[128px] max-w-[128px] max-h-[128px]" src="http://localhost:8000/" alt="  ">
                            </div>
                
                            <div class="desc-box m-6 self-center">
                
                                <div class="h-full">
                                    <div class="h-1/2">
                                        <p class="dark:text-white font-extrabold text-xl">Sweet Potato Fries</p>
                                        <p class="text-gray-500 text-lg">Lidl</p>
                
                                        <div class="flex items-center">
                                            
                                            <i class="fa-solid fa-user text-center text-md dark:text-white"></i>
                                            <p class="mx-3 text-gray-500">FitnessAnon123</p>
                                        </div>
                                    </div>
                
                                    
                                </div>
                
                            </div>
                
                                
                            <div class="dark:text-white h-full text-center mr-2 self-center" aria-label="food-macros">
                                <div class="flex justify-center gap-6 [&amp;>button]:w-[16px] [&amp;>button]:h-[16px]">
                
                                    
                
                
                                    
                
                                    <p class="w-fit">Per <span x-text="serving_size">100</span>g </p>
                
                                    
                                </div>
                                
                
                                
                                
                                <div class="h-fit flex px-6 pt-4 pb-2 gap-3 [&amp;>*]:text-clip [&amp;>*]:flex-1 [&amp;>*]:text-lg [&amp;>*]:text-center [&amp;>*]:flex [&amp;>*]:flex-col [&amp;>*>p]:text-clip">
                                
                
                                    <section>
                                        <p>240kcal</p>
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-blue-900">
                                            <div id="food_progressbar_calories_0" class="bg-blue-600 h-2.5 rounded-full " style="width: 19.2%"></div>
                                        </div>
                                        <p class="mt-1 text-blue-600">Calories</p>
                                    
                                    </section>
                
                                    <section>
                                        <p>13.6g</p>
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-orange-900">
                                            <div id="food_progressbar_fat_0" class="bg-orange-600 h-2.5 rounded-full " style="width: 15.111111111111%"></div>
                                        </div>
                                        <p class="mt-1 text-orange-600">Fat</p>
                                    
                                    </section>
                
                
                                    <section>
                                        <p>21.6g
                                        </p>
                
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-yellow-900">
                                            <div id="food_progressbar_carbs_0" class="bg-yellow-500 h-2.5 rounded-full " style="width: 18%"></div>
                                        </div>
                
                                        <p class="mt-1 text-yellow-500">Carbs</p>
                                    </section>
                
                
                                    <section>
                                        <p>16.9g
                                        </p>
                
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-green-900">
                                            <div id="food_progressbar_protein_0" class="bg-green-600 h-2.5 rounded-full " style="width: 17.604166666667%"></div>
                                        </div>
                
                                        <p class="mt-1 text-green-600">Protein</p>
                                    </section>
                
                                    
                                   
                
                                </div>
                
                                <p class="w-full text-center text-gray-500 select-none"></p>
                
                                
                            </div>
                
                            <div id="food-add-248" class="absolute top-0 md:top-auto flex flex-col gap-8 md:gap-0 justify-center items-center h-min md:h-full md:rounded-r-lg right-0 md:max-w-[44px] p-4 md:p-0">
                                    
                                    <div class="grow flex justify-center items-center add_food_icon bg-green-500 rounded-full md:rounded-none py-[6px] md:py-0 md:rounded-tr-lg text-md" value="248">
                                    <i id="food-add-icon-248" class="flex fas fa-plus fa-2x dark:text-white self-center py-auto px-2 rounded-tr-lg"></i>
                                    </div>
                
                                    <div class="grow bg-red-800 rounded-full md:rounded-none py-[6px] md:py-0 md:rounded-br-lg flex justify-center items-center delete_food_icon text-md" value="248">
                                    <i id="food-del-icon-248" class="flex fas fa-trash fa-2x dark:text-white self-center py-auto px-2"></i>
                                    </div>
                                    
                            </div>

                            
                        </div>

                        <div class="md:grid md:grid-cols-[auto_minmax(150px,_1fr)_2fr] mb-6 bg-slate-300 dark:bg-[#111827] rounded-lg relative p-6 opacity-40 select-none" id="" x-data="{ serving_size: 100, quantity: 1 }">

                            <div class="bg-transparent self-center flex justify-center items-center h-[128px] w-[128px] max-w-[128px] max-h-[128px] [&amp;>img]:flex [&amp;>img]:justify-evenly [&amp;>img]:items-center rounded-full border-4 border-slate-500">
                
                                <i class="hidden text-2xl sm:text-3xl md:text-4xl"></i>
                                
                                <img class="/p-6 object-cover  rounded-full  text-center leading-[128px] dark:text-white text-2xl font-extrabold m-auto /min-h-full h-[128px] w-[128px] max-w-[128px] max-h-[128px]" src="http://localhost:8000/storage/images/food/Kutas6UEoBMSUNyHdkLef94umTrlev24v3cgDK0p.jpg" alt="HACF  ">
                            </div>
                
                            <div class="desc-box m-6 self-center">
                
                                <div class="h-full">
                                    <div class="h-1/2">
                                        <p class="dark:text-white font-extrabold text-xl">Hummus and Carrot Fries</p>
                                        <p class="text-gray-500 text-lg">Homemade</p>
                
                                        <div class="flex items-center">
                                            
                                            <i class="fa-solid fa-user text-center text-md dark:text-white"></i>
                                            <p class="mx-3 text-gray-500">FitnessAnon123</p>
                                        </div>
                                    </div>
                
                                    
                                </div>
                
                            </div>
                
                                
                            <div class="dark:text-white h-full text-center mr-2 self-center" aria-label="food-macros">
                                <div class="flex justify-center gap-6 [&amp;>button]:w-[16px] [&amp;>button]:h-[16px]">
                
                                    
                
                
                                    
                
                                    <p class="w-fit">Per <span x-text="serving_size">100</span>g </p>
                
                                    
                                </div>
                                
                
                                
                                
                                <div class="h-fit flex px-6 pt-4 pb-2 gap-3 [&amp;>*]:text-clip [&amp;>*]:flex-1 [&amp;>*]:text-lg [&amp;>*]:text-center [&amp;>*]:flex [&amp;>*]:flex-col [&amp;>*>p]:text-clip">
                                
                
                                    <section>
                                        <p>318kcal</p>
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-blue-900">
                                            <div id="food_progressbar_calories_3" class="bg-blue-600 h-2.5 rounded-full " style="width: 25.44%"></div>
                                        </div>
                                        <p class="mt-1 text-blue-600">Calories</p>
                                    
                                    </section>
                
                                    <section>
                                        <p>21.3g</p>
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-orange-900">
                                            <div id="food_progressbar_fat_3" class="bg-orange-600 h-2.5 rounded-full " style="width: 23.666666666667%"></div>
                                        </div>
                                        <p class="mt-1 text-orange-600">Fat</p>
                                    
                                    </section>
                
                
                                    <section>
                                        <p>27.5g
                                        </p>
                
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-yellow-900">
                                            <div id="food_progressbar_carbs_3" class="bg-yellow-500 h-2.5 rounded-full " style="width: 22.916666666667%"></div>
                                        </div>
                
                                        <p class="mt-1 text-yellow-500">Carbs</p>
                                    </section>
                
                
                                    <section>
                                        <p>10g
                                        </p>
                
                                        <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-green-900">
                                            <div id="food_progressbar_protein_3" class="bg-green-600 h-2.5 rounded-full " style="width: 10.416666666667%"></div>
                                        </div>
                
                                        <p class="mt-1 text-green-600">Protein</p>
                                    </section>
                
                                    
                                   
                
                                </div>
                
                                <p class="w-full text-center text-gray-500 select-none"></p>
                
                                
                            </div>
                
                            <div id="food-add-97" class="absolute top-0 md:top-auto flex flex-col gap-8 md:gap-0 justify-center items-center h-min md:h-full md:rounded-r-lg right-0 md:max-w-[44px] p-4 md:p-0">
                                    
                                    <div class="grow flex justify-center items-center add_food_icon bg-green-500 rounded-full md:rounded-none py-[6px] md:py-0 md:rounded-tr-lg text-md" value="97">
                                    <i id="food-add-icon-97" class="flex fas fa-plus fa-2x dark:text-white self-center  py-auto px-2 rounded-tr-lg"></i>
                                    </div>
                
                                    <div class="grow bg-red-800 rounded-full md:rounded-none py-[6px] md:py-0 md:rounded-br-lg flex justify-center items-center delete_food_icon text-md" value="97">
                                    <i id="food-del-icon-97" class="flex fas fa-trash fa-2x dark:text-white self-center py-auto px-2"></i>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>

                    
                    

                    <input type="hidden" id="no_of_foods" value="0" autocomplete="off">
                    <input type="hidden" id="foods_pages" name="foods_pages" value="" autocomplete="off">
                    <div id="form-meal-foods"></div>
            

                    
                </form>
            </div>

            <div id="FOOD-ITEMS-CONTAINER" class="hidden sm:block max-w-sm mx-auto max-h-screen /sm:px-6 /lg:px-8 [&>div]:mb-3">
                
                <p class="text-center text-gray-300 opacity-40 italic m-4">What adding items looks like!</p>

                <div id="meal_item_1" class="opacity-40 meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg    pt-6 dark:text-white shadow-md shadow-black overflow-hidden" index="1">
                    <ul class="relative  relative ">
                        <button type="button" id="item_revealbtn_1" index="1" class="item_revealbtn_1 food_revealbtn absolute right-0 bg-lime-800 dark:text-white p-3 mr-6 rounded-lg ">
                            <i id="item_icon_1" class="item_icon_1 fas fa-chevron-up"> </i>
                        </button>
                
                        <div class="px-6">
                            <div class="select-none max-h-[108px]" id="food_wrapper_1">
                                
                
                                
                
                                                    <p aria-label="index_number" class="absolute  left-[50%]  text-8xl font-black opacity-10 select-none">1</p>
                                
                                            
                
                                <li class="text-balance max-w-[144px]" id="food_text_name_1">Sweet Potato Fries</li>
                
                                
                                <p class="text-gray-500"><span id="food_servingsize_1">100 g</span> x 1</p>
                                <span id="food_text_source_1" class="text-right text-gray-500">Lidl</span>
                                
                
                            </div>
                            
                            <div id="nutritional_wrapper_1" class="nutritional_wrapper_1 relative slide-down">
                                <div class="relative mt-3">
                                    <li id="food_text_calories_1" class="italic">240kcal</li>
                
                                    <p class="absolute right-0 top-0 text-gray-500">Calories</p>
                
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_calories_1" class="bg-blue-600 h-2.5 rounded-full" style="width: 16%"></div>
                                    </div>
                                </div>
                
                                <div class="relative mt-3">
                                    <li id="food_text_fat_1" class="italic">13.6g</li>
                                    <p class="absolute right-0 top-0 text-gray-500">Fat</p>
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_fat_1" class="bg-orange-600 h-2.5 rounded-full" style="width: 14.020618556701%"></div>
                                    </div>
                                </div>
                
                                <div class="relative mt-3">
                                    <li id="food_text_carbs_1" class="italic">21.6g</li>
                                    <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_carbs_1" class="bg-yellow-600 h-2.5 rounded-full" style="width: 22.268041237113%"></div>
                                    </div>
                                </div>
                
                                <div class="relative mt-3">
                                    <li id="food_text_protein_1" class="italic">16.9g</li>
                                    <p class="absolute right-0 top-0 text-gray-500">Protein</p>
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_protein_1" class="bg-green-600 h-2.5 rounded-full" style="width: 21.125%"></div>
                                    </div>
                                </div>
                
                                
                            </div>
                        </div>
                
                        <div id="nutritional-media-buttons-1" class="nutritional-media-buttons-1 nutritional-media-buttons w-full flex text-center mt-3 [&amp;>*]:my-auto absolute left-0 bottom-0 duration-200 [&amp;>*]:cursor-pointer [&amp;>*>*]:cursor-pointer">
                
                            <div id="mealitem-edit-btn-1" class="w-full bg-yellow-500 hover:bg-yellow-600 duration-150 text-black">EDIT</div>
                            <div id="mealitem-delete-btn-1" class="w-full bg-red-500 hover:bg-red-600 duration-150 dark:text-white" data-id="248" data-index="1">DELETE</div>
                
                            <div id="mealitem-delete-btn-confirmcontainer-1" class="w-full flex p-0 hidden" data-id="248">
                                <div id="mealitem-delete-btn-no-1" class="w-full bg-red-500">X</div>
                                <div id="mealitem-delete-btn-yes-1" class="w-full bg-green-500">🗑️</div>
                            </div>
                
                        </div>
                    </ul>
                </div>

                <div id="meal_item_2" class="opacity-40 meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg    pt-6 dark:text-white shadow-md shadow-black overflow-hidden" index="2">
                    <ul class="relative  ">
                        <button type="button" id="item_revealbtn_2" index="2" class="item_revealbtn_2 food_revealbtn absolute right-0 bg-lime-800 dark:text-white p-3 mr-6 rounded-lg ">
                            <i id="item_icon_2" class="fas fa-chevron-down item_icon_2"> </i>
                        </button>
                
                        <div class="px-6">
                            <div class="select-none max-h-[108px]" id="food_wrapper_2">
                                
                
                                
                
                                                                    
                                
                                <p aria-label="index_number" class="absolute  left-[50%]  text-8xl font-black opacity-10 select-none">2</p>
                                
                                                            
                
                                <li class="text-balance max-w-[144px]" id="food_text_name_2">Hummus and Carrot Fries</li>
                
                                
                                <p class="text-gray-500"><span id="food_servingsize_2">100 g</span> x 1</p>
                                <span id="food_text_source_2" class="text-right text-gray-500">Homemade</span>
                                
                
                            </div>
                            
                            <div id="nutritional_wrapper_2" class="nutritional_wrapper_2 relative ">
                                <div class="relative mt-3">
                                    <li id="food_text_calories_2" class="italic">127kcal</li>
                
                                    <p class="absolute right-0 top-0 text-gray-500">Calories</p>
                
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_calories_2" class="bg-blue-600 h-2.5 rounded-full" style="width: 8.4666666666667%"></div>
                                    </div>
                                </div>
                
                                <div class="relative mt-3">
                                    <li id="food_text_fat_2" class="italic">8.5g</li>
                                    <p class="absolute right-0 top-0 text-gray-500">Fat</p>
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_fat_2" class="bg-orange-600 h-2.5 rounded-full" style="width: 8.7628865979381%"></div>
                                    </div>
                                </div>
                
                                <div class="relative mt-3">
                                    <li id="food_text_carbs_2" class="italic">11g</li>
                                    <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_carbs_2" class="bg-yellow-600 h-2.5 rounded-full" style="width: 11.340206185567%"></div>
                                    </div>
                                </div>
                
                                <div class="relative mt-3">
                                    <li id="food_text_protein_2" class="italic">4g</li>
                                    <p class="absolute right-0 top-0 text-gray-500">Protein</p>
                
                                    <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                        <div id="food_progressbar_protein_2" class="bg-green-600 h-2.5 rounded-full" style="width: 5%"></div>
                                    </div>
                                </div>
                
                                
                            </div>
                        </div>
                
                        <div id="nutritional-media-buttons-2" class="nutritional-media-buttons-2 nutritional-media-buttons w-full flex text-center mt-3 [&amp;>*]:my-auto absolute left-0 bottom-0 hidden duration-200 [&amp;>*]:cursor-pointer [&amp;>*>*]:cursor-pointer">
                
                            <div id="mealitem-edit-btn-2" class="w-full bg-yellow-500 hover:bg-yellow-600 duration-150 text-black">EDIT</div>
                            <div id="mealitem-delete-btn-2" class="w-full bg-red-500 hover:bg-red-600 duration-150 dark:text-white" data-id="97" data-index="2">DELETE</div>
                
                            <div id="mealitem-delete-btn-confirmcontainer-2" class="w-full flex p-0 hidden" data-id="97">
                                <div id="mealitem-delete-btn-no-2" class="w-full bg-red-500">X</div>
                                <div id="mealitem-delete-btn-yes-2" class="w-full bg-green-500">🗑️</div>
                            </div>
                
                        </div>
                    </ul>
                </div>
                {{-- <x-food-item 
                 index="1"
                 name="Ricotta Cheese" 
                 calories="380" 
                 fat="21.7"
                 carbs="17.4" 
                 protein="23.4" />

                <x-food-item 
                index="2" 
                name="Pizza Slice" 
                calories="274" 
                fat="23.3" 
                carbs="27.1" 
                protein="8.4" /> --}}

            </div>
        </div>

        {{-- Hidden form to keep no_of_foods, doesn't do anything outside of this.
        
        Foods_pages preserves the order of which food items are added.

        last updated 05/08/23

        --}}
        
    </div>

    <script>

        // console.log('meal json and food_array reset');
        var meal_json = {};
        var food_array = [];
        var foods_pages = [];

        let food_index = 0;
        let food_id = 0;

        $(document).ready(function () {
            
            $(document).trigger('on_update', [food_index, food_id]);

            // Use event delegation for dynamically loaded elements
            $("#FOOD-ITEMS-CONTAINER").on("click", `[id^=mealitem-delete-btn-]`, function () {
                let food_index = $(this).data("index"); 
                $(`#mealitem-delete-btn-${food_index}`).addClass("hidden");
                $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).removeClass("hidden");
            });

            $("#FOOD-ITEMS-CONTAINER").on("click", `[id^=mealitem-delete-btn-yes-]`, function () {
                let food_id = $(this).data("id"); 
                $(`.meal_${food_id}`).remove();
                
                // foreach(meals_array as meal) {

                //     if (meal['food_id'] == food_id) {

                //         meals_array.splice(meals_array.indexOf(meal));

                //     }
                // }

                // console.log('MEALS ARRAY COMPLETION?', meals_array);

            });

            $("#FOOD-ITEMS-CONTAINER").on("click", `[id^=mealitem-delete-btn-no-]`, function () {
                let food_index = $(this).data("index");
                $(`#mealitem-delete-btn-${food_index}`).removeClass("hidden");
                $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).addClass("hidden");
            });
        });


        $(document).ready(function() {
            
            // var no_of_foods = parseInt($("#no_of_foods").val());

            // $(document).ready(function() {
            // $('.add_food_icon').click(function(e) {
            //     var no_of_foods = parseInt($("#no_of_foods").val()) + 1;

            //     $("#no_of_foods").val(no_of_foods)

            //     console.log(no_of_foods);
            //     });
            // });

            var no_of_foods = parseInt($("#no_of_foods").val())
            
            

            var targetElement = $('#FOOD-ITEMS-CONTAINER')[0];

            // Create a new MutationObserver instance
            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                if (mutation.type === 'childList' && mutation.target === targetElement) {
                    // Additional code to handle the change
                    
                    // unbind any previous binding events to prevent overbinding
                    $(`.food_revealbtn`).unbind();

                    $(`.food_revealbtn`).click(function() {
                    // get index of button
                        var index_selector = $(this).attr('index');
                        
                        // open/close nutritional info
                        $(`.nutritional_wrapper_${index_selector}`).toggleClass('slide-down');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('hidden');
                        

                        // adjust height to accomodate for nutritional info
                        // $(`#food_item_${index_selector}`).toggleClass('h-24');
                        $(`.nutritional-media-buttons-${index_selector}`).toggleClass('hidden');

                        // change direction of icon arrow
                        $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
                        $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
                    });
                }
                });
            });

            var config = { childList: true, subtree: true };
            observer.observe(targetElement, config);

            var deleteObserver = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                if (mutation.type === 'childList' && mutation.target === targetElement) {
                    // Additional code to handle the change
                    
                    // unbind any previous binding events to prevent overbinding
                    $(`nutritional-delete-btn`).unbind();

                    $(`nutritional-delete-btn`).click(function() {
                    // get index of button
                        var index_selector = $(this).attr('index');
                        
                        // open/close nutritional info
                        $(`.nutritional_wrapper_${index_selector}`).toggleClass('slide-down');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('hidden');
                        

                        // adjust height to accomodate for nutritional info
                        // $(`#food_item_${index_selector}`).toggleClass('h-24');
                        $(`.nutritional-media-buttons-${index_selector}`).toggleClass('hidden');

                        // change direction of icon arrow
                        $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
                        $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
                    });
                }
                });
            });

            var config = { childList: true, subtree: true };
            observer.observe(targetElement, config);


            $( "#FOOD-ITEMS-CONTAINER" ).on( "change", function() {
                
                // console.log('food_items_container_change: Tanzania')
                
                // Reorder remaining items
                reorderItems();

                // Trigger onchange event for FOOD-ITEMS-CONTAINER

             } );


             function reorderItems() {
                // Get all meal items
                $("#FOOD-ITEMS-CONTAINER .meal_item").each(function (index) {
                    let newIndex = index + 1; // Start at 1


                    if ($("#FOOD-ITEMS-CONTAINER .meal_item").length === 1) {
                        newIndex = 1;
                        index = 1;

                        console.log('COUNT IS ONE, I REPEAT, COUNT IS ONE')
                    } else {
                      // do nothing
                    }

                    // Update attributes and inner content
                    $(this).attr("id", `meal_item_${newIndex}`).attr("index", newIndex);
                    $(this).find("[aria-label='index_number']").text(newIndex);
                    $(this).find("button").attr("id", `item_revealbtn_${newIndex}`).attr("index", newIndex);
                    $(this).find("i").attr("id", `item_icon_${newIndex}`);
                    $(this).find(`#food_wrapper_${index}`).attr("id", `food_wrapper_${newIndex}`);
                    $(this).find(`#food_text_name_${index}`).attr("id", `food_text_name_${newIndex}`);
                    $(this).find(`#food_servingsize_${index}`).attr("id", `food_servingsize_${newIndex}`);
                    $(this).find(`#food_text_source_${index}`).attr("id", `food_text_source_${newIndex}`);
                    $(this).find(`#nutritional_wrapper_${index}`).attr("id", `nutritional_wrapper_${newIndex}`);
                    $(this).find(`#food_text_calories_${index}`).attr("id", `food_text_calories_${newIndex}`);
                    $(this).find(`#food_progressbar_calories_${index}`).attr("id", `food_progressbar_calories_${newIndex}`);
                    $(this).find(`#food_text_fat_${index}`).attr("id", `food_text_fat_${newIndex}`);
                    $(this).find(`#food_progressbar_fat_${index}`).attr("id", `food_progressbar_fat_${newIndex}`);
                    $(this).find(`#food_text_carbs_${index}`).attr("id", `food_text_carbs_${newIndex}`);
                    $(this).find(`#food_progressbar_carbs_${index}`).attr("id", `food_progressbar_carbs_${newIndex}`);
                    $(this).find(`#food_text_protein_${index}`).attr("id", `food_text_protein_${newIndex}`);
                    $(this).find(`#food_progressbar_protein_${index}`).attr("id", `food_progressbar_protein_${newIndex}`);
                    $(this).find(`#mealitem-edit-btn-${index}`).attr("id", `mealitem-edit-btn-${newIndex}`);
                });
            }
                });        

            $(document).ready(function () {
                $("#SHOW-ITEMS-BTN-MOBILE").on( "click", function() {
                    $('#FOOD_FORM_INPUTS').toggleClass('hidden');
                    $('#food-media-controls').toggleClass('hidden');
                    $('#FOOD-ITEMS-CONTAINER-MOBILE').toggleClass('hidden');
                    $('#FOOD-ITEMS-CONTAINER-MOBILE').toggleClass('block');
                    $('#FOOD-SEARCH-CONTAINER').toggleClass('hidden');

                    $('#SHOW-ITEMS-ICON').toggleClass('fa-cart-shopping');
                    $('#SHOW-ITEMS-ICON').toggleClass('fa-magnifying-glass');
                } );
            });

            $(document).ready(function () {

            $( "#FOOD-ITEMS-CONTAINER" ).on( "change", function() {

                // console.log('This should work POTATOLAND')
                $("#ITEMS-COUNT-MOBILE").text(`${meal_json.length}`)

            })

            });

            

            // $(document).ready(function() {

            //     function confirmToDelete(id) {

            //     $(`#mealitem-delete-btn-${id}`).addClass('hidden');
            //     $(`#mealitem-delete-btn-confirmcontainer-${id}`).removeClass('hidden');

            //     }

            //     function confirmToDelete_no(id) {

            //     $(`#mealitem-delete-btn-${id}`).removeClass('hidden');
            //     $(`#mealitem-delete-btn-confirmcontainer-${id}`).addClass('hidden');

            //     }

            //     function confirmToDelete_yes(id) {

            //     $(`.meal_${id}`).remove();

            //     reorderItems();

            //     }

            // });

            // document.addEventListener('DOMContentLoaded', () => {
            //     document.addEventListener('click', (e) => {
            //         if (e.target && e.target.id.startsWith('mealitem-delete-btn-')) {
            //             const food_id = e.target.dataset.id;       // Access data-id
            //             const food_index = e.target.dataset.index; // Access data-index

            //             console.log(`Food ID: ${food_id}, Food Index: ${food_index}`);

            //             // Toggle the clicked button's hidden class
            //             $(e.target).toggleClass('hidden');

            //             // Toggle the confirm container's hidden class
            //             const confirmContainer = document.getElementById(`mealitem-delete-btn-confirmcontainer-${food_index}`);

            //             console.log(confirmContainer); // Check if it exists

            //             if (confirmContainer) {
            //                 $(confirmContainer).toggleClass('hidden');
            //             } else {
            //                 console.error(`Element #mealitem-delete-btn-confirmcontainer-${food_index} not found.`);
            //             }
            //         }
            //     });
            // });



            // Delete button click listener
            // $(document).on("click", `#mealitem-delete-btn-${food_index}`, function () {
            //     $(`#mealitem-delete-btn-${food_index}`).addClass('hidden');
            //     $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).removeClass('hidden');
            // });

            // Confirm delete button click listener
            // $(document).on("click", `#mealitem-delete-btn-yes-${food_index}`, function () {
            //     $(`.meal_${food_id}`).remove();
            //     reorderItems();
            // });

            // Cancel delete button click listener
            // $(document).on("click", `#mealitem-delete-btn-no-${food_index}`, function () {
            //     $(`#mealitem-delete-btn-${food_index}`).removeClass('hidden');
            //     $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).addClass('hidden');
            // });

            console.log(`FOOD ID: ${food_id} UPDATED`);
    


    </script>

    <script>
       
    </script>
</x-app-layout>
