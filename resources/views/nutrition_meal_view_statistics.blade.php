<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - View Meals') }}
        </h2>
    </x-slot>

    {{-- <div class="flex py-4 justify-center">
        

    </div> --}}

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-white">
                
                @foreach($meals as $meal)

                        {{$meal}}<br>

                @endforeach

            </div>
        
        </div>

    </div>

    <script>

        
    </script>
</x-app-layout>
