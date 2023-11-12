<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Nutrition Body Stats') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-3 [&>div]:bg-gray-800 [&>div]:text-white [&>div]:h-40 [&>div]:mx-3 [&>div]:rounded-lg [&>div]:text-center">
            
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
            
            

        </div>
    </div>
</x-app-layout>
