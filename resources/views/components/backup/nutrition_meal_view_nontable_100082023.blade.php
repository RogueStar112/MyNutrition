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

                    <div class="max-w-7xl bg-gray-800 p-6 text-white rounded-lg">
                            
                    {{-- @foreach($dates_to_search as $date) --}}

                        {{-- {{ $date }} --}}

                   
                        @foreach($meals[0] as $index=>$meal)
                            <div class="bg-gray-900 p-6 m-2 w-[600px] place-items-center">

                                <div class="w-full text-center">
                                <h1 class="text-md font-black">{{ date('jS F Y', strtotime($index)) }}</h1>
                                </div>

                                {{-- <div class="text-center">Day Breakdown</div> --}}
                                @foreach($meal['times_planned'] as $meal_time)
                                
                                <div class="flex w-full justify-center place-items-center">
                                
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
  
                                    {{-- @foreach($meal["$meal_time"] as $food_item)

                                        {{ $meal["$food_item"]['food_name'] }}

                                    @endforeach --}}

                                @endforeach
                                {{-- {{$meal['calories']}} --}}

                                {{-- {{$meal[$date]['calories']}} --}}

                                
                                {{-- @if($loop->last) border-b-white border-transparent border-4 @endif --}}
                                <div class="flex w-full justify-center place-items-center border-t-white border-transparent border-4">
                                    <p class="p-2 m-2"> TOTAL </p>

                                    <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['calories']}}kcal
                                                                    <br><p class="text-sm text-gray-400">CALORIES</p></div>
                                    <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['fat']}}g
                                        <br><p class="text-sm text-gray-400">FAT</p>
                                    </div>
                                    <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['carbs']}}g
                                        <br><p class="text-sm text-gray-400">CARBS</p>
                                    </div>
                                    <div class="flex-auto p-2 m-2 bg-gray-800 text-center">{{$meal['protein']}}g
                                        <br><p class="text-sm text-gray-400">PROTEIN</p>
                                    </div>
                                </div>
                            </div>

                            

                        @endforeach
                   
                    {{-- @endforeach  --}}

                    </div>

                @endisset
            </div>
        </div>
        
    </div>

    <script>

        
    </script>
</x-app-layout>
