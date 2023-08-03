<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Meal') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        

    </div>

    <div class="flex py-4 justify-center">
        <div class="flex max-w-8xl">
            {{-- <div id="MEAL_OVERVIEW" class="max-w-3xl bg-gray-900 rounded-lg text-white p-6 /md:max-h-[682px] md:max-h-[886px]">

                <div class="text-center">

                    MEAL OVERVIEW
                <p class="text-4xl">486kcal</p>

                <p class="text-2xl text-red-500">21.7g fat</p>
                
                <p class="text-2xl text-orange-500">70g carbs</p>
                
                <p class="text-2xl text-green-500">46.4g protein</p>
                </div>
            </div> --}}

            <div class="max-w-7xl /w-[768px] mx-auto sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="bg-gray-800 /h-32 rounded-lg" method="POST" action="{{ route('meal.store')}}">
                    @csrf
                    <div id="FOOD_FORM_INPUTS" class="relative md:max-h-[682px] overflow-hidden">
                       <x-meal-input-item index="1"/>

                    </div>

                    <div id="FOOD-SEARCH-CONTAINER" class="">

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

                        <div class="flex justify-center">
                            <input type="hidden" id="pages" name="food_pages" value=""/>
                            <button type="button" class="bg-red-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                            <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-eye"></i>  VIEW</button>
                            <button type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
                    </div>
                    


                </form>
            </div>

            <div id="" class="max-w-sm mx-auto max-h-screen /sm:px-6 /lg:px-8 [&>div]:mb-2 bg-gray-900 rounded-lg text-white p-6 w-[304px]">
                 
              

                <p class="my-6 w-full text-center"> FOOD ITEMS </p>
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

                <div id="FOOD-ITEMS-CONTAINER">

                </div>

                
                <div id="nutrition-info-total" class="w-full">
                    <p class="border-4 border-transparent border-b-white">Total</p>



                </div>
                
            </div>
        </div>

        {{-- Hidden form to keep no_of_foods, doesn't do anything outside of this --}}
        <form>
            <input type="hidden" id="no_of_foods" value="0" autocomplete="off">
            
        </form>
    </div>

    <script>

        var meal_json = {};

        var replacement_balancer = 1;

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
        });        
    </script>
</x-app-layout>
