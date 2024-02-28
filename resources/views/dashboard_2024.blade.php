<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-flow-row-dense mx-4 grid-cols-1 md:grid-cols-3 md:grid-rows-3 gap-3">
              
              
              @foreach ($meal_items as $date => $food_items)
                <h2>Meal entries for {{ $date }}</h2>

                @foreach ($food_items as $key => $food_item)
                    @if ($key == "total") 
                        <h3>Total Nutrients:</h3>
                    @else 
                        <h3>Item {{ $key }}:</h3>
                    @endif

                    <ul>
                        @foreach ($food_item as $nutrient => $value)
                            <li>{{ $nutrient }}: {{ $value }}</li>
                        @endforeach
                    </ul> 
                @endforeach
            @endforeach
 
            </div>
            
        
            

        </div>
    </div>
</x-app-layout>
