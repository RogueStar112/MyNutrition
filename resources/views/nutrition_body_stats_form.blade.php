<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition Body Stats') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <form id="BODY_STATS_FORM" class="bg-gray-800 text-white" enctype="multipart/form-data">
            @csrf
            
            <div id="BODY_STATS_QUESTIONS">

                <label for="body_stats_q1">
                    1. Did you measure your height and weight just now?
                <label>
                
                <label for="q1_y">Yes
                <input type="radio" id="q1_y" name="body_stats_q1" value="1">
                </label>


                <label for="q1_n">No
                <input type="radio" id="q1_n" name="body_stats_q1" value="0">
                </label>
                
                

            </div>


        </form>
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 [&>div]:bg-gray-800 [&>div]:text-white [&>div]:h-40 [&>div]:mx-3 [&>div]:rounded-lg [&>div]:text-center">
            
            <div class="flex flex-col items-center justify-center">

                <div class="flex justify-center gap-4 ">

                    <button class="p-4 rounded-full bg-red-800 text-2xl">-</button>

                    <input class="flex items-center bg-gray-900 px-4 rounded-full text-center" placeholder="121.7kg">
                    
                    </select>


                    <button class="p-4 rounded-full bg-green-800 text-2xl">+</button>
                </div>
                <p class="text-2xl mt-1">Weight</p>

            </div>

            <div class="flex flex-col items-center justify-center">

                <div class="flex justify-center gap-4 ">

                    <button class="p-4 rounded-full bg-red-800 text-2xl">-</button>

                    <p class="flex items-center bg-gray-900 px-4 rounded-full"> 170cm </p>

                    <button class="p-4 rounded-full bg-green-800 text-2xl">+</button>
                </div>
                <p class="text-2xl mt-1">Height</p>

            </div>

            <div class="flex flex-col items-center justify-center">

                <div class="flex justify-center gap-4 ">

                    <button class="p-4 rounded-full bg-red-800 text-2xl">-</button>

                    <p class="flex items-center bg-gray-900 px-4 rounded-full"> 24.3 </p>

                    <button class="p-4 rounded-full bg-green-800 text-2xl">+</button>
                </div>
                <p class="text-2xl mt-1">BMI</p>

            </div>
            
            

        </div> --}}
    </div>
</x-app-layout>
