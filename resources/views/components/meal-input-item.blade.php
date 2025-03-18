

<div id="meal_number_{{$index}}" class="/inline-block bg-slate-50 dark:bg-slate-800">

    <div class="p-6 text-center">
    <p class="dark:text-gray-500">You have two options to add meals.</p>

    <h2 class="dark:text-white text-2xl mt-2 text-center">1. Select Existing Foods To Add</h2>
    <p class="dark:text-gray-500 italic mt-2 text-center">Type in all three inputs, then press enter. ↩️</p>
    </div>

    <div class="mb-3 md:grid md:grid-cols-3 gap-1 /w-[50rem]">
        
        <label class="block p-6">
            <span class="dark:text-white w-full text-center block">Search Existing Foods</span>
            <div class="flex place-items-center w-full">
                <i class="fas fa-magnifying-glass mx-3 dark:text-white"></i>
                <input type="text" id="meal_name_{{$index}}" name="meal_name_{{$index}}" class="block dark:bg-slate-700 dark:text-gray-200 w-full mt-1 rounded-md" placeholder="Fries" value="" required/>
            </div>
        </label>

        <label class="block p-6">
            <span class="dark:text-white w-full text-center block">Enter Serving Size</span>
            <div class="flex place-items-center">
                <i class="fas fa-balance-scale mx-3 dark:text-white"></i>
                <input type="text" id="meal_servingsize_{{$index}}" name="meal_name_servingsize_{{$index}}" class="block dark:bg-slate-700 dark:text-gray-200 w-full mt-1 rounded-md" placeholder="100" value="" required/>
            </div>
        </label>

        <label class="block p-6">
            <span class="dark:text-white w-full text-center block">Enter Quantity</span>
            <div class="flex place-items-center">
                <i class="fas fa-times mx-3 dark:text-white"></i>
                <input type="text" id="meal_quantity_{{$index}}" name="meal_name_quantity_{{$index}}" class="block dark:bg-slate-700 dark:text-gray-200 w-full mt-1 rounded-md" placeholder="1" value="" required/>
            </div>
        </label>

        <div class="hidden /flex items-center p-6">
            <input id="disable_servingsize_1" name="disable_servingsize_1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="disable_servingsize_1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ignore serving size</label>
        </div>

    </div> 

    {{-- <div class="flex gap-2 mx-6 text-white items-center opacity-60">

        <div class="w-full border-b-4 border-white"></div>
        <div>OR</div>
        <div class="w-full border-b-4 border-white"></div>

    </div> --}}

    {{-- <div class="p-6 text-center" >
        <h2 class="text-white text-2xl text-center mb-6 rounded-lg">1b. Add Non-Database Food To Meal</h2>    
        
        <div class="flex justify-center bg-slate-900">
            
            <div id="meal_number_{{$index}}_altinput" class="flex flex-col md:flex-row gap-2 [&>div]:flex [&>div]:flex-col [&>div>input]:w-full md:[&>div>input]:w-[6.5rem] [&>div]:items-center">
                
                <div id="meal_number_{{$index}}_altinput_icon" class="my-2 opacity-50">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            ICON
                    </div>
                
                    <div class="bg-transparent self-center flex justify-center items-center h-[42px] w-[42px] max-w-[42px] max-h-[42px] [&amp;>img]:hidden [&amp;>i]:scale-150 [&amp;>img]:justify-evenly [&amp;>img]:items-center rounded-full border-4 border-slate-500">
                    
                        <i class="fa-solid fa-plus text-white scale-150 /leading-[42px] /h-[42px] /w-[42px] /max-w-[42px] /max-h-[42px] text-center  text-lg"></i>
                        
                
                    </div>
                
                </div>

                <div id="meal_number_{{$index}}_altinput_name" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            NAME
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_alt_name_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="Bread Roll" value="" required/>
   
                
                </div>

                <div id="meal_number_{{$index}}_altinput_size" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            SIZE
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_altinput_size_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="172" value="" required/>
   
                
                </div>

                <div id="meal_number_{{$index}}_altinput_quantity" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            QUANTITY
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_altinput_quantity_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="146" value="" required/>
   
                
                </div>

                <div id="meal_number_{{$index}}_altinput_kcal" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            KCAL
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_altinput_kcal_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="3.9" value="" required/>
   
                
                </div>

                <div id="meal_number_{{$index}}_altinput_fat" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            FAT (g)
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_altinput_fat_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="172" value="" required/>
   
                
                </div>

                <div id="meal_number_{{$index}}_altinput_carbs" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            CARBS (g)
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_altinput_carbs_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="172" value="" required/>
   
                
                </div>

                <div id="meal_number_{{$index}}_altinput_protein" class="my-2">
                    
                    <div id="" class="font-extrabold text-slate-500">
                            PROTEIN (g)
                    </div>
                
                    <input type="text" id="meal_quantity_{{$index}}" name="meal_name_altinput_protein_{{$index}}" class="block bg-slate-700 text-gray-200 mt-1 rounded-md" placeholder="172" value="" required/>
   
                
                </div>

            </div>

        </div>
        
    </div> --}}

    <div class="mb-3 md:grid md:grid-cols-3 gap-1 /w-[50rem]">
        

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


        function validateString(string) {
            let myString = parseStr(string.split(""));
            
            if (string[0] ==  '0') {
                myString = myString.slice(1, string.length);
                
                
            } 

            if (string[string.length-1] == '.') {
                myString = myString.join().replace(".", "")

                myString = myString.replace(",", "");

            }

            return myString;
        }


        // Only numeric and . characters allowed.

        $('#meal_servingsize_1, #meal_quantity_1').on('input', function() {

            
            const allowedChars = /[^0-9.\s]/g;
            this.value = this.value.replace(allowedChars, '');
        });

        $(document).ready(function() {
                $('#meal_name_1, #meal_servingsize_1, #meal_quantity_1').on("keypress", function(e) {
                    
                    // if key press = enter key.
                    if(e.which == 13) {
                        e.preventDefault();

                        /* new block of code - refactor later.
                            const pattern = `/^\d+(\.\d+)?$/`;

                            var csrfToken = $('meta[name="csrf-token"]').attr('content');
                            var query = $('#meal_name_1').val();
                            var servingSize = pattern.test($('#meal_quantity_1').val()), $('#meal_servingsize_1').val()) ?  $('#meal_servingsize_1').val() : "1";
                            var quantity = pattern.test($('#meal_quantity_1').val()) ? $('#meal_quantity_1').val() : "1";
                            var foods_pages = $('#foods_pages').val().split(",");
                        */

                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var query = $('#meal_name_1').val();
                        var servingSize = $('#meal_servingsize_1').val();
                        var quantity = $('#meal_quantity_1').val();
                        var foods_pages = $('#foods_pages').val().split(",");

                        // console.log("FOODS PAGES SWPF", foods_pages)

                        var existsAsItem = jQuery.inArray(query, foods_pages) !== -1 ? true : false;

                        // console.log("EXISTS AS ITEM", existsAsItem);

                        if (servingSize == "") {
                            servingSize = 1;
                        }

                        if (quantity == "") {
                            quantity = 1;
                        }

                        var ignoreServingSize = $("#disable_servingsize_1").is(':checked');

                        $.ajax({
                            url: `/nutrition/meal/search_food/${query}`,
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            data: {
                                query: query,
                                servingSize: servingSize,
                                quantity: quantity,
                                existsAsItem: existsAsItem
                                //ignoreServingSize: ignoreServingSize
                            },
                            success: function(response) {
                                $('#FOOD-SEARCH-CONTAINER').empty().append(response);
                                // console.log('success');
                                console.log(response);
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