<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center">
            {{ __('Nutrition Body Stats') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <form id="BODY_STATS_FORM" method="POST" class="bg-gray-800 text-white" enctype="multipart/form-data">
            @csrf

            <div class="max-w-3xl border-4 border-orange-500 relative p-4" aria-label="step-one-weight">

                <div>
                    <label class="mt-4" for="current-weight">
                        What is your weight?
                    </label>

                    <div class="mt-4 flex gap-3 items-center">

                        <div class="relative ">
                            <input class='rounded-full p-3 bg-slate-700 text-gray-200' placeholder="84" name='current-weight' id='current-weight' />
                            <select class="absolute right-0 p-3 rounded-r-full border-l-2 border-slate-500 bg-slate-700 text-gray-200 border-r-0 border-t-0 border-b-0 w-[113px]" name="weight-unit" id="weight-unit">
                                <option value="kg" id="unit-kg">kilograms</option>
                                <option value="lbs" id="unit-lbs">pounds</option>
                                <option value="st" id="unit-st">stone</option>
                            </select>
                        </div>
                
                        {{-- <label for="weight-unit-kgs">
                            <input type="radio"  id="weight-unit-kgs" name='weight-unit' value="kg" checked>
                        kg
                        </label>

                        <label for="weight-unit-lbs">
                            <input type="radio" id="weight-unit-lbs" name='weight-unit' value="lbs">
                        lbs
                        </label>

                        <label for="weight-unit-st">
                            <input type="radio" id="weight-unit-st" name='weight-unit' value="st">
                        st
                        </label> --}}

                    </div>
                </div>

                <div class="mt-4">
                    <label class="mt-4" for="current-age">
                        How old are you?


                        <div class="mt-4 flex gap-3 w">

                            <input class='rounded-full p-3 bg-slate-700 text-gray-200' placeholder="21" name='current-age' id='current-age' />

                        </div>
                    </label>
                </div>

                <div class="mt-4">
                    <label class="mt-4" for="current-height">
                        How tall are you?


                        <div class="mt-4 flex gap-3 items-center">

                            <div class="relative ">
                                <input class='rounded-full p-3 bg-slate-700 text-gray-200' placeholder="175" name='current-height' id='current-height' />
                                <select class="absolute right-0 p-3 rounded-r-full border-l-2 border-slate-500 bg-slate-700 text-gray-200 border-r-0 border-t-0 border-b-0" name="height-unit" id="height-unit">
                                    <option value="cm">centimetres</option>
                                    <option value="ft">ft</option>
                                </select>
                            </div>


                            <input class='rounded-full p-3 bg-slate-700 text-gray-200' placeholder="11" name='current-height-in' id='current-height-in' />
                            
                            {{-- <label for="weight-unit-kgs">
                                <input type="radio"  id="weight-unit-kgs" name='weight-unit' value="kg" checked>
                            kg
                            </label>

                            <label for="weight-unit-lbs">
                                <input type="radio" id="weight-unit-lbs" name='weight-unit' value="lbs">
                            lbs
                            </label>

                            <label for="weight-unit-st">
                                <input type="radio" id="weight-unit-st" name='weight-unit' value="st">
                            st
                            </label> --}}

                        </div>
                    </label>
                </div>

                <div class="mt-4">
                    <label class="mt-4" for="gender">
                        Sex (optional)


                        <div class="mt-4 flex gap-3 w">

                                <label for="gender-male">
                                <input type="radio"  id="gender-male" name='gender' value="1">
                                Male
                                </label>

                                <label for="gender-female">
                                <input type="radio" id="gender-female" name='gender' value="0">
                                Female
                                </label>

                                <label for="gender-none">
                                <input type="radio" id="gender-none" name='gender' value="pfnts">
                                Prefer not to say
                                </label>
                            </div>
                    </label>
                </div>

                
             <button type="submit" class="bg-green-500 mt-4 p-4">Submit</button>
            </div>
            
            {{-- <div id="BODY_STATS_QUESTIONS">

                <label for="body_stats_q1">
                    1. Did you measure your height and weight just now?
                <label>
                
                <label for="q1_y">Yes
                <input type="radio" id="q1_y" name="body_stats_q1" value="1">
                </label>


                <label for="q1_n">No
                <input type="radio" id="q1_n" name="body_stats_q1" value="0">
                </label>
                
                

            </div> --}}
        
        </form>
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 [&>div]:bg-gray-800 [&>div]:text-white [&>div]:h-40 [&>div]:mx-3 [&>div]:rounded-lg [&>div]:text-center">
            
            <div class="flex flex-col items-center justify-center">

                <div class="flex justify-center gap-4 ">

                    <button class="p-4 rounded-full bg-red-800 text-2xl">-</button>

                    <input class="flex items-center bg-gray-900 px-4 rounded-full text-center" placeholder="121.7kg">
                    
                    </select>


                    <button class="p-4 rounded-full bg-green-800 text-2xl">+</button>
                </div>
                <p class="text-2xl mt-1">Weight</p>

            </div>

            <div class="flex flex-col items-center justify-center">

                <div class="flex justify-center gap-4 ">

                    <button class="p-4 rounded-full bg-red-800 text-2xl">-</button>

                    <p class="flex items-center bg-gray-900 px-4 rounded-full"> 170cm </p>

                    <button class="p-4 rounded-full bg-green-800 text-2xl">+</button>
                </div>
                <p class="text-2xl mt-1">Height</p>

            </div>

            <div class="flex flex-col items-center justify-center">

                <div class="flex justify-center gap-4 ">

                    <button class="p-4 rounded-full bg-red-800 text-2xl">-</button>

                    <p class="flex items-center bg-gray-900 px-4 rounded-full"> 24.3 </p>

                    <button class="p-4 rounded-full bg-green-800 text-2xl">+</button>
                </div>
                <p class="text-2xl mt-1">BMI</p>

            </div>
            
            

        </div> --}}
    </div>

    <script>

        let weightInput = $('#current-weight');


        let weightVal = $('#current-weight').val();
        let weightUnit = $('#weight-unit').val();



        console.log(parseInt(weightVal));

        function convertWeight(unit_from, unit_to) {

            console.log(unit_from, unit_to);

            if(unit_from == 'kg' && unit_to == 'lbs') {
                // console.log(weightUnit);


                $('#current-weight').val(weightVal*2.2);

                
                // let weightUnit = $('#weight-unit').val();

            }

            if(unit_from == 'lbs' && unit_to == 'kg') {

                // console.log(weightUnit);

                $('#current-weight').val(weightVal/2.2);

                
                // let weightUnit = $('#weight-unit').val();

            }

        }

    

        $(document).ready(function() {

            $('#current-weight').on('input', function() {
                weightVal = $('#current-weight').val();
                console.log('w v changed', weightVal);
            })

            $('#weight-unit').on('click', function() {
                weightUnit = $('#weight-unit').val();
                console.log('w unit changed', weightUnit);
            })

            $('#unit-lbs').click(function() {

                convertWeight(weightUnit, 'lbs');

            }); 

            $('#unit-kg').click(function() {

                convertWeight(weightUnit, 'kg');

            }); 


        })
    </script>
</x-app-layout>
