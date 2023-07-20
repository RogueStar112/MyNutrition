<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Create New Food') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="alert alert-danger max-w-7xl rounded-lg mx-auto text-center bg-red-800 text-white">
        <h1 class="text-2xl font-extrabold">Input Error</h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @isset($validated_data)
        
        <div class="alert alert-danger max-w-7xl rounded-lg mx-auto text-center bg-green-800 text-white p-6">
            <h1 class="text-2xl font-extrabold">Data Insertion Success!</h1>

            <ul>
                @foreach($validated_data as $data)
                    <li>{{$loop->iteration}}. {{$data['food_name']}}</li>
                @endforeach
            </ul>
        </div>

    @endisset

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="bg-gray-800 /h-32 rounded-lg" method="POST" action="{{ route('food.store')}}">
                    @csrf
                    <div id="FOOD_FORM_INPUTS" class="relative max-h-[682px] overflow-hidden">
                       <x-food-input-item index="1"/>

                    </div>

                    <div id="food-media-controls">
                        <div class="flex justify-center">
                            <button id="PREV-PAGE-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-left"></i></button>
                            <button id="ADD-FOOD-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-plus"></i></button>
                            <button id="NEXT-PAGE-BTN" type="button" class="bg-lime-800 text-white p-4 m-4 rounded-lg"><i class="fas fa-arrow-right"></i></button>
                        </div>

                        <div class="flex justify-center">
                            <p id="page-number-text" class="text-gray-500 italic mt-2">Food 1 out of 1.</p>
                        </div>

                        <div class="flex justify-center">
                            <input type="hidden" id="pages" name="food_pages" value="1"/>
                            <button type="button" class="bg-red-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-trash"></i>  DELETE</button>
                            <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-eye"></i>  VIEW</button>
                            <button type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
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

    </div>

    <script>

            var pageNumber = 1;
            var pageNumber_index = 0;
            var lastPageSelected = 1;
            var noOfPages = 1;
            var page_numbers = [1];
            var page_content = {};

            // The Page Balancer: Weird name, but basically ensures that the nextPage function does not go out of page range.
            var pageBalancer = 1;

            $(document).ready(function() {
                $('#ADD-FOOD-BTN').click(function(e) {

                    e.preventDefault();
                    
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    var index = noOfPages;
                    var name = $(`#food_name_${noOfPages}`).val();
                    var source = $(`#food_source_${noOfPages}`).val();
                    var calories = $(`#food_calories_${noOfPages}`).val();
                    var fat = $(`#food_fat_${noOfPages}`).val();
                    var carbs = $(`#food_carbs_${noOfPages}`).val();
                    var protein = $(`#food_protein_${noOfPages}`).val();

                    $.ajax({
                        url: '/nutrition/food/create_item',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            index: index,
                            name: name,
                            source: source,
                            calories: calories,
                            fat: fat,
                            carbs: carbs,
                            protein: protein // Pass the parameter as an object property
                        },
                        success: function(response) {
                            $('#FOOD-ITEMS-CONTAINER').append(response);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });

                    noOfPages += 1;
                    index += 1;

                    page_numbers.push(noOfPages);

                    $('#pages').val(page_numbers);
                    // pageNumber = noOfPages;
                    updatePageNumber();

                    $.ajax({
                        url: '/nutrition/food/create_page',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            index: index,
                            active: 'collapse hidden'
                        },
                        success: function(response) {
                            $('#FOOD_FORM_INPUTS').append(response);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });

                    updatePageContents();

                });

                $('#PREV-PAGE-BTN').click(function() {
                    prevPage();
                })

                $('#NEXT-PAGE-BTN').click(function() {
                    nextPage();

                });
            });

            function createNewPage_DOM() {

            }

            function createNewFoodItem_DOM() {

            }

            function prevPage() {
         
                if (pageNumber_index > 0) {
                    // If the page number basically isn't one, go to the previous page.
                    pageNumber_index -= 1
                    pageNumber = page_numbers[pageNumber_index]
                    console.log('prev page!')
                } else {
                    // If Page Number is less than 1, go to the most recent page. THIS IS INTENDED so the user doesn't have to click a lot of times to get to a certain page.
                    pageNumber_index = page_numbers.length-1 //page_numbers.slice(-1)[0]-1;
                    pageNumber = page_numbers[pageNumber_index];

                    console.log('most recent page!')
                }

                updatePageNumber();
                updatePageContents();
                updateSidebar();
            }

            function nextPage() {
                if (pageNumber_index >= 0 && pageNumber_index < noOfPages-1) {
                    pageNumber_index += 1
                    pageNumber = page_numbers[pageNumber_index]
                    console.log('next page!')
                } else {
                    pageNumber_index = 0;
                    pageNumber = page_numbers[pageNumber_index]
                    console.log('first page overflow!')
                }
                
                updatePageNumber();
                updatePageContents();
                updateSidebar();
            }

            function goToPage(page) {

                $(`#food_item_${lastPageSelected}`).removeClass('sb-selected');

                pageNumber = page;
                pageNumber_index = page-1; 


                // essentially the same as UpdatePageNumber.
                $("#page-number-text").text("Food " + pageNumber + " out of " + page_numbers.length)

                $(`#food_item_${pageNumber}`).addClass('sb-selected');

                lastPageSelected = pageNumber

                updatePageContents();

            // updateSidebar();

            }

            function newPage() {


            }

            function updatePageContents() {

                var transaction_list = $(`div[id^="food_number_"],[id*="food_number_"]`).not(`.food_number_${pageNumber}`);
                
                for (let item of transaction_list) {
                    $(item).addClass('invisible hidden');
                }

                $(`#food_number_${pageNumber}`).removeClass('invisible hidden');

            }

            function updatePageNumber() {
                pageNumber_index += 1

                if (pageNumber_index > page_numbers.length) {
                    pageNumber_index -= 1;
                }

                $("#page-number-text").text("Food " + pageNumber_index + " out of " + page_numbers.length)
                pageNumber_index -= 1
            }

            function updateSidebar() {

                var name_val = $(`#food_name_${lastPageSelected}`).val();
                var source_val = $(`#food_source_${lastPageSelected}`).val();
                var calories_val = $(`#food_calories_${lastPageSelected}`).val();
                var fat_val = $(`#food_fat_${lastPageSelected}`).val();
                var carbs_val = $(`#food_carbs_${lastPageSelected}`).val();
                var protein_val = $(`#food_protein_${lastPageSelected}`).val();

                $(`#food_text_name_${lastPageSelected}`).text(name_val)
                $(`#food_text_source_${lastPageSelected}`).text(source_val)
                $(`#food_text_calories_${lastPageSelected}`).text(calories_val + `kcal`)
                $(`#food_text_fat_${lastPageSelected}`).text(fat_val + `g`)
                $(`#food_text_carbs_${lastPageSelected}`).text(carbs_val + `g`)
                $(`#food_text_protein_${lastPageSelected}`).text(protein_val + `g`)
                
                // perc means percentages
                var calories_perc = (parseFloat(calories_val) / 1500) * 100
                var fat_perc =  (parseFloat(fat_val) / 97) * 100
                var carbs_perc =  (parseFloat(carbs_val) / 97) * 100
                var protein_perc = (parseFloat(protein_val) / 80) * 100

                $(`#food_progressbar_calories_${lastPageSelected}`).css('width', `${calories_perc}%`)
                $(`#food_progressbar_fat_${lastPageSelected}`).css('width', `${fat_perc}%`)
                $(`#food_progressbar_carbs_${lastPageSelected}`).css('width', `${carbs_perc}%`)
                $(`#food_progressbar_protein_${lastPageSelected}`).css('width', `${protein_perc}%`)


                $(`#food_item_${lastPageSelected}`).removeClass('sb-selected');

                lastPageSelected = pageNumber;

                $(`#food_item_${pageNumber}`).addClass('sb-selected');
         }

            function deletePage() {

            }

            function updatePagesList() {

            }




            // Food Item Tracker
            $(document).ready(function() {

                var targetElement = $('#FOOD-ITEMS-CONTAINER')[0];

                // thank you to ChatGPT for the mutationobserver tip!
                // Create a new MutationObserver instance
                var observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' && mutation.target === targetElement) {
                        // Additional code to handle the change

                        $(`#item_revealbtn_${noOfPages-1}`).click(function() {
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

            // $("#FOOD-ITEMS-CONTAINER").on("change", function () {
            //         console.log('change detected!')
            //         $('.food_revealbtn').click(function() {
            //             // get index of button
            //             var index_selector = $(this).attr('index');

            //             // open/close nutritional info
            //             $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');

            //             // adjust height to accomodate for nutritional info
            //             $(`#food_item_${index_selector}`).toggleClass('h-24');

            //             // change direction of icon arrow
            //             $(`#item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
            //             $(`#item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
            //         });

            // });
    </script>
</x-app-layout>
