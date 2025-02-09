<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight hidden sm:block">
          {{ __('Recipe Book') }}
      </h1>
  </x-slot>

   

  <div class="w-screen h-screen max-w-7xl mx-auto bg-slate-700 text-white">
    
    <div class="flex gap-6">


      <h2 class="pt-6 px-4 sm:px-6 lg:px-8">ADD Core Ingredients</h2>
     
      <input type="text" class="block bg-slate-800 text-gray-200 w-full mt-1 rounded-md" />


    </div>

  </div>

</x-app-layout>
