<div id="meal_number_{{$index}}" class="inline-block">
    <div class="p-6">
    <h1 class="text-white text-2xl">1. Select Foods To Add</h1>
    <p class="text-gray-500 italic mt-2">Type in all three inputs, then press enter.</p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-3 gap-1 w-[50rem]">

        <label class="block p-6">
            <span class="text-white w-full text-center block">Search Existing Foods</span>
            <div class="flex place-items-center">
                <i class="fas fa-magnifying-glass mx-3 text-white"></i>
                <input type="text" id="meal_name_{{$index}}" name="meal_name_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Ricotta Cheese" value="" required/>
            </div>
        </label>

        <label class="block p-6">
            <span class="text-white w-full text-center block">Enter Serving Size (g)</span>
            <div class="flex place-items-center">
                <i class="fas fa-balance-scale mx-3 text-white"></i>
                <input type="text" id="meal_name_servingsize_{{$index}}" name="meal_name_servingsize_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="100g" value="" required/>
            </div>
        </label>

        <label class="block p-6">
            <span class="text-white w-full text-center block">Enter Quantity</span>
            <div class="flex place-items-center">
                <i class="fas fa-times mx-3 text-white"></i>
                <input type="text" id="meal_name_quantity_{{$index}}" name="meal_name_quantity_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="1" value="" required/>
            </div>
        </label>

        <div class="hidden flex items-center p-6">
            <input id="disable_servingsize_1" name="disable_servingsize_1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="disable_servingsize_1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ignore serving size</label>
        </div>

    </div> 

    {{-- <div class="p-6">
    <h1 class="text-white text-2xl">2. Nutritional Info</h1>
    <p class="text-gray-500 italic mt-2">According to serving size. All fields optional.</p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-4 gap-1">
        
        <label class="block p-6">
            <span class="text-white">Calories (kcal)</span>
            <input type="text" id="meal_calories_{{$index}}" name="meal_calories_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="182"  value="" />
        </label>

        <label class="block p-6">
            <span class="text-white">Fat (g)</span>
            <input type="text" id="meal_fat_{{$index}}" name="meal_fat_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="14.1"  value="" />


        </label>

        
        <label class="block p-6">
            <span class="text-white">Carbs (g)</span>
            <input type="text" id="meal_carbs_{{$index}}" name="meal_carbs_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="4.7"  value="" />
        </label>

        
        <label class="block p-6">
            <span class="text-white">Protein (g)</span>
            <input type="text" id="meal_protein_{{$index}}" name="meal_protein_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="11.7"  value="" />
        </label>
    </div>

    <div class="p-6">
        <h1 class="text-white text-2xl">3. Extra Info</h1>
    </div>

    <div class="mb-3">
        <label class="block p-6">
            <span class="text-white">Description</span>
            <input type="text" name="meal_description_{{$index}}" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Tastes good on pizza" />
        </label>
    </div> --}}
    
    <script>
        $(document).ready(function() {
                $('#meal_name_1, #meal_name_servingsize_1, #meal_name_quantity_1').on("keypress", function(e) {
                    
                    // if key press = enter key.
                    if(e.which == 13) {
                        e.preventDefault();

                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var query = $('#meal_name_1').val();
                        var servingSize = $('#meal_name_servingsize_1').val();
                        var quantity = $('#meal_name_quantity_1').val();

                        if (servingSize == "") {
                            servingSize = 100;
                        }

                        if (quantity == "") {
                            quantity = 1;
                        }

                        var ignoreServingSize = $("#disable_servingsize_1").is(':checked');

                        $.ajax({
                            url: `/nutrition/meal/search_food/${query}`,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                query: query,
                                servingSize: servingSize,
                                quantity: quantity
                                //ignoreServingSize: ignoreServingSize
                            },
                            success: function(response) {
                                $('#FOOD-SEARCH-CONTAINER').empty().append(response);
                                console.log('success');
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    }

            });
        });
    </script>
</div>