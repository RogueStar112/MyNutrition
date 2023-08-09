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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @isset($meals)
                    
                        

                        @foreach($meals as $meal)
                        <div class="flex relative bg-gray-800 rounded-t-lg mt-3 justify-evenly place-items-center text-white">
                            
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

                        
                        <table class="w-full bg-gray-900 justify-evenly place-items-center">
                            
                            
                            <tbody>
                            @foreach(array_keys($meal) as $food) 
                                
                            

                                @if(gettype($food) == 'integer') 
                                    
                                
                                <tr class="flex justify-around place-items-center text-white p-6 w-full @if($loop->last) border-4 border-transparent border-b-red-400 rounded-b-lg @endif">
                                    <td class="inline-block w-[198px]">{{$meal[$food]['food_name']}}</td>
                                    <td class="w-fit">{{$meal[$food]['calories']}}kcal</td>
                                    <td class="w-fit">{{$meal[$food]['fat']}}g</td>
                                    <td class="w-fit">{{$meal[$food]['carbs']}}g</td>
                                    <td class="w-fit">{{$meal[$food]['protein']}}g</td>
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
