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

                @php
                $dates_to_search = [];
                @endphp

                    @foreach(array_keys($meals[0]) as $meal_date)

                        @php
                            array_push($dates_to_search, $meal_date);
                        @endphp

                    @endforeach

                    
                            
                    {{-- @foreach($dates_to_search as $date) --}}

                        {{-- {{ $date }} --}}

                   
                        @foreach($meals[0] as $index=>$meal)
                        <div class="max-w-7xl bg-gray-800 p-6 text-white rounded-lg my-4">
                            <table class="border-separate border-spacing-y-1.5 bg-gray-900 p-6 m-2 w-[600px] place-items-center text-center">

                                @php
                                    $dayOfWeekNumber = date("w", strtotime($index));

                                    switch($dayOfWeekNumber)
                                        {
                                    case 0 : $dayOfWeek = "Sunday"; break;
                                    case 1 : $dayOfWeek = "Monday"; break;
                                    case 2 : $dayOfWeek = "Tuesday"; break;
                                    case 3 : $dayOfWeek = "Wednesday"; break;
                                    case 4 : $dayOfWeek = "Thursday"; break;
                                    case 5 : $dayOfWeek = "Friday"; break;
                                    case 6 : $dayOfWeek = "Saturday"; break;
                                        }

                                @endphp

                                <div class="w-full text-center">
                                <h1 class="text-md font-black text-orange-500">{{ "$dayOfWeek " .  date('jS F Y', strtotime($index)) }}</h1>
                                </div>

                                <thead>
                                    <tr class="uppercase text-gray-500">
                                        <th>Time</th>
                                        <th>Calories</th>
                                        <th>Fat</th>
                                        <th>Carbs</th>
                                        <th>Protein</th>
                                    </tr>
                                </thead>

                                {{-- <div class="text-center">Day Breakdown</div> --}}
                                <tbody>

                                @foreach($meal['times_planned'] as $meal_time)
                                
                                <tr class="m-4">
                                    <td class="bg-orange-800 text-xl w-[170px]" colspan="1">{{ date('H:i', strtotime($meal_time)) }}</td>
                                    <td class="bg-orange-900" colspan="4">{{ $meal[$meal_time]['meal_name'] }}</td>
                                </tr>

                                @foreach(array_keys($meal[$meal_time]) as $food_item) 
                                
                                



                         
                                    @if(gettype($food_item) == 'integer') 
                                    <tr class="text-gray-500">
                                        @php
                                            
                                            $meal_foodname = str_replace(" ", "_", $meal[$meal_time][$food_item]['food_name']);
                                            $meal_foodname_display = $meal[$meal_time][$food_item]['food_name'];

                                        @endphp
                                        <td><a class="text-orange-500" href="{{ route('food.view_item', ['user_id'=>$user_id, 'name'=>$meal_foodname])}}">{{$meal_foodname_display}}</a></td>
                                        <td>{{$meal[$meal_time][$food_item]['calories']}}kcal</td>
                                        <td>{{$meal[$meal_time][$food_item]['fat']}}g</td>
                                        <td>{{$meal[$meal_time][$food_item]['carbs']}}g</td>
                                        <td>{{$meal[$meal_time][$food_item]['protein']}}g</td>
                                    </tr>
                                    @endif
              
                                @endforeach
                                
                                

                                <tr class="text-xl">
                                    <td></td>
                                    {{-- <td> Meal #{{$loop->iteration}} Total </td> --}}
                                    {{-- <td class="uppercase text-gray-500 text-sm bg-gray-700 p-2 m-2 rounded-full"><a class="bg-gray-800 p-2 m-2 rounded-full">
                                        <i class="fas fa-pencil-alt text-yellow-500"></i>
                                        </a>

                                        <a class="bg-gray-800 p-2 m-2 rounded-full">
                                            <i class="fas fa-trash-alt text-red-500"></i>
                                        </a>
                                        <br><p class="invisible">_</p> 
                                    </td> --}}
                   
                                    <td>{{ $meal[$meal_time]['calories'] }}kcal</td>
                                    <td>{{ $meal[$meal_time]['fat'] }}g</td>
                                    <td>{{ $meal[$meal_time]['carbs'] }}g</td>
                                    <td class=>{{ $meal[$meal_time]['protein'] }}g</td>
                                </tr>

                                <tr>
                                    <td colspan="5"></td>
                                </tr>
                                
                                
                                {{-- <div class="flex w-full justify-center place-items-center">
                                
                                    <div class="flex-auto text-center w-[64px]">
                                    <p class="p-2 m-2"> {{ date('H:i', strtotime($meal_time)) }} </p>
                                    </div>

                                    <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{ $meal[$meal_time]['calories'] }}kcal
                                        <br><p class="text-sm text-gray-400"></p></div>

                                        <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{ $meal[$meal_time]['fat'] }}g
                                            <br><p class="text-sm text-gray-400"></p>
                                        </div>

                                        <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{ $meal[$meal_time]['carbs'] }}g
                                            <br><p class="text-sm text-gray-400"></p>
                                        </div>
                                        <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{ $meal[$meal_time]['protein'] }}g
                                            <br><p class="text-sm text-gray-400"></p>
                                        </div>
                                    </div>
                                </div> --}}
  
                                    {{-- @foreach($meal["$meal_time"] as $food_item)

                                        {{ $meal["$food_item"]['food_name'] }}

                                    @endforeach --}}

                                @endforeach
                 
                                {{-- {{$meal['calories']}} --}}

                                {{-- {{$meal[$date]['calories']}} --}}

                                
                                {{-- @if($loop->last) border-b-white border-transparent border-4 @endif --}}
                          
                            </tr>

                            <tr class="m-3 place-items-center border-t-white border-transparent border-4 text-xl">
                                <td class="border-t-white border-t-2 p-2 mt-2 text-2xl">TOTAL</td>

                                <td class="border-t-white border-t-2 flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['calories']}}kcal</td>
                                                                {{-- <br><p class="text-sm text-gray-400">CALORIES</p></td> --}}
                                <td class="border-t-white border-t-2 flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['fat']}}g
                                    {{-- <br><p class="text-sm text-gray-400">FAT</p> --}}
                                </td>
                                <td class="border-t-white border-t-2 flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['carbs']}}g
                                    {{-- <br><p class="text-sm text-gray-400">CARBS</p> --}}
                                </td>
                                <td class="border-t-white border-t-2 flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['protein']}}g
                                    {{-- <br><p class="text-sm text-gray-400">PROTEIN</p> --}}
                                </td>
                            </tr>

                            {{-- <tr>
                                <td></td>
                                <td colspan="4">TOTAL</td>
                            </tr>
                             --}}
                        </tbody>
                         </table>
                        </div>
                        @endforeach
                   
                    {{-- @endforeach  --}}


                @endisset
            </div>
       
        
    </div>

    <script>

        
    </script>
</x-app-layout>
