<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic text-center uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition - View Meals') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        

    </div>

    <div class="flex py-4 justify-center">
        <div class="flex max-w-7xl">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @isset($meals)
                    
                        

                        @foreach($meals as $meal)
                        <div class="flex relative bg-gray-800 rounded-lg mt-3 justify-evenly place-items-center text-white">
                            
                            <div class="flex flex-col">
                            <p class="inline-block text-white pl-6 pt-6 pr-6 font-black text-2xl">{{$meal['meal_name']}}</p>
                            <p class="inline-block text-center pb-6">{{date('d/m/Y', strtotime($meal['meal_date']))}} {{$meal['time_planned']}}</p>
                            </div>
                            

                            <div class="calories">
                                <p class="inline-block text-white p-6 text-sm">{{$meal['calories']}}kcal</p>
                            </div>

                            <div class="calories">
                                <p class="inline-block text-white p-6 text-sm">{{$meal['fat']}}g</p>
                            </div>

                            <div class="calories">
                                <p class="inline-block text-white p-6 text-sm">{{$meal['carbs']}}g</p>
                            </div>

                            <div class="calories">
                                <p class="inline-block text-white p-6 text-sm">{{$meal['protein']}}g</p>
                            </div>



                        </div>

                        
                        <table class="w-full bg-gray-900">
                            
                            
                            <tbody>
                            @foreach(array_keys($meal) as $food) 
                                
                                @if(gettype($food) == 'integer') 
                                    
                                <tr class="text-white p-6 w-full">
                                    <td class="p-6">{{$meal[$food]['food_name']}}</td>
                                    <td>{{$meal[$food]['calories']}}kcal</td>
                                    <td>{{$meal[$food]['fat']}}g</td>
                                    <td>{{$meal[$food]['carbs']}}g</td>
                                    <td>{{$meal[$food]['protein']}}g</td>
                                </tr>


                                    {{-- @foreach($meal[$food] as $i=>$food_item)
                                        

                                        
                                        {{ $i . $food_item }}

                                    @endforeach --}}

                                @endif

                         

                            @endforeach
                            </tbody>

                        </table>
                        @endforeach
                        {{-- @php
                            $meals_index = array_keys($meals);
                            $meals_values = array_values($meals);

                            
                        @endphp

                        @foreach($meals_index as $index=>$date)
                            
                            {{ date('d/m/Y', strtotime($date)) }}
                            
                            @foreach($meals_values as $index=>$meal)
                                {{ $meal["2"] }}
                            @endforeach

                        @endforeach --}}

                        

     
                @endisset
            </div>
        </div>
        
    </div>

    <script>

        
    </script>
</x-app-layout>
