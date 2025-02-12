<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Create New Food') }}
        </h1>
    </x-slot>

    @if(session('success'))
        <div class="alert alert-success max-w-7xl rounded-lg mx-auto text-center bg-green-800 text-white p-6" id="success-message-received">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                document.getElementById('success-message-received').style.display = 'none';
            }, 6000); // Disappears after 6 seconds
        </script>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger max-w-7xl rounded-lg mx-auto text-center bg-red-800 text-white" id="error-message-received">
        <h2 class="text-2xl font-extrabold">Input Error</h2>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('error-message-received').style.display = 'none';
        }, 6000); // Disappears after 6 seconds
    </script>
    @endif

    @isset($validated_data)
        @if(count($validated_data) > 0)
        <div class="alert alert-danger max-w-7xl rounded-lg mx-auto text-center bg-green-800 text-white p-6">
            <h2 class="text-2xl font-extrabold">Data Insertion Success!</h2>

            <div class="w-full flex justify-center mt-6">
            <table class="w-2/3">
                <thead class="rounded-lg">
                    <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <th class="p-6 hidden md:table-cell">#</th>
                        <th class="p-6 w-1/3 md:w-auto">Name</th>
                        <th class="p-6 w-1/3 md:w-auto">Source</th>
                        <th class="p-6 hidden md:table-cell">Serving Size</th>
                        <th class="p-6 hidden md:table-cell">Calories</th>
                        <th class="p-6 hidden md:table-cell">Fat</th>
                        <th class="p-6 hidden md:table-cell">Carbohydrates</th>
                        <th class="p-6 hidden md:table-cell">Protein</th>
                    </tr>
                </thead>

                @php
                
                $isEven = false;

                @endphp

                <tbody>
                    @foreach($validated_data as $index=>$data)
                    
                    @php
                        if($index % 2 == 0) {
                            $isEven = true;
                        } else {
                            $isEven = false;
                        }
                    @endphp

                    <tr class="@if(!$isEven)dark:bg-gray-900 @else dark:bg-gray-500 @endif ">
                        <td class="px-6 py-3 hidden md:table-cell">{{$loop->iteration}}</td> 
                        <td>{{$data['food_name'] ?? ""}}</td>
                        <td>{{$data['food_source'] ?? ""}}</td>

                        @isset($data['food_servingunit'])
                            @if($data['food_servingunit'] == 'slice' || $data['food_servingunit'] == 'pc')
                                <td>{{$data['food_servingsize'] ?? ""}} {{$data['food_servingunit'] ?? ""}}s</td>
                            @else
                                <td>{{$data['food_servingsize'] ?? ""}}{{$data['food_servingunit'] ?? ""}}</td>
                            @endif
                        @endisset

                        <td>{{$data['food_calories'] ?? ""}}</td>
                        <td>{{$data['food_fat'] ?? ""}}</td>
                        <td>{{$data['food_carbs'] ?? ""}}</td>
                        <td>{{$data['food_protein'] ?? ""}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        @endif
    @endisset

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-3xl mx-auto px-6 sm:px-6 lg:px-8">
                <form id="FOOD_FORM" class="bg-gray-800 /h-32 rounded-lg" method="POST" enctype="multipart/form-data" action="{{ route('food.store')}}">
                    @csrf
                    <div id="FOOD_FORM_INPUTS" class="relative /md:max-h-[682px] /md:max-h-[750px] /md:max-h-[935px] md:max-h-[1380px] overflow-hidden">


                       <x-food-input-item index="1" :servingUnitOptions="$food_form_options"/>

                    </div>

                    <div id="FOOD-ITEMS-CONTAINER-MOBILE" class="hidden sm:hidden max-w-sm mx-auto max-h-screen /sm:px-6 /lg:px-8 [&>*]:my-3 [&>*]:mx-auto [&>div]:bg-slate-900">
                
                        <h2 class="text-center text-white text-2xl italic mt-4 font-extrabold">FOOD LIST</h2>
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
                            <button type="button" class="bg-blue-600 text-white p-4 m-4 rounded-lg"><a href="{{ route('food.view')}}"><i class="fas fa-eye"></i>  VIEW</a></button>
                            <button id="SUBMIT-FOOD-BTN" type="submit" class="bg-lime-600 text-white p-4 m-4 rounded-lg"><i class="fas fa-check"></i>  SUBMIT</button>
                        </div>
                    </div>
                    


                </form>
            </div>

            <div id="FOOD-ITEMS-CONTAINER" class="max-w-sm mx-auto max-h-screen hidden md:block /sm:px-6 /lg:px-8 [&>div]:mb-3">
                
                
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


            // Thanks to stackoverflow for this 'single-form submission check' 
            // https://stackoverflow.com/questions/17106885/disable-submit-button-only-after-submit
            // this is to prevent submitting more than once accidentally.

            $(document).ready(function () {
                $("#FOOD_FORM").submit(function () {
                    $("#SUBMIT-FOOD-BTN").attr("disabled", true);
                    return true;
                });
            });


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
                    var servingSize = $(`#food_servingsize_${noOfPages}`).val();
                    var servingUnit = $(`#food_servingunit_${noOfPages}`).val();
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
                            serving_size: servingSize,
                            serving_unit: servingUnit,
                            source: source,
                            calories: calories,
                            fat: fat,
                            carbs: carbs,
                            protein: protein // Pass the parameter as an object property
                        },
                        success: function(response) {
                            $('#FOOD-ITEMS-CONTAINER').append(response);
                            $('#FOOD-ITEMS-CONTAINER-MOBILE').append(response);
                            nextPage();
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

                } else {
                    // If Page Number is less than 1, go to the most recent page. THIS IS INTENDED so the user doesn't have to click a lot of times to get to a certain page.
                    pageNumber_index = page_numbers.length-1 //page_numbers.slice(-1)[0]-1;
                    pageNumber = page_numbers[pageNumber_index];

                }

                updatePageNumber();
                updatePageContents();
                updateSidebar();
            }

            function nextPage() {
                if (pageNumber_index >= 0 && pageNumber_index < noOfPages-1) {
                    pageNumber_index += 1
                    pageNumber = page_numbers[pageNumber_index]
         
                } else {
                    pageNumber_index = 0;
                    pageNumber = page_numbers[pageNumber_index]
          
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
                var servingsize_val = $(`#food_servingsize_${lastPageSelected}`).val();
                var servingunit_val = $(`:selected`, `#food_servingunit_${lastPageSelected}`).attr('shortname');
                
                // $(function() { 
                //     $(`#food_servingunit_${lastPageSelected}`).change(function(){ 
                //         var element = $(this).find('option:selected'); 
                //         var myTag = element.attr("shortname"); 

                //         $(`#food_text_servingunit_${lastPageSelected}`).text(servingunit_val);
                //     }); 
                // }); 

               
                var fat_val = $(`#food_fat_${lastPageSelected}`).val();
                var carbs_val = $(`#food_carbs_${lastPageSelected}`).val();
                var protein_val = $(`#food_protein_${lastPageSelected}`).val();

                $(`#food_text_name_${lastPageSelected}`).text(name_val)
                $(`#food_text_source_${lastPageSelected}`).text(source_val)
                $(`#food_text_calories_${lastPageSelected}`).text(calories_val + `kcal`)
                $(`#food_text_servingsize_${lastPageSelected}`).text(servingsize_val);
                $(`#food_text_servingunit_${lastPageSelected}`).text(servingunit_val);
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

                // Create a new MutationObserver instance
                var observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                    if (mutation.type === 'childList' && mutation.target === targetElement) {
                        // Additional code to handle the change

                        $(`.item_revealbtn_${noOfPages-1}`).click(function() {
                        // get index of button
                            var index_selector = $(this).attr('index');

                            // open/close nutritional info
                            $(`.nutritional_wrapper_${index_selector}`).toggleClass('slide-down');
                            // $(`#nutritional_wrapper_${index_selector}`).toggleClass('collapse');
                            // $(`#nutritional_wrapper_${index_selector}`).toggleClass('hidden');
                            

                            // adjust height to accomodate for nutritional info
                            // $(`#food_item_${index_selector}`).toggleClass('h-24');

                            // change direction of icon arrow
                            $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-down');
                            $(`.item_icon_${index_selector}`).toggleClass('fas fa-chevron-up');
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

            $(document).ready(function () {
                $("#SHOW-ITEMS-BTN-MOBILE").on( "click", function() {
                    $('#FOOD_FORM_INPUTS').toggleClass('hidden');
                    $('#FOOD-ITEMS-CONTAINER-MOBILE').toggleClass('hidden');
                    $('#FOOD-ITEMS-CONTAINER-MOBILE').toggleClass('block');
                } );
            });

            

            $(document).ready(function () {

                    $(".autofill_btn").on("click", function() {

                        let btnIndex = $(this).attr('index');

                        let foodField = $(`#food_name_${btnIndex}`);

                        let servingSizeField = $(`#food_servingsize_${btnIndex}`);

                        console.log(`Autofill Test ${btnIndex}`);

                        if(foodField.val() && servingSizeField.val()) {

                            $.ajax({
                                url: `/nutrition/ai/food_prompt/${foodField.val()}/${servingSizeField.val()}`,
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

                                    console.log('Input logged in')
                                    

                                }


                            })

                        }

                    });

                });
                


    </script>
</x-app-layout>
