<x-app-layout>
  <x-slot name="header">
    <div class="flex flex-col gap-0 relative" aria-label="water-form-banner" style="/background: radial-gradient(closest-side, #0465A5, #334155);">

        <div class="relative w-full h-full overflow-hidden">

            <h1 class="font-semibold text-3xl md:text-6xl uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center md:text-left md:p-4 md:absolute top-1/2 z-50 bg-[#9a3412] md:-skew-y-6 md:w-[597px]" style="">
                {{-- {{ __('Log Water Intake') }} --}}
                Set <select id="drink-type" class="no-select-arrow text-4xl appearance-none dark:text-white text-gray-800 leading-tight p-4 top-1/2 z-50 bg-[#9a3412] border-none uppercase px-2 w-[190px] outline-0 focus:outline-0" style="-moz-appearance: none;">
                       <option selected value="1" text-value="macro">Macro</option>
                       <option value="2" text-value="micro">Micro</option>
                    </select> Goals
            </h1>


        <svg class="absolute top-4  collapse md:visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320 z-50">
            <path fill="#0465A5" fill-opacity="0.5" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>


        <div class="absolute collapse md:visible  bg-[#fed7aa] w-[128px] h-[128px] right-[53.5%] top-[79%] -skew-x-[24deg] z-20">
            
        </div>

        <div class="absolute collapse md:visible bg-[#9a3412] w-[384px] /h-[64px] h-[128px] top-[14rem] right-[24.41rem] -skew-x-[24deg] -skew-y-[10deg] z-10">
            
        </div>

        


        <svg class="hidden md:block md:relative shadow-2xl bottom-0 select-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#FFA500" fill-opacity="0.75" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
        </div>

        <i class="collapse md:visible fa-solid fa-bullseye fa-3x p-4 text-purple-300 scale-[1.5] -rotate-[30deg] absolute right-[20px] bottom-[5.5rem] translate-x-1/2 -translate-y-1/2"></i>
        
        <i class="collapse md:visible fa-solid fa-bullseye fa-3x p-4 text-green-300 scale-[2.4] -rotate-[30deg] absolute right-[128px] bottom-[128px] translate-x-1/2 -translate-y-1/2"></i>
    
        <i class="collapse md:visible fa-solid fa-bullseye fa-3x p-4 text-orange-100 scale-[3] -rotate-[30deg] absolute right-20 bottom-0 translate-x-1/2 -translate-y-1/2"></i>
    
    </div>
