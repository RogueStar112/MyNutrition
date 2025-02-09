<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
          {{ __('Changelog') }}
      </h1>
  </x-slot>

   

  <div class="w-screen h-screen max-w-7xl mx-auto text-white mt-8 pt-6 px-4 sm:px-6 lg:px-8 bg-slate-700">
    
    <div class="bg-slate-800 p-4 rounded-lg">
    <h2 class="text-2xl font-extrabold">Patch Notes 2025.02_01</h2>
    <p class="text-gray-400">09/02/2025</p>
    <br>
    
      <p class="text-green-500 text-2xl font-extrabold">ADDED: </p>

      <ul class="">
        <li class="text-xl ml-4">+ AI Autofill:
          <span class="text-lg">Fill in nutritional information in the 'Add Food' page with a given name and serving size.<br>For example, Pepperoni Pizza (100g) will return the calories, macros, and micros using ChatGPT 3.5 Turbo. <br></span><span class="font-extrabold text-red-300 ml-4">DISCLAIMER: </span><span class="text-gray-400 text-md">Information pulled from the AI may be inaccurate. Use with consideration to knowledge of food nutrition. For example, Bread typically contains mostly carbohydrates, Cheese mostly fat and protein etc.</span>

        </li>

        <li class="text-xl ml-4">+ </li>
        <li></li>
        <li></li>
      </ul>

      <p class="text-yellow-500 text-2xl font-extrabold mt-4">BUG FIXES: </p>

      <p>+ Fixed meals not showing to their respective users.</p>

      <p class="text-purple-500 text-2xl font-extrabold mt-4">WORKING ON: </p>

      <p>+ Fixing a decimal bug regarding serving sizes on the database.</p>
    </div>
    

  </div>

</x-app-layout>
