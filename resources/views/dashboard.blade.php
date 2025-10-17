<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-black dark:text-white text-3xl text-gray-800 leading-tight  text-center sm:text-left">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-black dark:text-white text-center sm:text-left">Last 2 Weeks of Activity</p>
    </x-slot>

    <div class="min-h-screen max-w-7xl py-4 pt-6 px-4 sm:px-6 lg:px-8 /max-w-7xl mx-auto">
        <div class="flex flex-col sm:grid grid-cols-5 grid-rows-5 w-full h-full gap-2 /h-[calc(100vh-8rem)] /max-h-[900px] /[&>*]:flex  [&>*]:text-black dark:[&>*]:text-white max-h-[1437px]">

            <div id="MacroIntakeChart_container_daily" class="col-start-1 col-end-3 row-start-1 row-end-3 bg-slate-800 w-full h-full rounded-lg relative pb-6 sm:pb-0">

                <p class="p-4 text-left w-full">Latest Day Macro Breakdown<br>{{date('d/m/Y', strtotime($pie_date_selected))}}</p>

                {{-- <livewire:dashboard.daily-pie-chart :day_selected="$pie_date_selected" :pie_sum_calories="$pie_sum_calories" :pie_sum_fat="$pie_sum_fat" :pie_sum_carbs="$pie_sum_carbs" :pie_sum_protein="$pie_sum_protein" /> --}}

                <div class="relative [&>canvas]:mx-auto [&>canvas]:w-full">
                        <x-chartjs-component :chart="$pie_chart" />

                        @php
                            $nutrients_g_total = $pie_sum_fat + $pie_sum_carbs + $pie_sum_protein;
                            

                            $pie_sum_fat_perc = round((($pie_sum_fat) / $nutrients_g_total) * 100, 1);
                            
                            $pie_sum_carbs_perc = round((($pie_sum_carbs) / $nutrients_g_total) * 100, 1);
                            
                            $pie_sum_protein_perc = round((($pie_sum_protein) / $nutrients_g_total) * 100, 1);
                        @endphp

                        <div class="absolute top-[1rem] z-50 w-full h-full flex justify-center items-center flex-col select-none">
                            <div class=" text-blue-500 text-4xl">{{$pie_sum_calories}}<span class="text-2xl items-end">kcal</span></div>

                            <div class=" text-orange-500 text-sm sm:text-lg">{{$pie_sum_fat}}<span class="text-sm sm:text-sm items-end">g Fat</div>

                            <div class=" text-red-500 text-sm sm:text-lg">{{$pie_sum_carbs}}<span class="text-sm sm:text-sm items-end">g Carbs</div>
                        
                            <div class=" text-green-500 text-sm sm:text-lg">{{$pie_sum_protein}}<span class="text-sm sm:text-sm items-end">g Protein</span></div>
                        </div>

                    <div class="absolute top-[-4.5rem] right-0 flex flex-col items-end justify-end gap-2 [&>*]:text-center [&>*]:w-full [&>*]:mx-2 bg-transparent p-4 rounded-lg">
                        <p class="bg-orange-500 text-slate-800 rounded-lg bottom-0 right-0">{{$pie_sum_fat_perc}}%</p>
                        <p class="bg-red-500 text-slate-800 rounded-lg bottom-0 right-0">{{$pie_sum_carbs_perc}}%</p>
                        <p class="bg-green-500 text-slate-800 rounded-lg bottom-0 right-0">{{$pie_sum_protein_perc}}%</p>
                    </div>
                </div> 

               
            </div>


            <div id="MacroIntakeChart_container" class="col-start-3 col-end-6 row-start-1 row-end-3 rounded-lg bg-slate-800 flex flex-col /border-2 /border-green-500 overflow-x-scroll min-w-full relative min-h-[500px] max-h-[570px]">
                


                <p class="sticky left-0 text-center m-4">Macro Intake</p>
                    

         

                {{-- <p class="">You have averaged...</p>
                <p class="mx-4 mt-2 text-2xl font-black text-orange-300">{{round($avg_calories, 0)}}</p>

                <p></p> --}}
                
                <div class="m-4 sm:m-0 rounded-lg min-w-[648px] min-h-[300px] max-h-[401px] sm:min-w-full sm:w-full h-full relative flex items-center /[&>*]:absolute overflow-x-scroll">
                    <x-chartjs-component :chart="$chart" />
                </div>    

                    <div id="calories-avg" class="flex justify-around sm:flex-row sm:justify-evenly sticky left-0 py-4">

                                <div class="text-center">
                                <p class="text-orange-200 text-center">Average</p>


                                <span class="text-orange-300 text-2xl sm:text-4xl font-black">{{round($avg_calories, 0)}}kcal</span>
                                </div>


                                <div class="text-center">
                                <p class="text-red-200 text-center">Highest</p>


                                <span class="text-red-300 text-2xl sm:text-4xl font-black">{{round($highest_calories, 0)}}kcal</span>

                            </div>


                            <div class="text-center">
                            
                                <p class="text-green-200 text-center">Lowest</p>


                                <span class="text-green-300 text-2xl sm:text-4xl font-black">{{round($lowest_calories, 0)}}kcal</span>


                            </div>
                     </div>

            


            </div>



            

            <div id="MacrosChart" class="col-start-1 col-end-4 row-start-3 row-end-4 /border-4 /border-blue-300 flex flex-row max-w-screen sm:flex-row justify-between [&>*]:w-screen [&>*]:h-full [&>*]:bg-slate-800 sm:[&>*]:p-4 [&>*]:rounded-lg [&>*]:shadow-2xl gap-4 overflow-x-scroll max-h-[281px] min-h-[281px] sm:h-fit">
                




                    <x-chartjs-component :chart="$fat_chart" />
         
                    <x-chartjs-component :chart="$carbs_chart" />
     
                    <x-chartjs-component :chart="$protein_chart" />
       
            </div>

            
            <div class="col-start-4 col-end-6 row-start-3 row-end-6 /border-4 /border-green-300 flex flex-col bg-slate-800 p-4 rounded-lg">
                <p class="text-center w-full p-4 font-black text-3xl">Last 10 Meals</p>
                
                <div class="flex flex-col h-full justify-start items-center /[&>*]:grow gap-4">
                @isset($last_five_meals_array)
                    
                    @for($i = 0; $i < count($last_five_meals_array['dates']); $i++) 
                       
                        @php
                            $meal_name = $last_five_meals_array['names'][$last_five_meals_array['dates'][$i]];
                            $meal_calories = $last_five_meals_array['calories'][$i];
                            $meal_fats = $last_five_meals_array['fat'][$i];
                            $meal_carbs = $last_five_meals_array['carbs'][$i];
                            $meal_protein = $last_five_meals_array['protein'][$i];
                            $meal_macros = $last_five_meals_array['macros'][$last_five_meals_array['dates'][$i]];
                            $meal_micros = $last_five_meals_array['micros'][$last_five_meals_array['dates'][$i]];
                            // dd($meal_macros, $meal_micros);

                        @endphp
                        
                        <livewire:dashboard.food-item :meal_name="$meal_name" :meal_calories="$meal_calories" :meal_fats="$meal_fats" :meal_carbs="$meal_carbs" :meal_protein="$meal_protein" :meal_macros="$meal_macros" :meal_micros="$meal_micros" />


                        {{-- <div class="bg-slate-900 p-4 rounded-lg w-full h-fit flex flex-col gap-4">
                            <div class="bg-slate-800 w-full p-4 rounded-lg shadow-lg">
                                <p class="text-2xl text-center font-extrabold">{{$last_five_meals_array['names'][$last_five_meals_array['dates'][$i]]}}</p>

                            </div>

                            <div class="flex justify-between w-full [&>*]:bg-slate-800 gap-4 [&>*]:grow [&>*]:p-2 [&>*]:rounded-lg [&>*]:text-center">

                                    <p class="text-blue-500">Calories<br>{{$last_five_meals_array['calories'][$i]}}kcal</p>
                                    <p class="text-orange-500">Fat<br>{{$last_five_meals_array['fat'][$i]}}g</p>
                                    <p class="text-red-500">Carbs<br>{{$last_five_meals_array['carbs'][$i]}}g</p>
                                    <p class="text-green-500">Protein<br>{{$last_five_meals_array['protein'][$i]}}g</p>

                            </div>
                        </div> --}}

                    @endfor
                @else
                    No Meals Found. Log a meal to view this!
                @endisset
                </div>

            </div>


            <div class="col-start-1 col-end-4 row-start-4 row-end-5 flex flex-col sm:flex-row justify-between gap-2 [&>*]:rounded-lg ">
                

                @isset($last_meal_nutrients)
                <div class="bg-slate-800 w-full [&>*]:m-2 /border-2 /border-yellow-500 flex flex-col justify-around">
                    <h2 class="text-2xl font-extrabold italic text-center">Last Tracked Meal</h2>

                    <p class="text-2xl text-center">{{$last_meal_nutrients['meal_name']}}</p>

                    <div class="flex justify-around [&>*]:text-center">
                        <p class="text-blue-500">{{$last_meal_nutrients['calories']}}kcal<br><span class="text-black dark:text-white">Calories</span></p>

                        <p class="text-red-500">{{$last_meal_nutrients['fat']}}g<br><span class="text-black dark:text-white">Fat</span></p>

                        <p class="text-orange-500">{{$last_meal_nutrients['carbohydrates']}}g<br><span class="text-black dark:text-white">Carbs</span></p>

                        <p class="text-green-500">{{$last_meal_nutrients['protein']}}g<br><span class="text-black dark:text-white">Protein</span></p>
                    </div>
                </div>

                @else
                    
                    No Meals Tracked!<br>Start tracking your meals<a class="text-orange-300" href="{{route('meal.create')}}">here!</a>


                @endisset


                <div class="bg-slate-800 w-full [&>*]:m-2 /border-2 /border-blue-500 flex flex-col justify-between">
                    <h2 class="text-2xl font-extrabold italic text-center p-4">Last Logged Drink</h2>

                    <p class="text-xl text-center h-full grid items-center">

                        @isset($last_fluids_selected)
                            
                            @if($last_fluids_selected->fluid_id == 0) 

                            Water
                            
                            @elseif($last_fluids_selected->fluid_id == 1) 
                            
                            You have last drunk:
                            <span class="text-orange-800 font-extrabold">Coke</span> {{round($last_fluids_selected->amount / 2, 2)}}L
                            at {{date('d/m/Y H:i', strtotime($last_fluids_selected->time_taken))}}

                            @elseif($last_fluids_selected->fluid_id == 2) 

                            Milk

                            @elseif($last_fluids_selected->fluid_id == 3) 

                            Fruit
                            
                            @endif

                        @else 

                           No Fluids Tracked!<br><a class="text-blue-300" href="{{route('water.form')}}">Go track them here!</a>

                        @endisset
                    
                    </p>
                </div>

            </div>
            
            <div class="col-start-1 col-end-2 row-start-5 row-end-6 /border-4 /border-purple-300 rounded-lg"> <p class="flex items-center justify-center text-center w-full h-full bg-slate-800 rounded-lg shadow-2xl p-4">Slot 1</p></div>
            <div class="col-start-2 col-end-3 row-start-5 row-end-6 /border-4 /border-pink-300  rounded-lg"> <p class="flex items-center justify-center text-center w-full h-full bg-slate-800 rounded-lg shadow-2xl p-4">Slot 2</p></div>
            <div class="col-start-3 col-end-4 row-start-5 row-end-6 /border-4 /border-orange-300  rounded-lg"> <p class="flex items-center justify-center text-center w-full h-full bg-slate-800 rounded-lg shadow-2xl p-4">Slot 3</p></div>
          </div>
          
    </div>

   <script>

    // Chart.register(ChartDataLabels);

     let calorieCanvas = document.getElementById('MacroIntakeChart_container');

     calorieCanvas.scrollLeft = calorieCanvas.scrollWidth;
     
    //  function beforePrintHandler () {
    //     for (let id in Chart.instances) {
    //         Chart.instances[id].resize();
    //     }
    //  }

    //  window.addEventListener('beforeprint', () => {
    //      beforePrintHandler();
    //     });
   
    // window.addEventListener('afterprint', () => {
    //      beforePrintHandler();
    //     });

 

 

    //  var jmediaquery = window.matchMedia( "(min-width: 480px)" )
    //     if (jmediaquery.matches) {
    //         // window width is at least 480px
    //         beforePrintHandler();
    //     }
    //     else {
    //         // window width is less than 480px
            
    //         beforePrintHandler();
         
    //     }

 

   </script>
</x-app-layout>
