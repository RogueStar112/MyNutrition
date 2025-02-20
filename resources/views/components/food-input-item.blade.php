<div id="food_number_{{$index}}" class="inline-block {{$active}}">
    <div class="p-6">
    <h2 class="text-white text-2xl">1. Food Name and Source</h2>
    <p class="text-gray-500 italic mt-2">The basic information. <span class="font-black text-red-400">Fields required.</span></p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-2 gap-1 [&>*]:gap-4 [&>*]:items-center [&>*]:justify-between md:[&>*]:justify-start md:[&>*>input]:w-full [&>*>input]:w-[191px] [&>*>select]:w-[191px] md:[&>*>select]:w-full">
        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Food Name</span>
            <input type="text" id="food_name_{{$index}}" name="food_name_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Ricotta Cheese" value="{{$name}}" required/>
        </label>

        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Food Source</span>
            <input type="text" id="food_source_{{$index}}" name="food_source_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Aldi" value="{{$source}}" required/>
        </label>

        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Serving Size</span>
            <input type="text" id="food_servingsize_{{$index}}" name="food_servingsize_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="100" value="{{$servingSize}}" required/>
        </label>

        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6" for="food_servingunit_{{$index}}">
            <span class="text-white">Serving Unit</span>
            <select type="text" id="food_servingunit_{{$index}}" name="food_servingunit_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="100" value="{{$servingUnit}}" autocomplete="off" required>
              @foreach($servingUnitOptions as $option)
                @if($option->id == $servingUnit)
                    <option value="{{$option->id}}" shortname="{{$option->short_name}}" selected>{{$option->name}} ({{$option->short_name}})</option>
                @else
                    <option value="{{$option->id}}" longname="{{$option->name}}s" shortname="{{$option->short_name}}">{{$option->name}}s ({{$option->short_name}})</option>
                @endif
              @endforeach
            </select>
        </label>

    
        <div class="hidden md:block">

        </div>

        <button type="button" index="{{$index}}" id="autofill_{{$index}}" class="autofill_btn font-extrabold text-2xl w-full  md:w-3/4 md:mx-auto p-6 border-4 border-yellow-500 md:border-0  md:rounded-full text-white bg-gradient-to-br from-slate-800 via-green-500 to-slate-800 /bg-[linear-gradient(to_right,theme(colors.green.500),theme(colors.green.400),theme(colors.green.400),theme(colors.green.400),theme(colors.green.400),theme(colors.green.400),theme(colors.green.500))] /bg-[length:200%_auto]  /animate-gradient">✨ AI Auto Fill ✨</button>

        {{-- <label class="hidden /md:block md:visible px-6 py-4 md:p-6 col-span-2" for="food_image_{{$index}}">

            <span class="text-white">Upload Image (optional)</span>

            <input type="file" name="food_image_{{$index}}" id="food_image_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md p-3"/>

        </label> --}}
        
    </div> 

    <div class="p-6">
    <h2 class="text-white text-2xl">2. Nutritional Info</h2>
    <p class="text-gray-500 italic mt-2">According to serving size. All fields optional.</p>
    <p class="text-green-500 italic mt-2">New AI Autofill fills in nutritional info for food names with quantities!</p>
    <p class="text-red-500 italic"><span class="font-black">Disclaimer:</span> Any information from the AI Auto Fill may be inaccurate. Use the data with caution.</p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-4 gap-1 [&>*]:gap-4 [&>*]:items-center [&>*]:justify-between [&>*>input]:w-[189px] md:[&>*>input]:w-full">
        
        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Calories (kcal)</span>
            <input type="text" id="food_calories_{{$index}}" name="food_calories_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182"  value="{{$calories}}" />
        </label>

        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Fat (g)</span>
            <input type="text" id="food_fat_{{$index}}" name="food_fat_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="14.1"  value="{{$fat}}" />


        </label>

        
        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Carbs (g)</span>
            <input type="text" id="food_carbs_{{$index}}" name="food_carbs_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7"  value="{{$carbs}}" />
        </label>

        
        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Protein (g)</span>
            <input type="text" id="food_protein_{{$index}}" name="food_protein_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="11.7"  value="{{$protein}}" />
        </label>

         
        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Sugars (g)</span>
            <input type="text" id="food_sugars_{{$index}}" name="food_sugars_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7"  value="{{$sugars}}" />
        </label>

        
        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Saturates (g)</span>
            <input type="text" id="food_saturates_{{$index}}" name="food_saturates_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="8.1"  value="{{$saturates}}" />
        </label>

        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Fibre (g)</span>
            <input type="text" id="food_fibre_{{$index}}" name="food_fibre_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="0.4"  value="{{$fibre}}" />
        </label>

        <label class="flex whitespace-nowrap sm:block px-6 py-4 md:p-6">
            <span class="text-white">Salt (g)</span>
            <input type="text" id="food_salt_{{$index}}" name="food_salt_{{$index}}" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" placeholder="1.1"  value="{{$salt}}" />


        </label>
    </div>

    <div class="p-6">
        <h1 class="text-white text-2xl">3. Extra Info</h1>
    </div>

    <div class="mb-3">
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Food Icon (optional)</span>
            {{-- <input type="text" name="food_icon_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="" /> --}}

            {{-- <label class="radio">
                <input type="radio" name="food_icon_{{$index}}" value="" />
                Yes
              </label>
              <label class="radio">
                <input type="radio" name="food_icon_{{$index}}" value="" />
                No
              </label> --}}
        </label>

        <div class="flex gap-4 ml-4 flex-wrap [&>*>label>*]:scale-[1.5] justify-evenly [&>*>input]:hidden">
            <div class="flex items-center">
                <input id="food-icon-{{$index}}_1" type="radio" value="fa-solid fa-lemon" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_1" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-lemon"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_2" type="radio" value="fa-solid fa-hamburger" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_2" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-hamburger"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_3" type="radio" value="fa-solid fa-egg" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_3" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-egg"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_4" type="radio" value="fa-solid fa-carrot" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_4" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-carrot"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_5" type="radio" value="fa-solid fa-pizza-slice" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_5" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-pizza-slice"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_6" type="radio" value="fa-solid fa-pepper-hot" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_6" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-pepper-hot"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_7" type="radio" value="fa-solid fa-stroopwafel" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_7" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-stroopwafel"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_8" type="radio" value="fa-solid fa-cheese" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_8" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-cheese"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_9" type="radio" value="fa-solid fa-fish" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_9" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-fish"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_10" type="radio" value="fa-solid fa-bread-slice" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_10" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-bread-slice"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_11" type="radio" value="fa-solid fa-bowl-rice" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_11" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-bowl-rice"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_12" type="radio" value="fa-solid fa-drumstick-bite" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_12" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-drumstick-bite"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_13" type="radio" value="fa-solid fa-bottle-water" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_13" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-bottle-water"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_14" type="radio" value="fa-solid fa-beer-mug-empty" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_14" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-beer-mug-empty"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_15" type="radio" value="fa-solid fa-candy-cane" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_15" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-candy-cane"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_16" type="radio" value="fa-solid fa-ban" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_16" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-ban"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_17" type="radio" value="fa-solid fa-fish-fins" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_17" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-fish-fins"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_18" type="radio" value="fa-solid fa-seedling" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_18" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-seedling"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_19" type="radio" value="fa-solid fa-mug-saucer" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_19" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-mug-saucer"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_20" type="radio" value="fa-solid fa-bacon" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_20" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-bacon"></i> </label>
            </div>

            <div class="flex items-center">
                <input id="food-icon-{{$index}}_21" type="radio" value="fa-solid fa-ice-cream" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_21" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-ice-cream"></i> </label>
            </div>


            <div class="flex items-center">
                <input id="food-icon-{{$index}}_22" type="radio" value="fa-solid fa-cake-candles" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_22" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-cake-candles"></i> </label>
            </div>


            <div class="flex items-center">
                <input id="food-icon-{{$index}}_23" type="radio" value="fa-solid fa-cookie" name="food-icon-{{$index}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="food-icon-{{$index}}_23" class="ms-2 text-md font-medium rounded-full text-gray-900 dark:text-gray-300"><i class="fa-solid fa-cookie"></i> </label>
            </div>


         
        </div>



    </div>

    <div class="mb-3">
        <label class="block px-6 py-4 md:p-6">
            <span class="text-white">Description (optional)</span>
            <input type="text" id="food_description_{{$index}}" name="food_description_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Tastes good on pizza" />
        </label>
    </div>
</div>

<script>

    $(document).ready(function () {

        $(".autofill_btn").on("click", function() {

            let btn = $(this);

            let btnIndex = $(this).attr('index');

            

            let foodField = $(`#food_name_${btnIndex}`);

            let servingSizeField = $(`#food_servingsize_${btnIndex}`);

            let servingUnitField = $(`#food_servingunit_${btnIndex} option:selected`).attr('longname');

            let sourceField = $(`#food_source_${btnIndex}`);

            // let sentence = `Responding with pure JSON, can you provide the nutritional content for ${foodField.val()} (per ${servingSizeField.val()} ${servingUnitField}, from ${sourceField.val()})? Return the following ONLY: Calories (kcal), Fat (g), Carbs (g), Protein (g), Sugars (g), Saturates (g), Fibre (g), Salt (g).`

            // console.log(foodField.val(), servingSizeField.val(), servingUnitField, sourceField.val(), sentence)

            if(foodField.val() && servingSizeField.val() && servingUnitField && sourceField.val()) {

                btn.addClass('animate-pulse');
                btn.removeClass('animate-gradient');
                
                btn.prop("disabled", true);

                btn.text('Loading...')

                $.ajax({
                    url: `/nutrition/ai/food_prompt/${foodField.val()}/${servingSizeField.val()}/${sourceField.val()}/${servingUnitField}`,
                    method: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': csrfToken
                    },

                    success: function(response) {

                        // response = JSON.parse(response);
                        
                        // const fixedJsonString = rawJsonString.replace(/\\n/g, '\n');

                        // const parsedData = JSON.parse(fixedJsonString);

                        // console.log(response.result);
                        // console.log(typeof response.result);

                        response_JSON = JSON.parse(response.result);

                        ($(`#food_calories_${btnIndex}`)).val(response_JSON['Calories (kcal)']);
                        ($(`#food_fat_${btnIndex}`)).val(response_JSON['Fat (g)']);
                        ($(`#food_carbs_${btnIndex}`)).val(response_JSON['Carbs (g)']);
                        ($(`#food_protein_${btnIndex}`)).val(response_JSON['Protein (g)']);
                        ($(`#food_sugars_${btnIndex}`)).val(response_JSON['Sugars (g)']);
                        ($(`#food_saturates_${btnIndex}`)).val(response_JSON['Saturates (g)']);
                        ($(`#food_fibre_${btnIndex}`)).val(response_JSON['Fibre (g)']);
                        ($(`#food_salt_${btnIndex}`)).val(response_JSON['Salt (g)']);
                        

                        // disable and replace description.
                        ($(`#food_description_${btnIndex}`)).val('Generated using AI Auto Fill.');
                        ($(`#food_description_${btnIndex}`)).addClass('opacity-60');
                        ($(`#food_description_${btnIndex}`)).prop("readonly", true);


                        console.log('Input logged in')

                    },

                    complete: function () {
                        // Hide loading indicator and re-enable submit button
                        btn.removeClass('animate-pulse');
                        btn.addClass('animate-gradient');


                        btn.prop("disabled", false);
                        btn.text('✨ AI Auto Fill ✨')
                    }

                    


                })

            }

        });

    });


</script>