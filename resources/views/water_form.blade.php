<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Log Water Intake') }}
        </h1>
    </x-slot>

   
    <div class="max-w-3xl mx-auto border-4 border-blue-500 p-24 dark:text-white">
        <div class="py-4 relative mx-auto max-w-3xl overflow-hidden">
            
            <p>For context, A glass of water is about 200ml.</p>

        </div>


        <form action="" class="text-white max-w-3xl flex gap-4 justify-between">

            <label for="water-time">
                Time drinking water:

                <input type="datetime-local" id="water-time" name="water-time" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" placeholder="" value="" required/>
            
            </label>


            <label for="no-of-glasses">
                Number of glasses (max 12)

                <input type="number" id="no-of-glasses" name="no-of-glasses" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" min="0" max="12" placeholder="" value="" required/>
            
            </label>
            
            
            
        </form>

        <div class="flex justify-end">

            <button id="log-water-btn" class="bg-green-500 text-white px-6 mt-4 p-4">SUBMIT</button>



        </div>

        <form class="mt-4 flex flex-col gap-3"  id="WATER-LOG">

            <p class="text-3xl uppercase italic border-b-2 border-white">Water Log</p>

            

            
            
            
            

        </form>
        
    </div>

    <script>

        $('#log-water-btn').on('click', function() {

            let water_time = $('#water-time').val();
            let water_glasses = $('#no-of-glasses').val();

            console.log(water_time, water_glasses)

            $('#WATER-LOG').append('<p>BABA BOOEY</p>');


        });

    </script>

</x-app-layout>