</x-slot>



  <form id="GOALS-FORM" method="POST" class="shadow-2xl max-w-[1216px] mx-auto relative" action="{{ route('water.store') }}">
    @csrf
      
      {{-- background: radial-gradient(closest-side, #0465A5, #334155); --}}
      <div class="" style="background: radial-gradient(closest-side, #9a3412, #334155);">

        <p class="text-center text-2xl text-white py-4 bg-gradient-to-r from-orange-800 to-orange-700">1. Select a goal type</p>




          <div class="grid md:grid-cols-2 gap-4 m-4">
            <!-- Tailored Option -->
            <label class="text-2xl italic bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 md:col-span-1 duration-300 hover:bg-red-800 [&>*]:hover:text-black [&>*]:hover:border-b-black grow focus-within:border-4 focus-within:border-red-700 cursor-pointer">
                <input type="radio" name="goal_type" value="tailored" class="hidden" />
                <div class="flex justify-between text-red-500 border-b-4 border-b-red-500 p-4 items-center">
                    <h2 class="text-4xl uppercase font-black">Tailored</h2>
                    <i class="fa-solid fa-person-running fa-3x"></i>
                </div>
                <p class="text-white p-4">Create simple and quick goals.</p>
            </label>
        
            <!-- Custom Option -->
            <label class="text-2xl italic bg-slate-800 p-4 rounded-lg shadow-2xl col-span-1 md:col-span-1 duration-300 hover:bg-blue-800 [&>*]:hover:text-black [&>*]:hover:border-b-black grow focus-within:border-4 focus-within:border-blue-700 cursor-pointer">
                <input type="radio" name="goal_type" value="custom" class="hidden" />
                <div class="flex justify-between text-blue-500 border-b-4 border-b-blue-500 p-4 items-center">
                    <h2 class="text-4xl uppercase font-black">Custom</h2>
                    <i class="fa-solid fa-palette fa-3x"></i>
                </div>
                <p class="text-white p-4">Create customized goals.</p>
            </label>
          </div>
          
          <div id="GOALS-TAILORED-FORM" class="text-white p-4">

            <p class="text-white text-left text-4xl italic mb-4 font-extrabold">TAILORED QUESTIONS</p>

            <div class="flex gap-4 place-items-center mb-4">
              <label for="exercise-activity-level"><span class="question_number text-4xl font-extrabold mb-4">1) </span>What is your Exercise Activity Level?</label>

              <select name="exercise-activity-level" id="exercise-activity-level" class="bg-slate-700 text-white">
                <option value="sedentary">None (0 Days)</option>
                <option value="lightly_active">Lightly active (1 - 2 Days)</option>
                <option value="moderately_active">Moderately active (3 - 4 Days)</option>
                <option value="very_active">Very active (5+ Days)</option>
              </select> 
            </div>

            

            <p>
              <span class="question_number text-4xl font-extrabold mb-4">2) </span>
              Here are your average macros based on the data you've inserted.<br>

              @isset($average_macros)
              Calorie: <span id="calorie-amount" class="ml-2 text-blue-500 text-3xl">{{$average_macros['calories']}}kcal</span><br>
              Fat: <span id="fat-amount" class="ml-2 text-orange-500 text-xl">{{$average_macros['fat']}}g</span><br>
              Carbs: <span id="carbs-amount" class="ml-2 text-red-500 text-xl">{{$average_macros['carbs']}}g</span><br>
              Protein: <span id="protein-amount" class="ml-2 text-green-500 text-xl">{{$average_macros['protein']}}g</span><br>
              @else

              Please create some meals first.

              @endisset
              

              Tick if you want More or Less of each Macro.<br>
              (the app will calculate an average based on your exercise and activity.)
            </p>


            <div class="flex justify-start items-center">
                <div class="w-full max-w-[960px] mx-auto grid grid-cols-6 gap-4 m-4">
                    <!-- Header Row for Labels -->
                    <div></div>
                    <div class="flex justify-center items-center text-white">Even Less</div>
                    <div class="flex justify-center items-center text-white">Less</div>
                    <div class="flex justify-center items-center text-white">Maintain</div>
                    <div class="flex justify-center items-center text-white">More</div>
                    <div class="flex justify-center items-center text-white">Even More</div>
            
                    <!-- Row for Calorie -->
                    <div class="flex justify-center items-center">
                        <span class="text-white">Calorie</span>
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="calorie" value="even-less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="calorie" value="less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="calorie" value="maintain">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="calorie" value="more">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="calorie" value="even-more">
                    </div>
            
                    <!-- Row for Fat -->
                    <div class="flex justify-center items-center">
                        <span class="text-white">Fat</span>

                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="fat" value="even-less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="fat" value="less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="fat" value="maintain">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="fat" value="more">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="fat" value="even-more">
                    </div>
            
                    <!-- Row for Carbs -->
                    <div class="flex justify-center items-center">
                        <span class="text-white">Carbs</span>
   
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="carbs" value="even-less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="carbs" value="less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="carbs" value="maintain">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="carbs" value="more">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="carbs" value="even-more">
                    </div>
            
                    <!-- Row for Protein -->
                    <div class="flex justify-center items-center">
                        <span class="text-white">Protein</span>

                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="protein" value="even-less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="protein" value="less">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="protein" value="maintain">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="protein" value="more">
                    </div>
            
                    <div class="flex justify-center items-center">
                        <input type="radio" name="protein" value="even-more">
                    </div>
                </div>
            </div>
            
            
          


          </div>

          <div id="GOALS-CUSTOM-FORM">



          </div>


          
          <div id="SUBMIT-BTN">

            <button type="submit" class="bg-green-500 text-white w-full text-center p-4">SUBMIT</button>

          </div>
      

      </div>
  </div>
  {{-- <div class="max-w-7xl mx-auto border-4 border-blue-500 p-24 dark:text-white relative my-6 mx-4 sm:px-6 lg:px-8">
      <div class="py-4 relative mx-auto max-w-3xl overflow-hidden">
          
          <p>For context, A glass of water is about 200ml.</p>

      </div>


      <form action="" class="text-white max-w-3xl flex gap-4 justify-between">

          <label for="water-time">
              Time drinking water:

              <input type="datetime-local" id="water-time" name="water-time" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="" value="" required/>
          
          </label>


          <label for="no-of-glasses">
              Number of glasses (max 12)

              <input type="number" id="no-of-glasses" name="no-of-glasses" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" min="0" max="12" placeholder="" value="" required/>
          
          </label>
          
          
          
      </form>

      <div class="flex justify-end">

          <button id="log-water-btn" class="bg-green-500 text-white px-6 mt-4 p-4">SUBMIT</button>



      </div>

      <form class="mt-4 flex flex-col gap-3"  id="WATER-LOG">

          <p class="text-3xl uppercase italic border-b-2 border-white">Water Log</p>

          

          
          
          
          

      </form>
  {{-- 
      <i class="fas fa-tint fa-3x p-4 text-blue-400 opacity-60 scale-[3] -rotate-[30deg] absolute right-20 bottom-0 translate-x-1/2 -translate-y-1/2"></i>
      --}}
  </form> 

  {{-- Stands for Cyclic Tracking --}}
  <section id="CT-CONTAINER" class="max-w-7xl mx-auto hidden" >
    <h2 class="font-semibold max-w-7xl mx-auto italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-left md:pt-6 md:px-4 sm:px-6 lg:px-8"">
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
