<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Meal') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        

    </div>

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl flex-col-reverse md:flex-row relative">

            <div class="max-w-7xl /w-[768px] mx-auto sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="bg-gray-800 max-w-[65rem] /h-32 rounded-lg mx-4" method="GET" action="{{ route('meal.create_p2')}}">
                    @csrf

                    
                    <div id="FOOD_FORM_INPUTS" class="relative w-full max-w-[400px] md:max-w-full md:max-h-[682px] overflow-hidden">
                       <x-meal-input-item index="1"/>

                    </div>

                    <div id="food-media-controls" class="sticky top-0 z-0 md:z-50 bg-gray-800 hidden md:block">
                        {{-- <div class="flex justify-center">
                            <button id="PREV-PAGE-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-left"></i></button>
                            <button id="ADD-FOOD-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-plus"></i></button>
                            <button id="NEXT-PAGE-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-right"></i></button>
                        </div>

                        <div class="flex justify-center">
                            <p id="page-number-text" class="text-gray-500 italic mt-2">Food 1 out of 1.</p>
                        </div> --}}

                        <div class="flex justify-center z-[9999]">
                            <input type="hidden" id="pages" name="food_pages" value="1"/>
                            <button type="button" class="bg-red-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                            <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><a href="{{ route('meal.view') }}"><i class="fas fa-eye"></i> VIEW</a></button>
                            <button type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
                    </div>


            
                    <div id="FOOD-ITEMS-CONTAINER-MOBILE" class="hidden sm:hidden max-w-sm mx-auto max-h-screen /sm:px-6 /lg:px-8 [&>*]:my-3 [&>*]:mx-auto [&>div]:bg-slate-900">
                
                        <h2 class="text-center text-white text-2xl italic mt-4 font-extrabold">FOOD LIST</h2>
                   
                        {{-- <div id="food-media-controls-mobile" class="sticky top-0 z-0 md:z-50 bg-gray-800 sm:hidden">
                         
                            <div class="flex justify-center">
                                <input type="hidden" id="pages" name="food_pages" value="1"/>
                                <button type="button" class="bg-red-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                                <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><a href="{{ route('meal.view') }}"><i class="fas fa-eye"></i> VIEW</a></button>
                                <button type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                            </div>
                        </div> --}}
                    </div>

                    

                    <div id="FOOD-SEARCH-CONTAINER">
                        <!-- x-meal-search-items -->
                    </div>

                    
                    

                    <input type="hidden" id="no_of_foods" value="0" autocomplete="off">
                    <input type="hidden" id="foods_pages" name="foods_pages" value="" autocomplete="off">
                    <div id="form-meal-foods"></div>
            

                    
                </form>
            </div>

            <div id="FOOD-ITEMS-CONTAINER" class="hidden sm:block max-w-sm mx-auto max-h-screen /sm:px-6 /lg:px-8 [&>div]:mb-3">
                
                
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

        // console.log('meal json and food_array reset');
        var meal_json = {};
        var food_array = [];
        var foods_pages = [];

        let food_index = 0;
        let food_id = 0;

        $(document).ready(function() {
            
            // var no_of_foods = parseInt($("#no_of_foods").val());

            // $(document).ready(function() {
            // $('.add_food_icon').click(function(e) {
            //     var no_of_foods = parseInt($("#no_of_foods").val()) + 1;

            //     $("#no_of_foods").val(no_of_foods)

            //     console.log(no_of_foods);
            //     });
            // });

            var no_of_foods = parseInt($("#no_of_foods").val())
            
            

            var targetElement = $('#FOOD-ITEMS-CONTAINER')[0];

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
                        $(`.nutritional_wrapper_${index_selector}`).toggleClass('slide-down');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');
                        // $(`#nutritional_wrapper_${index_selector}`).toggleClass('hidden');
                        

                        // adjust height to accomodate for nutritional info
                        // $(`#food_item_${index_selector}`).toggleClass('h-24');
                        $(`.nutritional-media-buttons-${index_selector}`).toggleClass('hidden');

                        // change direction of icon arrow
                        $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
                        $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
                    });
                }
                });
            });

            var config = { childList: true, subtree: true };
            observer.observe(targetElement, config);


            $( "#FOOD-ITEMS-CONTAINER" ).on( "change", function() {
                
                // console.log('food_items_container_change: Tanzania')
                
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
                });        

            $(document).ready(function () {
                $("#SHOW-ITEMS-BTN-MOBILE").on( "click", function() {
                    $('#FOOD_FORM_INPUTS').toggleClass('hidden');
                    $('#food-media-controls').toggleClass('hidden');
                    $('#FOOD-ITEMS-CONTAINER-MOBILE').toggleClass('hidden');
                    $('#FOOD-ITEMS-CONTAINER-MOBILE').toggleClass('block');
                    $('#FOOD-SEARCH-CONTAINER').toggleClass('hidden');

                    $('#SHOW-ITEMS-ICON').toggleClass('fa-cart-shopping');
                    $('#SHOW-ITEMS-ICON').toggleClass('fa-magnifying-glass');
                } );
            });

            $(document).ready(function () {

            $( "#FOOD-ITEMS-CONTAINER" ).on( "change", function() {

                // console.log('This should work POTATOLAND')
                $("#ITEMS-COUNT-MOBILE").text(`${meal_json.length}`)

            })

            });

            // $(document).ready(function() {

            //     function confirmToDelete(id) {

            //     $(`#mealitem-delete-btn-${id}`).addClass('hidden');
            //     $(`#mealitem-delete-btn-confirmcontainer-${id}`).removeClass('hidden');

            //     }

            //     function confirmToDelete_no(id) {

            //     $(`#mealitem-delete-btn-${id}`).removeClass('hidden');
            //     $(`#mealitem-delete-btn-confirmcontainer-${id}`).addClass('hidden');

            //     }

            //     function confirmToDelete_yes(id) {

            //     $(`.meal_${id}`).remove();

            //     reorderItems();

            //     }

            // });

            document.addEventListener('DOMContentLoaded', () => {
                document.addEventListener('click', (e) => {
                    if (e.target && e.target.id.startsWith('mealitem-delete-btn-')) {
                        const food_id = e.target.dataset.id;       // Access data-id
                        const food_index = e.target.dataset.index; // Access data-index

                        console.log(`Food ID: ${food_id}, Food Index: ${food_index}`);

                        // Toggle the clicked button's hidden class
                        $(e.target).toggleClass('hidden');

                        // Toggle the confirm container's hidden class
                        const confirmContainer = document.getElementById(`mealitem-delete-btn-confirmcontainer-${food_index}`);
                        console.log(confirmContainer); // Check if it exists
                        if (confirmContainer) {
                            $(confirmContainer).toggleClass('hidden');
                        } else {
                            console.error(`Element #mealitem-delete-btn-confirmcontainer-${food_index} not found.`);
                        }
                    }
                });
            });



            // Delete button click listener
            $(document).on("click", `#mealitem-delete-btn-${food_index}`, function () {
                $(`#mealitem-delete-btn-${food_index}`).addClass('hidden');
                $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).removeClass('hidden');
            });

            // Confirm delete button click listener
            $(document).on("click", `#mealitem-delete-btn-yes-${food_index}`, function () {
                $(`.meal_${food_id}`).remove();
                reorderItems();
            });

            // Cancel delete button click listener
            $(document).on("click", `#mealitem-delete-btn-no-${food_index}`, function () {
                $(`#mealitem-delete-btn-${food_index}`).removeClass('hidden');
                $(`#mealitem-delete-btn-confirmcontainer-${food_index}`).addClass('hidden');
            });

            console.log(`FOOD ID: ${food_id} UPDATED`);
    


    </script>

    <script>
       
    </script>
</x-app-layout>
