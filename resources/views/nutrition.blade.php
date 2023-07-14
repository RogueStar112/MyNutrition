<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition Main Menu') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 grid-rows-3 gap-3">
                <x-dashboard-item colspan="3" heading="Overview" textalign="center">
                    {{ __(Auth::user()->name . "'s nutrition") }}
                </x-dashboard-item>

                <x-dashboard-item colspan="1" heading="Food" icon="fas fa-hotdog fa-3x text-orange-300">
                    {{ __('Create new food item.') }}
                </x-dashboard-item>
    
                <x-dashboard-item colspan="1" heading="Meal" icon="fas fa-utensils fa-3x text-lime-300">
                    {{ __('Create meals with existing foods.') }}
                </x-dashboard-item>

                <x-dashboard-item colspan="1" heading="Exercise" icon="fas fa-shoe-prints fa-3x -rotate-90 text-yellow-300">
                    {{ __('Log your exercises. (WIP)') }}
                </x-dashboard-item>

                <x-dashboard-item colspan="1" heading="Body Stats" icon="fas fa-weight fa-3x text-grey-300">
                    {{ __('BMI, Weight & Height') }}
                </x-dashboard-item>

                {{-- <x-dashboard-item colspan="1" heading="Exercise Duration" icon="far fa-clock fa-3x text-grey-300">
                    {{ __('140 minutes') }}
                </x-dashboard-item> --}}

                {{-- <x-dashboard-item colspan="1" heading="Today's Meals" icon="fas fa-hotdog fa-3x text-grey-300">
                    {{ __('Meal Deal, Chicken & Rice') }}
                </x-dashboard-item> --}}

                <x-dashboard-item colspan="1" heading="Water" icon="fas fa-tint fa-3x text-blue-300">
                    {{ __('12 glasses') }}
                </x-dashboard-item>





                
                
                {{-- <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg col-span-3">
                    
                </div> --}}
            </div>
            
        
            

        </div>
    </div>
</x-app-layout>
