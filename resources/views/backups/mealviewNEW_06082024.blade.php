<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold italic text-left uppercase dark:text-white text-3xl text-gray-800 leading-tight">
          {{ __('Nutrition - View Meals') }}
      </h2>
  </x-slot>

  {{-- <div class="flex py-4 justify-center">
  
  

  </div> --}}

  <div class="flex justify-between text-gray-400 font-extrabold max-w-7xl mx-auto text-3xl px-4 sm:px-6 lg:px-8">
      <p>DATE</p>
      <p>MACROS</p>
  </div>

  <div class="flex py-4 justify-evenly items-center w-full">
      <div class="flex flex-col md:flex-row justify-center w-full max-w-7xl">
          <div class="flex flex-col mx-auto [&>div]:mb-6">
              {{-- <div class="text-center text-white">Start Date</div> --}}
              {{-- {!! $calendar !!} --}}
              {{-- <div class="text-center text-white">End Date</div>
              {!! $calendar !!} --}}
          </div>

          <div class="w-full sm:px-6 lg:px-8">
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

                  
                      <div class="flex justify-between items-center">

                          <h2 class="text-md font-black text-orange-500">{{ "$dayOfWeek " .  date('jS F Y', strtotime($index)) }}</h2>
                          
                          
                          <div class="flex  justify-between w-[384px] nutrition-gap [&>*]:w-max">
                              <div class=" p-2 m-2 bg-gray-800 text-center">{{ $meal['calories'] }}kcal
                                  <br><p class="text-sm text-gray-400"></p></div>

                                  <div class=" p-2 m-2 bg-gray-800 text-center">{{ $meal['fat'] }}g
                                      <br><p class="text-sm text-gray-400"></p>
                                  </div>

                                  <div class=" p-2 m-2 bg-gray-800 text-center">{{ $meal['carbs'] }}g
                                      <br><p class="text-sm text-gray-400"></p>
                                  </div>
                                  
                                  <div class=" p-2 m-2 bg-gray-800 text-center">{{ $meal['protein'] }}g
                                      <br><p class="text-sm text-gray-400"></p>
                                  </div>
                              
                          </div>

                      </div>
                      @endforeach
                 
                  {{-- @endforeach  --}}


              @endisset
          </div>
      </div>
      
  </div>

  <script>

      
  </script>
</x-app-layout>
