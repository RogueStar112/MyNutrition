<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Meal - Part II') }}
        </h2>

        
    </x-slot>

    @if(session('success'))
    <div class="alert alert-success max-w-7xl rounded-lg mx-auto text-center bg-green-800 text-white p-6" id="success-message-received">
        {{ session('success') }}
    </div>

        <script>
            setTimeout(() => {
                document.getElementById('success-message-received').style.display = 'none';
            }, 6000); // Disappears after 6 seconds
        </script>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger max-w-7xl rounded-lg mx-auto text-center bg-red-800 text-white" id="error-message-received">
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

    <div class="flex justify-center">
        <p class="text-center text-white">Last three inputs before you can submit your meal...</p>
        
    </div>


    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-7xl /w-[768px] mx-auto sm:px-6 lg:px-8">
                

                <div class="bg-gray-800 p-6 rounded-lg">
                <form id="form-ptii-submission" method="POST" action="{{ route('meal.store')}}">
                        @csrf

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

                    <div class="grid grid-cols-1 @if(count($food_array_components) > 2) md:grid-cols-3 @else md:grid-cols-{{count($food_array_components)}} @endif gap-3 place-items-center">

                        
                    @foreach($food_array_components as $food)
                        
                        {{$food}}

                    @endforeach
                    </div>

                    @endisset


                    <div class="flex justify-center">
                        <input type="hidden" id="foods_pages" name="foods_pages" value="1"/>
                        
                        <button type="submit" class="w-full bg-lime-600 text-white p-4 m-4 rounded-lg cursor-pointer"><i class="fas fa-check"></i>  Click here to submit.</button>
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

                        <p class="text-white text-center mt-3 text-sm">Disclaimer: Nutritional content may not be 100% accurate.</p>

                        @endisset
                        
                    </div>

                
                
                </form>
            </div>

           
            
    </div>

    <script>



            $(document).ready(function() {


                var url = new URL(window.location.href);
                var food_pages_value = url.searchParams.get('foods_pages');

                $('#foods_pages').val(food_pages_value);
                
                var food_pages_array = food_pages_value.split(',');

                console.log('FPA', food_pages_array)

                for(let i=0; i<food_pages_array.length; i++) {
                    
                    var foodName = url.searchParams.get(`meal_foodname_${food_pages_array[i]}`);
                    var foodId = url.searchParams.get(`meal_foodid_${food_pages_array[i]}`);
                    var foodCalories = url.searchParams.get(`meal_calories_${food_pages_array[i]}`);
                    var foodFat = url.searchParams.get(`meal_fat_${food_pages_array[i]}`);
                    var foodCarbs = url.searchParams.get(`meal_carbs_${food_pages_array[i]}`);
                    var foodProtein = url.searchParams.get(`meal_protein_${food_pages_array[i]}`);
                    var foodServingSize = url.searchParams.get(`meal_servingsize_${food_pages_array[i]}`);
                    var foodQuantity = url.searchParams.get(`meal_quantity_${food_pages_array[i]}`);
                    var foodUnitId = url.searchParams.get(`meal_foodunitid_${food_pages_array[i]}`);

                    
                    
                    
                    
                    
                    

                    
                    $("#form-ptii-submission").append(`<input id='meal_foodname_${food_pages_array[i]}' type='hidden' name='meal_foodname_${food_pages_array[i]}' value='${foodName}' index='${i+1}' readonly />
            <input id='meal_foodid_${food_pages_array[i]}' type='hidden' name='meal_foodid_${food_pages_array[i]}' value='${foodId}' index='${i+1}' readonly />
            <input id='meal_calories_${food_pages_array[i]}' type='hidden' name='meal_calories_${food_pages_array[i]}' value='${foodCalories}' index='${i+1}' readonly />
              <input id='meal_fat_${food_pages_array[i]}' type='hidden' name='meal_fat_${food_pages_array[i]}' value='${foodFat}' index='${i+1}' readonly />
             <input id='meal_carbs_${food_pages_array[i]}' type='hidden' name='meal_carbs_${food_pages_array[i]}' value='${foodCarbs}' index='${i+1}' readonly />
              <input id='meal_protein_${food_pages_array[i]}' type='hidden' name='meal_protein_${food_pages_array[i]}' value='${foodProtein}' index='${i+1}' readonly />
              <input id='meal_servingsize_${food_pages_array[i]}' type='hidden' name='meal_servingsize_${food_pages_array[i]}' value='${foodServingSize}' index='${i+1}' readonly />
             <input id='meal_quantity_${food_pages_array[i]}' type='hidden' name='meal_quantity_${food_pages_array[i]}' value='${foodQuantity}' index='${i+1}' readonly />
             <input id='meal_foodunitid_${food_pages_array[i]}' type='hidden' name='meal_foodunitid_${food_pages_array[i]}' value='${foodUnitId}' index='${i+1}' readonly />
             `);

                }

            });
      
    </script>
</x-app-layout>
