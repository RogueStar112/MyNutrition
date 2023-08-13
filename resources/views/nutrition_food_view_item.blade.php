<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center">
            {{ __('Nutrition - Food View Item') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        
        @isset($foods)

        <div class="max-w-7xl overflow-x-auto bg-gray-700 w-[600px] h-[1000px]">
            


        </div>
        @endisset

    </div>

    <script>

        
            
    </script>
</x-app-layout>
