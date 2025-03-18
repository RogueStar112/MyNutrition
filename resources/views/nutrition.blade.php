<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Main Menu') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-flow-row-dense grid-cols-1 md:grid-cols-3 md:grid-rows-1 gap-3 [&>*]:mx-2 md:[&>*]:mx-0">

                <!--
                Menu One: Logging
                1. Create new Foods
                2. Create new Meals
                3. Create new Exercise
                4. Body Stats
                -->


                {{-- <h2 class="text-6xl italic font-extrabold text-white col-span-3 md:col-span-6 m-4 pb-6 border-b-4 border-gray-500">Main Menu</h2> --}}

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2  duration-300 hover:bg-red-800 [&>*]:hover:text-black [&>*]:hover:border-b-black" href="{{route('food.create')}}">

                        <div class="flex justify-between text-red-600 dark:text-red-500 border-b-4 border-b-red-500 p-4 items-center">
                            <h2 class="text-4xl uppercase font-black">Food</h2>
                            <i class="fas fa-hotdog fa-3x"></i>
                        </div>
                        <p class="text-white p-4">Create new Food Items.</p>
                    </a>

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2  duration-300 hover:bg-orange-800 [&>*]:hover:text-black [&>*]:hover:border-b-black" href="{{route('meal.create')}}">
                        <div class="flex justify-between text-orange-600 dark:text-orange-500 border-b-4 border-b-orange-500 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Meal</h2>
                            <i class="fas fa-utensils fa-3x p-4"></i>
                        </div>
                        <p class="text-white p-4">Create new Meals with existing Food.</p>
                    </a>

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2  duration-300 hover:bg-yellow-800 [&>*]:hover:text-black [&>*]:hover:border-b-black" href="{{route('exercise.form')}}">

                        <div class="flex justify-between text-yellow-600 dark:text-yellow-800 dark:text-yellow-500 border-b-4 border-b-yellow-500 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Exercise</h2>
                            <i class="fas fa-shoe-prints -rotate-90 fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">Log your Exercises.</p>
                    </a>   

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2  duration-300 hover:bg-cyan-800 [&>*]:hover:text-black [&>*]:hover:border-b-black" href="{{route('body_stats.form')}}">

                        <div class="flex justify-between text-teal-600 dark:text-teal-500 border-b-4 border-b-teal-500 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Body</h2>
                            <i class="fas fa-weight fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">Weight, Height & Body Fat.</p>
                    </a>

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2 hover:bg-blue-800 [&>*]:hover:text-black [&>*]:hover:border-b-black duration-300" href="{{route('water.form')}}">

                        <div class="flex justify-between text-blue-500 border-b-4 border-b-blue-500 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Water</h2>
                            <i class="fas fa-tint fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">Log your Water Intake.</p>
                    </a>

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2 hover:bg-indigo-800 [&>*]:hover:text-black [&>*]:hover:border-b-black duration-300" href="{{route('sleep.form')}}">

                        <div class="flex justify-between text-indigo-500 border-b-4 border-b-indigo-500 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Sleep</h2>
                            <i class="fas fa-bed fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">Log your Sleep. (WIP)</p>
                    </a>
{{-- 
                <h2 class="text-6xl italic font-extrabold text-white m-4 pb-6 border-b-4 border-gray-500 w-full col-span-6">ACHIEVE</h2> --}}

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2 hover:bg-blue-600 [&>*]:hover:text-black [&>*]:hover:border-b-black duration-300" href="{{route('goals.form')}}">

                        <div class="flex justify-between text-blue-300 border-b-4 border-b-blue-300 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Goals</h2>
                            <i class="fas fa-bullseye fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">Set Macro and Sleep Goals. (Beta)</p>
                    </a>

                    
                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2 hover:bg-blue-700 [&>*]:hover:text-black [&>*]:hover:border-b-black duration-300" href="{{route('compare.form')}}">

                        <div class="flex justify-between text-purple-300 border-b-4 border-b-blue-300 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Compare</h2>
                            <i class="fas fa-balance-scale fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">Compare nutrition between certain foods! (Beta)</p>
                    </a>
                    {{-- <a href="col-span-3 slot-for-later"></a> --}}

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-2 hover:bg-orange-800 [&>*]:hover:text-black [&>*]:hover:border-b-black duration-300" href="{{route('visualizer.show')}}">

                        <div class="flex justify-between text-orange-300 border-b-4 border-b-orange-300 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Visualizer</h2>
                            <i class="fas fa-calendar fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">See how each day goes! (Beta)</p>
                    </a>

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-3  relative">

                        <p class="-rotate-12 text-4xl absolute left-1/2 top-1/4 text-white opacity-100 font-black -translate-x-1/2 translate-y-1/2 w-full text-center z-40">Coming Eventually</p>

                        <div class="flex justify-between text-yellow-500 border-b-4 border-b-yellow-500 opacity-80 blur-sm select-none items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Trophies</h2>
                            <i class="fas fa-trophy fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4 opacity-80 blur-sm select-none">See what achievements you can get.</p>
                    </a>

                {{-- <h2 class="text-6xl italic font-extrabold text-white m-4 pb-6 border-b-4 border-gray-500 w-full col-span-6">STATISTICS</h2> --}}

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-3 relative">

                        <p class="-rotate-12 text-4xl absolute left-1/2 top-1/4 text-white opacity-100 font-black -translate-x-1/2 translate-y-1/2  text-center w-full z-50">Coming Someday</p>
                        
                        <div class="flex justify-between text-orange-400 border-b-4 border-b-orange-400 items-center blur-sm">
                            <h2 class="text-4xl uppercase p-4 font-black">Dashboard</h2>
                            <i class="fas fa-calendar fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4 blur-sm">See how each day goes! (Beta)</p>
                    </a>

                    {{-- <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 md:col-span-3 hover:bg-orange-800 [&>*]:hover:text-black [&>*]:hover:border-b-black duration-300" href="{{route('visualizer.show')}}">

                        <div class="flex justify-between text-orange-300 border-b-4 border-b-orange-300 items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Visualizer</h2>
                            <i class="fas fa-calendar fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4">See how each day goes! (Beta)</p>
                    </a> --}}

                    <a class="text-2xl italic bg-zinc-600 dark:bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 /md:col-span-6 relative overflow-hidden">

                        <p class="-rotate-12 text-4xl absolute left-1/2 top-1/4 text-white opacity-100 font-black -translate-x-1/2 translate-y-1/2  text-center w-full">Coming Soon</p>

                        <div class="flex justify-between text-gray-300 border-b-4 border-b-gray-300 opacity-80 blur-sm select-none items-center">
                            <h2 class="text-4xl uppercase p-4 font-black">Settings</h2>
                            <i class="fas fa-cog fa-3x p-4"></i>
                        </div>

                        <p class="text-white p-4 opacity-80 blur-sm select-none">See how each day goes! (Beta)</p>
                    </a>
                {{-- <x-dashboard-link colspan="3" heading="Overview" textalign="center">
                    {{ __(Auth::user()->name . "'s nutrition") }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1" :href="route('food.create')" heading="Food" icon="fas fa-hotdog fa-3x text-orange-300">
                    {{ __('Create new food item.') }}
                </x-dashboard-link>
    
                <x-dashboard-link colspan="1" :href="route('meal.create')" heading="Meal" icon="fas fa-utensils fa-3x text-lime-300">
                    {{ __('Create meals with existing foods.') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1" :href="route('exercise.form')" heading="Exercise" icon="fas fa-shoe-prints fa-3x -rotate-90 text-yellow-300">
                    {{ __('Log your exercises. (WIP)') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1" heading="Body Stats" :href="route('body_stats.form')" icon="fas fa-weight fa-3x text-grey-300">
                    {{ __('Log your BMI, Weight & Height. (WIP)') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1" heading="Goals" icon="fas fa-solid fa-bullseye fa-3x text-grey-300">
                    {{ __('Set nutrition goals. (WIP)') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1" heading="Exercise Duration" icon="far fa-clock fa-3x text-grey-300">
                    {{ __('140 minutes') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1" heading="Today's Meals" icon="fas fa-hotdog fa-3x text-grey-300">
                    {{ __('Meal Deal, Chicken & Rice') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Water" icon="fas fa-tint fa-3x text-blue-300">
                    {{ __('Log water intake. (WIP)') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Preferences (WIP)" icon="fas fa-tint fa-3x text-blue-300">
                    {{ __('Any particular cuisines you fancy?') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Meal Suggester (WIP)" icon="fas fa-tint fa-3x text-red-300">
                    {{ __("Can't decide what to eat? Use this.") }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Visualizer" :href="route('visualizer.show')" icon="fas fa-calendar fa-3x text-red-300">
                    {{ __("BETA - Experimental Test.") }}
                </x-dashboard-link> --}}





                
                
                {{-- <div class="bg-white dark:bg-zinc-600 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg col-span-3">
                    
                </div> --}}
            </div>
            
        
            

        </div>
    </div>
</x-app-layout>
