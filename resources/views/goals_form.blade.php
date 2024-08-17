<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold max-w-7xl mx-auto text-left italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
          {{ __('Goals') }}
      </h1>
  </x-slot>

  {{-- Stands for Cyclic Tracking --}}
  <section id="CT-CONTAINER" class="max-w-7xl mx-auto" >
    <h2 class="font-semibold max-w-7xl mx-auto italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-left pt-6 px-4 sm:px-6 lg:px-8"">
      {{ __('Weekly Cyclic Macro Tracking') }}
    </h2>


    <section id="CT-CANVAS" class="max-w-7xl mx-auto h-64 bg-slate-900 mt-4 flex gap-3 [&>div]:bg-blue-600 [&>div]:w-full [&>div]:mt-6 [&>div]:mx-6  [&>div>p]:text-white [&>div>p]:text-center [&>div]:flex [&>div]:items-end [&>div]:justify-center px-4">

      @php
                              
                                    $dotw = array_fill(0, 7, "");

                        //  $curve_distrib = [];

                  @endphp

      @foreach($dotw as $index=>$day)

        {{-- @php
          $curve_distrib[] = $day;
        @endphp --}}

      @endforeach

      {{-- @php
      $curve_distrib_sort = sort($curve_distrib);
      @endphp

      <p>{{$curve_distrib_sort}}</p> --}}

      @foreach($dotw as $index=>$day)

       @php
            $dayOfWeekNumber = date("w", strtotime($index))+$index;
            $dayOfWeekPercDisplay = date("w", strtotime($index))+$index;

            if ($dayOfWeekNumber > 6) {
              $dayOfWeekNumber = $dayOfWeekNumber%7;
              $dayOfWeekPercDisplay = $dayOfWeekNumber%7;
              
            }
            
            switch($dayOfWeekNumber)
                {
            case 0 : $dayOfWeek = "Sun"; break;
            case 1 : $dayOfWeek = "Mon"; break;
            case 2 : $dayOfWeek = "Tue"; break;
            case 3 : $dayOfWeek = "Wed"; break;
            case 4 : $dayOfWeek = "Thu"; break;
            case 5 : $dayOfWeek = "Fri"; break;
            case 6 : $dayOfWeek = "Sat"; break;
                }
       @endphp
      
      <div class="relative" style="">
        <p></p>
        

        <div class="bg-orange-600 w-full" style="height:{{14.28*(($dayOfWeekPercDisplay+1))}}%;">
          <p class="dayoftheweek text-white text-center">{{$dayOfWeek}}</p>
        </div>
      </div>

      @endforeach
    </section>


  </section>



<script>
  
  // $('#exercise-type').on('change', function() {


  //   if( $('#exercise-type').val() == 'walk' ) {

  //     $('#exercise-type-icon').text('🚶');

  //   } 

  //   if( $('#exercise-type').val() == 'run' ) {

  //     $('#exercise-type-icon').text('🏃');

  //   } 

  //   if( $('#exercise-type').val() == 'cycle' ) {

  //     $('#exercise-type-icon').text('🚴');

  //   } 

  // })

</script>

</x-app-layout>
