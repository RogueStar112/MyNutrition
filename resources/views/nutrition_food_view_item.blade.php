<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center">
            {{ __('Nutrition - Food View Item') }}
        </h2>
    </x-slot>

    <div class="flex py-4 justify-center">
        
        @isset($foods)

        <div class="max-w-7xl overflow-x-auto bg-slate-800 h-screen w-full m-6 md:w-[1000px] md:h-[600px] rounded-lg">
            
            @foreach($foods as $food)
            <div class="grid grid-cols-3 gap-x-2 gap-y-3 grid-flow-row-dense ">
                <div class='flex flex-col place-items-center /bg-red-500 text-white rounded-lg shadow-xl min-h-[50px] row-span-2 col-span-1 p-6 items-center'>
                    
                    
                        <div class="flex flex-col text-center h-full items-center justify-center">
                        <p class="font-black text-2xl text-center">{{$food['name']}}</p>
                        <p class="m-0 p-0">{{$food['source_name']}}</p>
                        </div>
                    
                    
                </div>
                {{-- <div class='bg-orange-500 rounded-lg shadow-xl min-h-[50px] col-span-3' /></div> --}}

                {{-- 
                        
                --}}
                <div class='/bg-yellow-500 text-white text-center rounded-lg shadow-xl min-h-[50px] row-span-2 col-span-2 grid grid-cols-4 justify-items-center items-end [&>div]:p-6 /[&>div]:h-full [&>div]:w-full gap-3'>
                    
                    <!-- Macronutrients -->
                    <div class="bg-blue-800">
                        <p class="font-black">{{$food['calories']}}kcal</p>

                        Calories

                    </div>


                    <div class="bg-orange-800">

                        <p>{{$food['fat']}}g</p>
                        Fat
                    </div>


                    <div class="bg-yellow-800">

                        </p>{{$food['carbohydrates']}}g</p>
                        Carbs
                    </div>


                    <div class="bg-green-800">

                        <p>{{$food['protein']}}g</p>
                        Protein
                    </div>

                </div>
                <div class='bg-green-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-teal-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-blue-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-indigo-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-purple-500 rounded-lg shadow-xl min-h-[50px]' />

                    <img src="{{  url(''.$food['img_url']) }}" />
                
                </div>
                <div class='bg-pink-500 rounded-lg shadow-xl min-h-[50px]' /></div>
                <div class='bg-slate-500 rounded-lg shadow-xl min-h-[50px]' /></div>
            </div>
            @endforeach

        </div>

        @endisset

    </div>

    <script>

        
            
    </script>
</x-app-layout>
