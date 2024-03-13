<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold  text-center italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
          {{ __('Exercise Main Menu') }}
      </h1>
  </x-slot>

  <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
        

        

        <div class="max-w-3xl px-24 border-4 text-white border-yellow-400 bg-gray-800 [&>*]:my-4">

            <div class="w-full text-center">
                <h2 class="text-3xl">Log your exercise</h2>
                <p class="text-slate-500">Step 1: When, what, how far, and how long</p>
            </div>
            
            <div class="w-full flex justify-between items-center">
                <label for="exercise-time" class="text-white">Exercise time</label>

                <input type="datetime-local" name="exercise-time" class="block bg-slate-700 text-gray-200 w-[240px] mt-1  rounded-full" placeholder="Big Breakfast, Spaghetti Carbonara, BLT Sandwich" value="" required/>
        
            </div>

          <div class="flex justify-between items-center">
            <label for="exercise-type">Exercise type</label>
            
            <div class="relative flex">

              <p id="exercise-type-icon" class="absolute w-[36px] h-[36px] m-2 pt-1 rounded-full bg-slate-900 z-30 select-none border-2 border-orange-400">🚶</p>
                
              <select class="relative pl-14 rounded-full p-3 bg-slate-700 text-gray-200 w-[240px]" name="exercise-type" id="exercise-type">

              

                  <option value="walk" selected>walk</option>
                  <option value="run">run</option>
                  <option value="cycle">cycle</option>

              </select>

            </div>
        </div>


        <div class="flex justify-between relative">
          
          <label for="exercise-distance">Distance</label>
          <input type="text" name="exercise-distance" class="bg-slate-700 text-gray-200 rounded-full" />

          <select class="absolute right-0 rounded-r-full mt-1/2 border-l-2 border-slate-500 bg-slate-700 text-gray-200 border-r-0 border-t-0 border-b-0 pr-6 w-[113px]" name="exercise-distance-unit" id="exercise-distance-unit">
                <option id="exercise-unit-kilometres" value="kms">kms</option>
                <option id="exercise-unit-miles" value="miles">miles</option>
          </select>

        </div>

        <div class="flex justify-between relative">

          <label for="exercise-duration">Duration</label>
          <input type="text" name="exercise-duration" class="bg-slate-700 text-gray-200 rounded-full" />

          <select class="absolute right-0 rounded-r-full mt-1/2 border-l-2 border-slate-500 bg-slate-700 text-gray-200 border-r-0 border-t-0 border-b-0 pr-6 w-[113px]" name="exercise-duration-unit" id="exercise-duration-unit">
                <option id="exercise-unit-minutes" value="mins">minutes</option>
          </select>
        </div>


        


        <div aria-label="HORIZONTAL-LINE" class="border-b-2 border-white"></div>


        
        <div class="w-full text-center">
            <p class="text-slate-500">Step 2: If you know your workout stats, put them here!</p>


            <div class="grid grid-cols-3 gap-4 [&>*]:rounded-full [&>*]:bg-slate-700 [&>*]:text-gray-200 [&>*]:p-2 [&>*]:mt-2">

              <input name="active-calories" placeholder="Active calories">
              
              <input name="total-calories" placeholder="Total calories">

              <input name="avg-heart-rate" placeholder="Average heart rate">

              <input name="active-calories" placeholder="Active calories">

            </div>


        </div>


        
        <div aria-label="HORIZONTAL-LINE" class="border-b-2 border-white"></div>

      


        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white p-4">SUBMIT</button>
        </div>

        

          


          

      </div>
  </div>

<script>

  $('#exercise-type').on('change', function() {


    if( $('#exercise-type').val() == 'walk' ) {

      $('#exercise-type-icon').text('🚶');

    } 

    if( $('#exercise-type').val() == 'run' ) {

      $('#exercise-type-icon').text('🏃');

    } 

    if( $('#exercise-type').val() == 'cycle' ) {

      $('#exercise-type-icon').text('🚴');

    } 

  })

</script>

</x-app-layout>
