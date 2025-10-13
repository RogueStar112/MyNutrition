<div class="bg-slate-900 w-full h-fit text-center rounded-lg shadow-2xl">


    <div class="grid grid-cols-3 items-center justify-between px-6 sm:grid sm:grid-cols-[2fr_1fr_1fr]">
       {{$meal_name}}

       <div class="text-blue-500">{{$meal_calories}}kcal</div>
       <button wire:click="toggle_meal_items" class="text-4xl cursor-pointer">
        @if ($show_meal_items)
            <i class="fa-solid fa-chevron-up"></i>
        @else
            <i class="fa-solid fa-chevron-down"></i>
        @endif
       </button>
    </div>

    @if($show_meal_items)
    <div class="flex flex-col [&>*]:odd:bg-slate-600 [&>*]:even:bg-slate-700">
        
        
        @for($i = 0; $i < count($meal_macros); $i++) 
        <div class="grid grid-cols-5 items-center [&>*]:h-max">
            @if($i == 0)
            <div class="col-span-full grid grid-cols-5 py-4 [&>*]:px-4 items-center bg-gradient-to-b from-slate-900 to-slate-600">
                <div class="uppercase">NAME</div>
                 <div class="uppercase flex justify-center"><div class="p-2 bg-blue-500 rounded-full w-[2.5rem] text-[8px]">kCal</div></div>
                <div class="uppercase flex justify-center"><div class="p-2 bg-orange-500 rounded-full w-[2.5rem]">F</div></div>
                <div class="uppercase flex justify-center"><div class="p-2 bg-red-500 rounded-full w-[2.5rem]">C</div></div>
                 <div class="uppercase flex justify-center"><div class="p-2 bg-green-500 rounded-full w-[2.5rem]">P</div></div>
            </div>
            @endif

            <div class="grow text-sm px-4">{{$meal_macros[$i]->name}}</div>
            <div class="text-sm px-4">{{$meal_macros[$i]->calories}}</div>
            <div class="text-sm px-4">{{$meal_macros[$i]->fat}}g</div>
            <div class="text-sm px-4">{{$meal_macros[$i]->carbohydrates}}g</div>
            <div class="text-sm px-4">{{$meal_macros[$i]->protein}}g</div>
        </div>
        @endfor

        

        <div class="flex justify-between w-full [&>*]:bg-slate-900 [&>*]:grow [&>*]:p-2 [&>*]:text-center rounded-b-lg">

            <p class="text-blue-500">Calories<br>{{$meal_calories}}</p>
            <p class="text-orange-500">Fat<br>{{$meal_fats}}g</p>
            <p class="text-red-500">Carbs<br>{{$meal_carbs}}g</p>
            <p class="text-green-500">Protein<br>{{$meal_protein}}g</p>

        </div>
    </div>
    @endif

</div>
