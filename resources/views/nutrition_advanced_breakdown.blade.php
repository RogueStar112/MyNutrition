<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold italic uppercase dark:text-black dark:text-white text-3xl text-gray-800 leading-tight">
          Advanced Breakdown
      </h2>
  </x-slot>

  <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="flex justify-between">

              <div id="meal_item_1" class="opacity-40 meal_248 /bg-gray-50 meal_item relative min-h-[100px] mb-3 active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-200 dark:bg-gray-800 w-64 rounded-lg    pt-6 dark:text-white shadow-md shadow-black overflow-hidden" index="1">
                            <ul class="relative ">
                                {{-- <button type="button" id="item_revealbtn_1" index="1" class="item_revealbtn_1 food_revealbtn absolute right-0 bg-lime-800 dark:text-white p-3 mr-6 rounded-lg ">
                                    <i id="item_icon_1" class="item_icon_1 fas fa-chevron-up"> </i>
                                </button> --}}
                        
                                <div class="px-6">
                                    <div class="select-none max-h-[108px]" id="food_wrapper_1">
                                        
                        
                                        
                        
                                                            <p aria-label="index_number" class="absolute  left-[50%]  text-8xl font-black opacity-10 select-none">1</p>
                                        
                                                    
                        
                                        <li class="text-balance max-w-[144px]" id="food_text_name_1">Double Cheeseburger</li>
                        
                                        
                                        <p class="text-gray-500"><span id="food_servingsize_1">1pc </span> x 1</p>
                                        <span id="food_text_source_1" class="text-right text-gray-500">McDonalds</span>
                                        
                        
                                    </div>
                                    
                                    <div id="nutritional_wrapper_1" class="nutritional_wrapper_1 relative slide-down">
                                        <div class="relative mt-3">
                                            <li id="food_text_calories_1" class="italic">452kcal</li>
                        
                                            <p class="absolute right-0 top-0 text-gray-500">Calories</p>
                        
                        
                                            <div class="w-full mt-1 bg-gray-100 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_calories_1" class="bg-blue-600 h-2.5 rounded-full" style="width: 16%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_fat_1" class="italic">24g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Fat</p>
                        
                                            <div class="w-full mt-1 bg-gray-100 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_fat_1" class="bg-orange-600 h-2.5 rounded-full" style="width: 14.020618556701%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_carbs_1" class="italic">31g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Carbs</p>
                        
                                            <div class="w-full mt-1 bg-gray-100 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_carbs_1" class="bg-yellow-600 h-2.5 rounded-full" style="width: 22.268041237113%"></div>
                                            </div>
                                        </div>
                        
                                        <div class="relative mt-3">
                                            <li id="food_text_protein_1" class="italic">27g</li>
                                            <p class="absolute right-0 top-0 text-gray-500">Protein</p>
                        
                                            <div class="w-full mt-1 bg-gray-100 rounded-full h-2.5 dark:bg-gray-700">
                                                <div id="food_progressbar_protein_1" class="bg-green-600 h-2.5 rounded-full" style="width: 21.125%"></div>
                                            </div>
                                        </div>
                        
                                        
                                    </div>
                                </div>
                        
                         
                            </ul>
                        </div>

                  <div></div>



                  <div></div>

          </div>
      
        

      </div>
  </div>
</x-app-layout>
