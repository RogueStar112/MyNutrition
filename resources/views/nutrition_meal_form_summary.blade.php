<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Meal - Part II') }}
        </h2>

        
    </x-slot>

    <div class="flex justify-center">
        <p class="text-center text-white">Last three inputs before you can submit your meal...</p>
        
    </div>


    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-7xl /w-[768px] mx-auto sm:px-6 lg:px-8">
                

                <div class="bg-gray-800 p-6 rounded-lg">
                <form id="form-ptii-submission">
                    
                    <div class="grid grid-cols-2 gap-3 justify-center">

                        <div class="w-full">
                        <label for="MEAL_NAME" class="text-white"><p class="font-bold text-xl text-center">Give the meal a name.</p>

                        <input type="text" name="MEAL_NAME" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Big Breakfast, Spaghetti Carbonara, BLT Sandwich" value="" required/>
                        </label>
                        </div>

                        <div class="w-full">
                        <label for="MEAL_TIME" class="text-white"><p class="font-bold text-xl text-center">When are you going to have this meal?</p>

                            <input type="datetime-local" name="MEAL_TIME" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Big Breakfast, Spaghetti Carbonara, BLT Sandwich" value="" required/>
                        </label>
                        </div>
                    </div>

                
                </div>

                <div class="flex justify-center">
                    <p class="text-center text-white mt-4">You are adding the following foods to this meal...</p>
                </div>
            

                @isset($food_array_components)
                    
                {{-- <p>food array components set!</p> --}}

                <div class="grid grid-cols-3 gap-3 place-items-center">

                    
                @foreach($food_array_components as $food)
                    
                    {{$food}}

                @endforeach
                </div>

                @endisset


                <div class="flex justify-center">
                    <input type="hidden" id="pages" name="food_pages" value="1"/>
                    
                    <button type="submit" class="w-full bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  Click here to submit.</button>
                </div>
            
                <div class="mt-4 border-4 border-transparent border-t-white text-white text-2xl text-center">
                    <p class="mt-4 p-2 bg-gray-800 font-black">NUTRITIONAL TOTAL</p>

                    @isset($total_nutrients)
                        
                    <div class="grid grid-cols-4">
                        
                        <div class="bg-blue-800 p-3">
                        {{$total_nutrients['calories']}}kcal<br>
                        </div>

                        <div class="bg-red-800 p-3">
                        {{$total_nutrients['fat']}}g Fat<br>
                        </div>

                        <div class="bg-orange-700 p-3">
                        {{$total_nutrients['carbohydrates']}}g Carbs<br>
                        </div>


                        <div class="bg-green-800 p-3">
                        {{$total_nutrients['protein']}}g Protein<br>
                        </div>

                    </div>

                    @endisset
                    
                </div>

                
                
                </form>
            </div>

           
            
    </div>

    <script>

      
    </script>
</x-app-layout>
