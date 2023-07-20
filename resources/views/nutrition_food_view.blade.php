<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - Food View') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        
        @isset($foods)

        <div class="max-w-7xl">
        <table class="w-full table-auto text-white text-center rounded-lg">

        {{-- credit to: https://flowbite.com/docs/components/tables/ for table css --}}
        <thead class="rounded-lg">
            <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <th class="p-6">ID</th>
                <th class="p-6">Name</th>
                <th class="p-6">Serving Size</th>
                <th class="p-6">Calories</th>
                <th class="p-6">Fat</th>
                <th class="p-6">Carbohydrates</th>
                <th class="p-6">Protein</th>
                <th class="p-6">Action</th>
            </tr>
        </thead>


            <tbody>
                @foreach($foods as $index=>$food)


                    @if($index % 2 == 1)
                    <tr class="bg-white dark:bg-gray-900 border-gray-700">
                        <td class="px-6 py-4">{{$food['id']}}</td>
                        <td class="px-6 py-3">{{$food['name']}}</td>
                        @if($food['serving_size'] != NULL)
                            <td class="px-6 py-3">{{$food['serving_size']}}g</td>
                        @else
                            <td class="px-6 py-3 text-gray-500">N/A</td>
                        @endif
                        <td class="px-6 py-3">{{$food['calories']}}kcal</td>
                        <td class="px-6 py-3">{{$food['fat']}}g</td>
                        <td class="px-6 py-3">{{$food['carbohydrates']}}g</td>
                        <td class="px-6 py-3">{{$food['protein']}}g</td>
                        <td class="px-6 py-3">
                            <a class="p-4 bg-yellow-500" href="{{ route('food.edit', $food['id'])}}">Edit</a>
                        </td>
                    </tr>
                    @else
                    <tr class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <td class="px-6 py-4">{{$food['id']}}</td>
                        <td class="px-6 py-3">{{$food['name']}}</td>
                        @if($food['serving_size'] != NULL)
                            <td class="px-6 py-3">{{$food['serving_size']}}g</td>
                        @else
                            <td class="px-6 py-3 text-gray-500">N/A</td>
                        @endif
                        <td class="px-6 py-3">{{$food['calories']}}kcal</td>
                        <td class="px-6 py-3">{{$food['fat']}}g</td>
                        <td class="px-6 py-3">{{$food['carbohydrates']}}g</td>
                        <td class="px-6 py-3">{{$food['protein']}}g</td>
                        <td class="px-6 py-3">
                            <a class="p-4 bg-yellow-500" href="{{ route('food.edit', $food['id'])}}">Edit</a>
                        </td>

                    </tr>

                    @endif
                @endforeach
            </tbody>

        </table>
        </div>
        @endisset

    </div>

    <script>

            
    </script>
</x-app-layout>
