<x-app-layout>
  <x-slot name="header">
      <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight hidden sm:block">
          {{ __('Recipe Book') }}
      </h1>
  </x-slot>

   

  <form id="RECIPE-FORM" method="POST" class="w-screen h-screen max-w-7xl mx-auto bg-slate-700 text-white">
    
    
    <div class="max-w-3xl flex gap-6 pt-6 px-4 sm:px-6 lg:px-8 items-center">

      Step 1.

    </div>

    <div class="grid grid-cols-[1fr_4fr] gap-4 max-w-3xl px-4 sm:px-6 lg:px-8 items-center text-center">

      <p class="text-left">Recipe Name</p>
     
      <input type="text" class="bg-slate-800 text-gray-200 mt-1 rounded-md" placeholder="Spaghetti Carbonara"/>

      <p class="col-span-2 w-full border-t-2 text-left border-white pt-4">Step 2.</p>

      <p class="text-left">Search Ingredients</p>
     
      <input type="text" class="bg-slate-800 text-gray-200 mt-1 rounded-md" placeholder="Spaghetti" />


      <p class="text-left">Serving Size</p>
     
      <input type="text" class="bg-slate-800 text-gray-200 mt-1 rounded-md" placeholder="250" />

      <div></div>

      <div class="bg-green-600 w-full p-4 text-center rounded-lg">SEARCH</div>

      <h2 class="italic text-3xl col-span-2 text-left bg-slate-900 p-4 rounded-lg">Results returned:</h2>

      <div class="col-span-2 flex gap-3">

            <div class="flex gap-4 p-4 bg-slate-900 rounded-lg w-screen [&>*]:opacity-60" id="recipe-results-bar">
                <x-recipe-food-item index="1" name="Spaghetti" source="Tesco" servingSize="100" servingUnit="g" calories="157"
                fat="0.9" carbs="30.7" protein="5.8" />

                <x-recipe-food-item index="2" name="Spaghetti Bolognese" source="Tesco" servingSize="250" servingUnit="g" calories="254"
                fat="10" carbs="35.7" protein="9.8" />
            </div>

      </div>

      </div>
      


    </div>

</form>

</x-app-layout>
