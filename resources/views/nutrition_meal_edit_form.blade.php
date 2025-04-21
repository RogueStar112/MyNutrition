<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - EDIT MEAL') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        

    </div>

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-7xl /w-[768px] mx-auto sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="bg-gray-800 max-w-[65rem] /h-32 rounded-lg" method="GET" action="{{ route('meal.edit_p2', ['meal_id' => $id]) }}">
                    @csrf
                    <div id="FOOD_FORM_INPUTS" class="relative w-full max-w-[400px] md:max-w-full md:max-h-[682px] overflow-hidden">
                       <x-meal-input-item index="1"/>

                    </div>

                    <div id="FOOD-SEARCH-CONTAINER">
                        <!-- x-meal-search-items -->
                    </div>

                    <div id="food-media-controls">
                        {{-- <div class="flex justify-center">
                            <button id="PREV-PAGE-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-left"></i></button>
                            <button id="ADD-FOOD-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-plus"></i></button>
                            <button id="NEXT-PAGE-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-right"></i></button>
                        </div>

                        <div class="flex justify-center">
                            <p id="page-number-text" class="text-gray-500 italic mt-2">Food 1 out of 1.</p>
                        </div> --}}

                        <div class="flex justify-center [&>*]:cursor-pointer">
                            <input type="hidden" id="pages" name="food_pages" value="1"/>
                            <button type="button" class="bg-red-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                            <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><a href="{{ route('meal.view') }}"><i class="fas fa-eye"></i> VIEW</a></button>
                            <button type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
                    </div>
                    

                    <input type="hidden" id="no_of_foods" value="0" autocomplete="off">
                    <input type="hidden" id="foods_pages" name="foods_pages" value="" autocomplete="off">
                    <div id="form-meal-foods">



                    </div>
            

                    
                </form>
            </div>

            <div id="FOOD-ITEMS-CONTAINER" class="max-w-sm mx-auto max-h-screen /sm:px-6 /lg:px-8 [&>div]:mb-3">
                
                
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

        console.log('meal json and food_array reset');
        var meal_json = {};
        var food_array = [];
        var foods_pages = [];
        let food_index = 0;
        let food_id = 0;
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $( "#FOOD-ITEMS-CONTAINER" ).on( "change", function() {
                
                // console.log('food_items_container_change: Tanzania')
                
                // load deletion scripts

                loadMealSelfDeletionScripts();

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
                        index = 2;

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

        $(document).ready(function() {
            
            // var no_of_foods = parseInt($("#no_of_foods").val());

            // $(document).ready(function() {
            // $('.add_food_icon').click(function(e) {
            //     var no_of_foods = parseInt($("#no_of_foods").val()) + 1;

            //     $("#no_of_foods").val(no_of_foods)

            //     console.log(no_of_foods);
            //     });
            // });

            var food_index = 0;
            var food_id = 0;

            var no_of_foods = parseInt($("#no_of_foods").val())
            
            

            var targetElement = $('#FOOD-ITEMS-CONTAINER')[0];

            // thank you to ChatGPT for the mutationobserver tip!
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
                        $(`#nutritional_wrapper_${index_selector}`).toggleClass('slide-down');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('hidden');
                        $(`.nutritional-media-buttons-${index_selector}`).toggleClass('hidden');

                        // adjust height to accomodate for nutritional info
                        // $(`#food_item_${index_selector}`).toggleClass('h-24');

                        // change direction of icon arrow
                        $(`#item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
                        $(`#item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
                    });
                }
                });
            });

            var config = { childList: true, subtree: true };
            observer.observe(targetElement, config);

            // Function to update index attributes
            // function updateIndexes() {
            //     let currentIndex = 1; // Start index at 1
    
            //     // Select all inputs with a class pattern like meal_250, meal_251, etc.
            //     $('#form-meal-foods input[type="hidden"]').each(function() {
            //         const mealClass = $(this).attr('class').match(/meal_\d+/);
                    
            //         if (mealClass) {
            //             $(`.${mealClass[0]}`).attr('index', currentIndex);
            //             currentIndex++;
            //         }
            //     });
            // }

            // // Initialize index on page load
            // updateIndexes();

            // // Set up a MutationObserver to watch for changes in the #form-meal-foods div
            // const indexObserver = new MutationObserver(function(mutationsList) {
            //     mutationsList.forEach(function(mutation) {
            //         if (mutation.type === 'childList') {
            //             updateIndexes();
            //         }
            //     });
            // });

            // // Start observing
            // indexObserver.observe(document.getElementById('form-meal-foods'), { 
            //     childList: true, 
            //     subtree: true 
            // });
        });

        

        $(document).ready(function () {

            // Use event delegation for dynamically loaded elements
            $(document).on("click", `[id^=mealitem-delete-btn-]`, function () {
                let food_index = $(this).data("index"); 
                $(`#mealitem-delete-btn-${food_index}`).addClass("hidden");
                $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).removeClass("hidden");
            });

            $(document).on("click", `[id^=mealitem-delete-btn-yes-]`, function () {
                let food_id = $(this).data("id"); 
                $(`.meal_${food_id}`).remove();
                
                // foreach(meals_array as meal) {

                //     if (meal['food_id'] == food_id) {

                //         meals_array.splice(meals_array.indexOf(meal));

                //     }
                // }

                // console.log('MEALS ARRAY COMPLETION?', meals_array);

            });

            $(document).on("click", `[id^=mealitem-delete-btn-no-]`, function () {
                let food_index = $(this).data("index");
                $(`#mealitem-delete-btn-${food_index}`).removeClass("hidden");
                $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).addClass("hidden");
            });
        });


        var meals_array = <?php echo json_encode($meals_array, JSON_HEX_TAG); ?>

        $(document).ready(function() {
            var no_of_foods = parseInt($("#no_of_foods").val())
            
             for (let i=0; i<meals_array.length; i++) {

              meal_json[meals_array[i]['food_id']] = {'index': i+1, 'query': meals_array[i]['food_id'], 'servingSize': meals_array[i]['servingSize'],'quantity': meals_array[i]['quantity']};
              console.log(meal_json);

              food_array.push(meal_json[meals_array[i]['food_id']]);


               if (meal_json[query]) {
                        console.log('MEAL JSON QUERY ALREADY EXISTS. VAL RETAINED.');
                        var no_of_foods = parseInt($("#no_of_foods").val());
                    } else {
                        console.log('NO OF FOODS INCREASED BY 1.')
                        var no_of_foods = parseInt($("#no_of_foods").val()) + 1;
                    }

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var query = $(this).attr('value');
                    var servingSize = $('#meal_servingsize_1').val();
                    var quantity = $('#meal_quantity_1').val();

                    var ignoreServingSize = $("#disable_servingsize_1").is(':checked');

                    var food_already_exists = false;

                
             }
            for (let i=0; i<meals_array.length; i++) {
                    console.log(meals_array);
                           $.ajax({
                        url: `/nutrition/meal/create_meal/${meals_array[i]['food_id']}`,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            meals: meal_json
                            // no_of_foods: no_of_foods,
                            // balancer: replacement_balancer,
                            // query: query,
                            // servingSize: servingSize,
                            // quantity: quantity
                            // ignoreServingSize: ignoreServingSize
                        },
                        success: function(response) {

                            // forEach(response['html']) {

                            // }
                            
                            // console.log('successful response: ', Object.keys(response['html']).length);
                            
                            // console.log('successful response to render: ' response['html'])
                            // $('#FOOD-ITEMS-CONTAINER').append(response['html']['render_html']);
                            
                            $('#FOOD-ITEMS-CONTAINER').empty();
                            $('#form-meal-foods').empty();

                            foods_pages = [];
                            $("#foods_pages").val(foods_pages);
                            
                            console.log('RESPONSE HTML', Object.entries(response['html']));
                            
                            for (let i = 0; i < food_array.length; i++) {

                                if (response['html'][food_array[i]['index']] == i) {
                                    // console.log('Food already exists. Array length retained.')
                                    $("#no_of_foods").val(no_of_foods-1); 
                                } else {
                                    // console.log('RESPONSE HTML FOOD ARRAY I INDEX', response['html'][food_array[i]['index']])
                                    // console.log('I:', i)
                                    // console.log('Food array length increased.')


                                    $('#FOOD-ITEMS-CONTAINER').append(response['html'][food_array[i]['query']]['render_html']);

                                    // console.log('FOODS PAGES PUSH', response['html'][food_array[i]['query']]);

                                    foods_pages.push(response['html'][food_array[i]['query']]['query']);

                                    $("#foods_pages").val(foods_pages);

                                    // console.log('HTML INPUT DATA LAZARUS', response['html_input_data'][query])

                                    // console.log('HTML INPUT DATA LAZARUS', response['html_input_data'][query])

                                    // $("#form-meal-foods").append(response['html_input_data'][query]);

                                    $("#form-meal-foods").append(response['html'][food_array[i]['query']]['form_data']);
                                    
                                    // no_of_foods += 1;
                                    

                                    $("#no_of_foods").val(no_of_foods); 

                                    
                                    $(`#food-add-${query}`).addClass(`bg-yellow-500 [&>*]:text-black`);
                                    
                                    $(`#food-add-icon-${query}`).addClass(`fa-pencil`);

                                    $(`#food-add-icon-${query}`).removeClass(`fa-plus`);

                                }
                            }

                            // for (const [key, value] of Object.entries(response['html'])) {
                                
                            //     $('#FOOD-ITEMS-CONTAINER').append(response['html'][key]['render_html']);
                            //     $("#no_of_foods").val(no_of_foods);

                            // }
                            // for (let i = 1; i <= Object.keys(response['html']).length; i++) {
                            //     console.log('successful response to render: ', response['html'][i]['render_html'])

                                

                            //     $('#FOOD-ITEMS-CONTAINER').append(response['html'][i]['render_html']);
                            // } 

                            // console.log('FULL RESPONSE HTML ', response['html'])
                            
                            // test
                            // $("#no_of_foods").val(0)

                            console.log('NO OF FOODS: SUCCESS', no_of_foods);

                            no_of_foods += 1;

                            console.log('food_array', food_array);

                            console.log('foods_pages', foods_pages);
                            
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
            }


            console.log('MEALS ARRAY IN COMPLETION', meals_array);
 
        });

        function confirmToDelete(id) {

            $(`#mealitem-delete-btn-${id}`).addClass('hidden');
            $(`#mealitem-delete-btn-confirmcontainer-${id}`).removeClass('hidden');

        }

        function confirmToDelete_no(id) {

            $(`#mealitem-delete-btn-${id}`).removeClass('hidden');
            $(`#mealitem-delete-btn-confirmcontainer-${id}`).addClass('hidden');

        }

        function confirmToDelete_yes(id) {

            $(`.meal_${id}`).remove();

            reorderItems();

        }
                
                    
    </script>
</x-app-layout>
