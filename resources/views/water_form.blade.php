<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-0 relative">

            <div class="relative w-full h-full overflow-hidden">

                <h1 class="font-semibold text-4xl md:text-6xl italic uppercase dark:text-white text-3xl text-gray-800 leading-tight p-4 absolute top-1/2 z-50 bg-pink-600 -skew-y-6">
                    {{ __('Log Water Intake') }}
                </h1>


            <svg class="absolute top-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#0099ff" fill-opacity="0.5" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="0.75" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>

            <i class="fas fa-tint fa-3x p-4 text-blue-200 scale-[1.7] -rotate-[30deg] absolute right-[20px] bottom-16 translate-x-1/2 -translate-y-1/2"></i>
            
            <i class="fas fa-tint fa-3x p-4 text-blue-200 scale-[2.4] -rotate-[30deg] absolute right-[128px] bottom-[128px] translate-x-1/2 -translate-y-1/2"></i>
        
            <i class="fas fa-tint fa-3x p-4 text-blue-200 scale-[3] -rotate-[30deg] absolute right-20 bottom-0 translate-x-1/2 -translate-y-1/2"></i>
        
        </div>
    </x-slot>

   
    <div class="max-w-7xl mx-auto border-4 border-blue-500 p-24 dark:text-white relative py-6 px-4 sm:px-6 lg:px-8">
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
{{-- 
        <i class="fas fa-tint fa-3x p-4 text-blue-400 opacity-60 scale-[3] -rotate-[30deg] absolute right-20 bottom-0 translate-x-1/2 -translate-y-1/2"></i>
         --}}
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="0.5" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>

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
