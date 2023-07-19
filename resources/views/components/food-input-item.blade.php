<div id="food_number_{{$index}}" class="inline-block {{$active}}">
    <div class="p-6">
    <h1 class="text-white text-2xl">1. Food Name and Source</h1>
    <p class="text-gray-500 italic mt-2">The basic information.</p>
    </div>

    <div class="mb-3 grid grid-cols-2 gap-1">
        <label class="block p-6">
            <span class="text-white">Food Name</span>
            <input type="text" id="food_name_{{$index}}" name="food_name_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Ricotta Cheese" />
        </label>

        <label class="block p-6">
            <span class="text-white">Food Source</span>
            <input type="text" id="food_source_{{$index}}" name="food_source_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Aldi" />
        </label>
    </div> 

    <div class="p-6">
    <h1 class="text-white text-2xl">2. Nutritional Info</h1>
    <p class="text-gray-500 italic mt-2">Per 100g. All fields optional.</p>
    </div>

    <div class="mb-3 grid grid-cols-4 gap-1">
        
        <label class="block p-6">
            <span class="text-white">Calories (kcal)</span>
            <input type="text" id="food_calories_{{$index}}" name="food_calories_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182" />
        </label>

        <label class="block p-6">
            <span class="text-white">Fat (g)</span>
            <input type="text" id="food_fat_{{$index}}" name="food_fat_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="14.1" />
        </label>

        
        <label class="block p-6">
            <span class="text-white">Carbs (g)</span>
            <input type="text" id="food_carbs_{{$index}}" name="food_carbs_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7" />
        </label>

        
        <label class="block p-6">
            <span class="text-white">Protein (g)</span>
            <input type="text" id="food_protein_{{$index}}" name="food_protein_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="11.7" />
        </label>
    </div>

    <div class="p-6">
        <h1 class="text-white text-2xl">3. Extra Info</h1>
    </div>

    <div class="mb-3">
        <label class="block p-6">
            <span class="text-white">Description</span>
            <input type="text" name="food_description_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Tastes good on pizza" />
        </label>
    </div>
</div>