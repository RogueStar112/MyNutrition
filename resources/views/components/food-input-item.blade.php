<div id="food_number_{{$index}}" class="inline-block {{$active}}">
    <div class="p-6">
    <h2 class="text-white text-2xl">1. Food Name and Source</h2>
    <p class="text-gray-500 italic mt-2">The basic information. Fields required.</p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-2 gap-1">
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Food Name</span>
            <input type="text" id="food_name_{{$index}}" name="food_name_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Ricotta Cheese" value="{{$name}}" required/>
        </label>

        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Food Source</span>
            <input type="text" id="food_source_{{$index}}" name="food_source_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Aldi" value="{{$source}}" required/>
        </label>

        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Serving Size</span>
            <input type="text" id="food_servingsize_{{$index}}" name="food_servingsize_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="100" value="{{$servingSize}}" required/>
        </label>

        <label class="block px-6 py-4 md:p-6" for="food_servingunit_{{$index}}">
            <span class="text-white">Serving Unit</span>
            <select type="text" id="food_servingunit_{{$index}}" name="food_servingunit_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="100" value="{{$servingUnit}}" autocomplete="off" required>
              @foreach($servingUnitOptions as $option)
                @if($option->id == $servingUnit)
                    <option value="{{$option->id}}" shortname="{{$option->short_name}}" selected>{{$option->name}} ({{$option->short_name}})</option>
                @else
                    <option value="{{$option->id}}" shortname="{{$option->short_name}}">{{$option->name}} ({{$option->short_name}})</option>
                @endif
              @endforeach
            </select>
        </label>

        <label class="hidden md:block md:visible px-6 py-4 md:p-6 col-span-2" for="food_image_{{$index}}">

            <span class="text-white">Upload Image (optional)</span>

            <input type="file" name="food_image_{{$index}}" id="food_image_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md p-3"/>

        </label>
        
    </div> 

    <div class="p-6">
    <h2 class="text-white text-2xl">2. Nutritional Info</h2>
    <p class="text-gray-500 italic mt-2">According to serving size. All fields optional.</p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-4 gap-1">
        
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Calories (kcal)</span>
            <input type="text" id="food_calories_{{$index}}" name="food_calories_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182"  value="{{$calories}}" />
        </label>

        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Fat (g)</span>
            <input type="text" id="food_fat_{{$index}}" name="food_fat_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="14.1"  value="{{$fat}}" />


        </label>

        
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Carbs (g)</span>
            <input type="text" id="food_carbs_{{$index}}" name="food_carbs_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7"  value="{{$carbs}}" />
        </label>

        
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Protein (g)</span>
            <input type="text" id="food_protein_{{$index}}" name="food_protein_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="11.7"  value="{{$protein}}" />
        </label>

         
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Sugars (g)</span>
            <input type="text" id="food_sugars_{{$index}}" name="food_sugars_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7"  value="{{$sugars}}" />
        </label>

        
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Saturates (g)</span>
            <input type="text" id="food_saturates_{{$index}}" name="food_saturates_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="8.1"  value="{{$saturates}}" />
        </label>

        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Fibre (g)</span>
            <input type="text" id="food_fibre_{{$index}}" name="food_fibre_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="0.4"  value="{{$fibre}}" />
        </label>

        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Salt (g)</span>
            <input type="text" id="food_salt_{{$index}}" name="food_salt_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="1.1"  value="{{$salt}}" />


        </label>
    </div>

    <div class="p-6">
        <h1 class="text-white text-2xl">3. Extra Info</h1>
    </div>

    <div class="mb-3">
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Description</span>
            <input type="text" name="food_description_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Tastes good on pizza" />
        </label>
    </div>
</div>