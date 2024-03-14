<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Visualizer - Beta') }}
        </h1>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-flow-row-dense mx-4 grid-cols-1 md:grid-cols-3 md:grid-rows-3 gap-3">
                {{-- <x-dashboard-link colspan="3" heading="Overview" textalign="center">
                    {{ __(Auth::user()->name . "'s nutrition") }}
                </x-dashboard-link> --}}

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

                {{-- <x-dashboard-link colspan="1" heading="Exercise Duration" icon="far fa-clock fa-3x text-grey-300">
                    {{ __('140 minutes') }}
                </x-dashboard-link> --}}

                {{-- <x-dashboard-link colspan="1" heading="Today's Meals" icon="fas fa-hotdog fa-3x text-grey-300">
                    {{ __('Meal Deal, Chicken & Rice') }}
                </x-dashboard-link> --}}

                <x-dashboard-link colspan="1.5" heading="Water" icon="fas fa-tint fa-3x text-blue-300">
                    {{ __('Log water intake. (WIP)') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Preferences (WIP)" icon="fas fa-tint fa-3x text-blue-300">
                    {{ __('Any particular cuisines you fancy?') }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Meal Suggester (WIP)" icon="fas fa-tint fa-3x text-red-300">
                    {{ __("Can't decide what to eat? Use this.") }}
                </x-dashboard-link>

                <x-dashboard-link colspan="1.5" heading="Visualizer" icon="fas fa-calendar fa-3x text-red-300">
                    {{ __("BETA - Experimental Test.") }}
                </x-dashboard-link>





                
                
                {{-- <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg col-span-3">
                    
                </div> --}}
            </div>
            
        
            

        </div>
    </div>
</x-app-layout>
