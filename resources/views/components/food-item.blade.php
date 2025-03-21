<div id="food_item_{{ $index }}" class="cursor-pointer min-h-[100px] active:bg-slate-950 border-none focus-within:outline-none focus-within:ring focus-within:ring-violet-300 bg-gray-800 w-64 rounded-lg p-6 text-white overflow-hidden" onclick="goToPage({{$index}})">
    <ul class="relative text-left">
        <button id="item_revealbtn_{{ $index }}" index="{{ $index }}" class="item_revealbtn_{{$index}} food_revealbtn absolute right-0 bg-lime-800 text-white p-3 rounded-lg">
            <i id="item_icon_{{ $index }}" class="fas fa-chevron-down"> </i>
        </button>

        <div class="" id="food_wrapper_{{ $index }}">
            {{-- <li class="font-bold text-left">#{{ $index }}</li> --}}
            <p aria-label="index_number" class="absolute left-[50%] text-8xl font-black opacity-10 select-none">{{ $index }}</p>
            <li id="food_text_name_{{$index}}">{{ $name }}</li>
            <p class="text-gray-500"><span id="food_text_servingsize_{{$index}}">{{ $servingSize }}</span><span id="food_text_servingunit_{{$index}}">{{ $servingUnit }}</span></p>
            <span id="food_text_source_{{$index}}"class="text-right text-gray-500">{{ $source }}</span>
            {{-- <p class="absolute right-0 bottom-0 text-gray-500">100g</p> --}}

        </div>
        
        <div class="nutritional_wrapper_{{$index}}" id="nutritional_wrapper_{{ $index }}" class="">
            <div class="relative mt-3">
                <li id="food_text_calories_{{$index}}" class="italic">{{ $calories }}kcal</li>

                <p class="absolute right-0 top-0 text-gray-500">Calories</p>


                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_calories_{{$index}}" class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ((float)$calories / 1500) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_fat_{{$index}}" class="italic">{{$fat}}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Fat</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_fat_{{$index}}" class="bg-orange-600 h-2.5 rounded-full" style="width: {{ ((float)$fat / 97) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_carbs_{{$index}}" class="italic">{{ $carbs }}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Carbs</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_carbs_{{$index}}" class="bg-yellow-600 h-2.5 rounded-full" style="width: {{ ((float)$carbs / 97) * 100 }}%"></div>
                </div>
            </div>

            <div class="relative mt-3">
                <li id="food_text_protein_{{$index}}" class="italic">{{ $protein }}g</li>
                <p class="absolute right-0 top-0 text-gray-500">Protein</p>

                <div class="w-full mt-1 bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="food_progressbar_protein_{{$index}}" class="bg-green-600 h-2.5 rounded-full" style="width: {{ ((float)$protein / 80) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </ul>
</div>

