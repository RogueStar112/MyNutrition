<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-black dark:text-white text-3xl text-gray-800 leading-tight  text-center sm:text-left">
            {{ __('Dashboard') }}
        </h2>
        <p class="text-black dark:text-white text-center sm:text-left">Last 2 Weeks of Activity</p>
    </x-slot>

    <div class="min-h-screen max-w-7xl py-4 pt-6 px-4 sm:px-6 lg:px-8 /max-w-7xl mx-auto">
        <div class="flex flex-col sm:grid grid-cols-5 grid-rows-5 w-full h-full gap-2 /h-[calc(100vh-8rem)] /max-h-[900px] /[&>*]:flex  [&>*]:text-black dark:[&>*]:text-white">
            <div class="col-start-1 col-end-6 row-start-1 row-end-3 rounded-lg bg-slate-800 flex flex-col /border-2 /border-green-500">
                
                <p class="text-center mx-4 mt-2">Calorie Intake</p>
                    

         

                {{-- <p class="">You have averaged...</p>
                <p class="mx-4 mt-2 text-2xl font-black text-orange-300">{{round($avg_calories, 0)}}</p>

                <p></p> --}}
                
                <div class="m-4 rounded-lg">
                    <x-chartjs-component :chart="$chart" />
                </div>    

                       <div id="calories-avg" class="flex justify-center sm:flex-row sm:justify-evenly">

                    <div class="w-full text-center">
                    <p class="text-orange-200 mx-4 text-center">Average</p>


                    <span class="text-orange-300 text-2xl sm:text-4xl font-black mx-4">{{round($avg_calories, 0)}}kcal</span>
                    </div>


                    <div class="w-full text-center">
                    <p class="text-red-200 mx-4 text-center">Highest</p>


                    <span class="text-red-300 text-2xl sm:text-4xl font-black mx-4">{{round($highest_calories, 0)}}kcal</span>

                    </div>


                    <div class="w-full text-center">
                    
                        <p class="text-green-200 mx-4 text-center">Lowest</p>


                        <span class="text-green-300 text-2xl sm:text-4xl font-black mx-4">{{round($lowest_calories, 0)}}kcal</span>


                    </div>
                </div>

            


            </div>


            
            <div id="MacrosChart" class="col-start-1 col-end-4 row-start-3 row-end-4 /border-4 /border-blue-300 flex flex-col sm:flex-row justify-between [&>*]:w-full [&>*]:h-full [&>*]:bg-slate-800 [&>*]:p-4 [&>*]:rounded-lg [&>*]:shadow-2xl gap-4">
                
                <div class="">
                    <x-chartjs-component :chart="$fat_chart" />
                </div>
                <div class="">
                    <x-chartjs-component :chart="$carbs_chart" />
                </div>
                <div class="">
                    <x-chartjs-component :chart="$protein_chart" />
                </div>
                
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
    var MacroIntakeChart = new Chart(document.getElementById("MacroIntakeChart"), {
        type: "line",
        data: { ... },
        options: { ... }
    });
    // Make sure the chart is already initialized
    const ctx = MacroIntakeChart.ctx;
    const chartArea = MacroIntakeChart.chartArea;

    if (chartArea) {
        const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
        gradient.addColorStop(0, 'rgba(75,192,192,0.8)');
        gradient.addColorStop(1, 'rgba(75,192,192,0)');

        // Apply to dataset(s) — here only the first dataset
        MacroIntakeChart.data.datasets[0].backgroundColor = gradient;

        // Update chart
        MacroIntakeChart.update();
        
        console.log('THIS ALSO WORKS MUPPET')
    }
    </script>
</x-app-layout>