<div class="bg-slate-900 w-full h-fit text-center rounded-lg shadow-2xl">


    <div class="flex items-center justify-between px-6">
       {{$meal_name}}

       <div class="text-blue-500">{{$meal_calories}}kcal</div>
       <button wire:click="toggle_meal_items" class="text-5xl cursor-pointer">
        {{ $show_meal_items ? '-' : '+' }} 
        

       </button>
    </div>

    @if($show_meal_items)
    <div class="flex flex-col [&>*]:odd:bg-slate-600 [&>*]:even:bg-slate-700">
        
        
        @for($i = 0; $i < count($meal_macros); $i++) 
        <div class="grid grid-cols-5 px-4 items-center">
            @if($i == 0)
                <div class="uppercase">Name</div>
                <div class="uppercase">Calories</div>
                <div class="uppercase">Fat</div>
                <div class="uppercase">Carbs</div>
                <div class="uppercase">Protein</div>
            @endif

            <div class="grow text-sm">{{$meal_macros[$i]->name}}</div>
            <div class="text-sm">{{$meal_macros[$i]->calories}}</div>
            <div class="text-sm">{{$meal_macros[$i]->fat}}</div>
            <div class="text-sm">{{$meal_macros[$i]->carbohydrates}}</div>
            <div class="text-sm">{{$meal_macros[$i]->protein}}</div>
        </div>
        @endfor

        <div class="flex justify-between w-full [&>*]:bg-slate-900 [&>*]:grow [&>*]:p-2 [&>*]:text-center rounded-b-lg">

            <p class="text-blue-500">Calories<br>{{$meal_calories}}</p>
            <p class="text-orange-500">Fat<br>{{$meal_fats}}g</p>
            <p class="text-red-500">Carbs<br>{{$meal_carbs}}g</p>
            <p class="text-green-500">Protein<br>{{$meal_protein}}g</p>

        </div>
    @endif

</div>
