<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold  text-center italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
          {{ __('Exercise Main Menu') }}
      </h1>
  </x-slot>

  <div class="py-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
        

        

        <div class="max-w-3xl px-24 border-4 text-white border-yellow-400 bg-gray-800 [&>*]:mt-4 h-[512px]">


            
            <div class="w-full">
                <label for="exercise-time" class="text-white"><p class="font-bold text-xl text-center">Exercise time</p>

                    <input type="datetime-local" name="exercise-time" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="Big Breakfast, Spaghetti Carbonara, BLT Sandwich" value="" required/>
                </label>
            </div>

          <div class="flex justify-between items-center">
            <label for="exercise-type">Exercise type</label>
            
            
            <select class="rounded-full p-3 bg-slate-700 text-gray-200 w-[240px]" name="exercise-type" id="exercise-type">

                <option value="walk" selected>walk</option>
                <option value="run">run</option>
                <option value="cycle">cycle</option>

            </select>
        </div>


          <div class="flex justify-between">
          
          <label for="exercise-distance">Distance</label>
          <input type="text" name="exercise-distance" class="bg-slate-700 text-gray-200" />
          
        </div>

        <div class="flex justify-between">

          <label for="exercise-duration">Duration</label>
          <input type="text" name="exercise-duration" class="bg-slate-700 text-gray-200" />

        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-500 text-white p-4">SUBMIT</button>
        </div>

        

          


          

      </div>
  </div>
</x-app-layout>
