<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <span class="text-white">Last 14 Days of Activity</span>
    </x-slot>

    <div class="min-h-screen py-4 pt-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="grid grid-cols-5 grid-rows-5 w-full h-full gap-2 h-[calc(100vh-8rem)] max-h-[900px] [&>*]:flex [&>*]:items-center [&>*]:justify-center [&>*]:text-center [&>*]:text-white">
            <div class="col-start-1 col-end-4 row-start-1 row-end-4 rounded-lg border-4 border-red-300">
                
                
                <x-chartjs-component :chart="$chart" />
            

            


            </div>
            
            <div class="col-start-4 col-end-6 row-start-1 row-end-3 border-4 border-blue-300">
                
                Meal Highlights
                
            </div>

            
            <div class="col-start-4 col-end-6 row-start-3 row-end-6 border-4 border-green-300">Latest Day Summary</div>
            <div class="col-start-1 col-end-4 row-start-4 row-end-5 border-4 border-yellow-300">Last Meal Tracked</div>
            <div class="col-start-1 col-end-2 row-start-5 row-end-6 border-4 border-purple-300">Slot 1</div>
            <div class="col-start-2 col-end-3 row-start-5 row-end-6 border-4 border-pink-300">Slot 2</div>
            <div class="col-start-3 col-end-4 row-start-5 row-end-6 border-4 border-orange-300">Slot 3</div>
          </div>
          
    </div>
</x-app-layout>
