<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
          {{ __('Changelog') }}
      </h1>
  </x-slot>

   

  <div class="w-screen h-screen max-w-7xl mx-auto text-white mt-8 pt-6 px-4 sm:px-6 lg:px-8 bg-slate-700 flex flex-col gap-4">

    <div class="bg-slate-800 p-4 rounded-lg">
      <h2 class="text-2xl font-extrabold">Patch Notes 2025.03_01</h2>

      
      <p class="text-gray-400">08/03/2025 - Present</p>
      
      <p class="text-green-500 text-2xl font-extrabold mt-4">ADDED:  
        
      </p>
      
      <p>+ New Front Facing Page. Work in progress!</p>

    </div>


    <div class="bg-slate-800 p-4 rounded-lg">
      <h2 class="text-2xl font-extrabold">Patch Notes 2025.03</h2>

      
      <p class="text-gray-400">01/03/2025 - 07/03/2025</p>
      
      <p class="text-green-500 text-2xl font-extrabold mt-4">ADDED:  
        
      </p>
      
      <p>+ Added ChartJS stats on Dashboard. WIP.</p>

      <p class="text-fuchsia-500 text-2xl font-extrabold mt-4">QUALITY OF LIFE:</p>

      <p>+ Working on Dashboard Stats.</p>

      <p class="text-purple-500 text-2xl font-extrabold mt-4">WORKING ON: </p>

      <p>+ Aforementioned on 2025.02_02.</p>
    </div>

    <div class="bg-slate-800 p-4 rounded-lg">
      <h2 class="text-2xl font-extrabold">Patch Notes 2025.02_02</h2>

      
      <p class="text-gray-400">17/02/2025 - 01/03/2025</p>
      
      <p class="text-green-500 text-2xl font-extrabold mt-4">ADDED: 

        <p class="text-2xl">+ Meal Notifications. <span class="text-xl">Can now plan meals in advance, allowing them to accept/reject/edit meals at a given time. <span class="font-extrabold text-yellow-500"><br>This will become a paid feature in the distant future.</span> </span></p>
      </p>

      <p class="text-fuchsia-500 text-2xl font-extrabold mt-4">QUALITY OF LIFE:</p>

      <p>+ AI Auto Fill now has a custom loading animation when being used.</p>

      <p>+ AI Auto Fill now disables the description box and replaces the text with 'Generated using AI Auto Fill.' This is critical to avoid confusion.</p>

      <p>+ Made Desktop Notifications a LOT better looking.</p>

      <p class="text-purple-500 text-2xl font-extrabold mt-4">WORKING ON: </p>

      <p>+ Allowing Meal Editing.</p>
      <p>+ Profanity Filter Adjustments. Words like Mustard, Coke, and Assassin (spaghetti all'assassina) are considered inappropriate thus need to be made exceptions.</p>
      <p>+ Adding meal deletion confirmation buttons.</p>
    </div>
    
    <div class="bg-slate-800 p-4 rounded-lg">
      <h2 class="text-2xl font-extrabold">Patch Notes 2025.02_01a</h2>
      <p class="text-gray-400">12/02/2025 - 16/02/2025</p>
      

      <p class="text-yellow-500 text-2xl font-extrabold mt-4">BUG FIXES: </p>

      <p>+ Fixed Food Item UI.</p>
      
      <p>+ Can now use AI Autofill across multiple Food Pages. </p>

      <p>+ AI Autofill can now take into consideration different unit types, not just grams.</p>

      <p>+ AI Autofill can now take into consideration food sources e.g. Pepperoni Pizza from Tesco</p>

      <p class="text-purple-500 text-2xl font-extrabold mt-4">WORKING ON: </p>

      <p class="line-through">+ Advanced Recipe Form.</p> <span>Postponed.</span>
    </div>


    <div class="bg-slate-800 p-4 rounded-lg">
    <h2 class="text-2xl font-extrabold">Patch Notes 2025.02_01</h2>
    <p class="text-gray-400">09/02/2025 - 11/02/2025</p>
    <br>
    
      <p class="text-green-500 text-2xl font-extrabold">ADDED: </p>

      <ul class="">
        <li class="text-xl ml-4">+ AI Autofill:
          <span class="text-lg">Fill in nutritional information in the 'Add Food' page with a given name and serving size.<br>For example, Pepperoni Pizza (100g) will return the calories, macros, and micros using ChatGPT 3.5 Turbo. <br></span><span class="font-extrabold text-red-300 ml-4">DISCLAIMER: </span><span class="text-gray-400 text-md">Information pulled from the AI may be inaccurate. Use with consideration to knowledge of food nutrition. For example, Bread typically contains mostly carbohydrates, Cheese mostly fat and protein etc.</span><span class="font-extrabold text-yellow-500"><br>This will become a paid feature in the distant future.</span> </span>

        </li>

        <li class="text-xl ml-4">+ Profanity Filter.</li>
        <li></li>
        <li></li>
      </ul>

      <p class="text-yellow-500 text-2xl font-extrabold mt-4">BUG FIXES: </p>

      <p>+ Fixed meals not showing to their respective users.</p>

      <p class="text-purple-500 text-2xl font-extrabold mt-4">WORKING ON: </p>

      <p>+ Fixing a decimal bug regarding serving sizes on the database.</p>

      <p>+ Working on adding a profanity filter. (Added as of 10/02/2025.)</p>
    </div>
    

  </div>

</x-app-layout>
