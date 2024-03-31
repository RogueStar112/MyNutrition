<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-0 relative" aria-label="water-form-banner">

            <div class="relative w-full h-full overflow-hidden">

                <h1 class="font-semibold text-4xl md:text-6xl uppercase dark:text-white text-3xl text-gray-800 leading-tight p-4 absolute top-1/2 z-50 bg-teal-500 -skew-y-6">
                    {{ __('Log Water Intake') }}
                </h1>


            <svg class="absolute top-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320 z-50">
                <path fill="#0465A5" fill-opacity="0.5" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>


            <div class="absolute bg-teal-700 w-[128px] h-[128px] top-[12rem] right-[40.41rem] -skew-x-[24deg] z-20">
                
            </div>

            <div class="absolute bg-teal-500 w-[384px] /h-[64px] h-[128px] top-[14rem] right-[24.41rem] -skew-x-[24deg] -skew-y-[10deg] z-0">
                
            </div>

            


            <svg class="shadow-2xl" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#0099ff" fill-opacity="0.75" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
            </div>

            <i class="collapse md:visible fas fa-tint fa-3x p-4 text-blue-200 scale-[1.7] -rotate-[30deg] absolute right-[20px] bottom-16 translate-x-1/2 -translate-y-1/2"></i>
            
            <i class="collapse md:visible fas fa-tint fa-3x p-4 text-blue-200 scale-[2.4] -rotate-[30deg] absolute right-[128px] bottom-[128px] translate-x-1/2 -translate-y-1/2"></i>
        
            <i class="collapse md:visible fas fa-tint fa-3x p-4 text-blue-200 scale-[3] -rotate-[30deg] absolute right-20 bottom-0 translate-x-1/2 -translate-y-1/2"></i>
        
        </div>
    </x-slot>

    <div class="shadow-2xl max-w-[1216px] mx-auto relative">

        <i class="collapse md:visible fas fa-clock fa-3x p-4 text-blue-200 scale-[1.7] absolute right-[80px] bottom-16 translate-x-1/2 -translate-y-1/2"></i>
            

        <div class="w-full max-w-[1216px] mx-auto bg-[#0465A5] text-center pt-4 text-white text-3xl">
            <p class="w-fit bg-teal-500 mx-auto p-4 -skew-x-12">Step one: Number of drinks</p>
            <p class="w-fit bg-teal-600 mx-auto p-4 -skew-x-12 text-lg">Assume each glass is 200ml.</p>
        </div>

        <div class="w-full h-[128px] max-w-[1216px] mx-auto flex items-center justify-between px-24" style="background-color: #0465A5;">


                    <i class="fa-solid fa-circle-minus fa-3x text-white" id="decrease-glass"></i>

                    <div id="no-of-glasses" value="5" class="text-[#0465A5] bg-white rounded-full fa-2x p-4 duration-100 ">
                        <i class="fa-solid fa-glass-water"></i>
                        <i class="fa-solid fa-glass-water"></i>
                        <i class="fa-solid fa-glass-water"></i>
                        <i class="fa-solid fa-glass-water"></i>
                        <i class="fa-solid fa-glass-water"></i>
                    </div>

                    {{-- <h2 class="p-4 text-white text-3xl">STEP <span class="bg-white text-[#0465A5] px-2 rounded-full">ONE</span> - Amount of water</h2> --}}
                    <i class="fa-solid fa-circle-plus fa-3x  text-white" id="increase-glass"></i>

        </div>
            

                        <p class="text-white text-center bg-[#0465A5] max-w-[1216px] mx-auto">You have drunk <span id='litres-drank'>1</span>L.</p>

        <div class="w-full max-w-[1216px] mx-auto bg-[#0465A5] text-center pt-4 text-white text-3xl">
            <p class="w-fit bg-teal-500 mx-auto p-4 -skew-x-12">Step two: Time drunk</p>
            <p class="w-fit bg-teal-600 mx-auto p-4 -skew-x-12 text-lg">When did you drink this amount of water?</p>
        </div>


        <div class="w-full h-[128px] max-w-[1216px] mx-auto flex items-center justify-between px-24" style="background-color: #0465A5;">


                    <input class="mx-auto p-4 rounded-full text-[#0465A5]" type="datetime-local" value="2024-03-31T06:00"/>

        </div>
    </div>
    {{-- <div class="max-w-7xl mx-auto border-4 border-blue-500 p-24 dark:text-white relative my-6 mx-4 sm:px-6 lg:px-8">
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
    </div> --}}

    <script>

        let no_of_glasses = 5;

        $('#increase-glass, #decrease-glass').on('click', function() {

            if(this.id == 'increase-glass') {
              no_of_glasses += 1;
            } else {
              no_of_glasses -= 1;
            }


                let output_str = '';
                for(let i = 0; i<no_of_glasses; i++) {
                    output_str += '<i class="fa-solid fa-glass-water"></i> ';
                }

                $('#no-of-glasses').html(output_str);
                $('#litres-drank').html(Number.parseFloat(0.2*no_of_glasses).toFixed(2));
                $('#no-of-glasses').attr('value', no_of_glasses);

        })

        // $('#log-water-btn').on('click', function() {

        //     let water_time = $('#water-time').val();
        //     let water_glasses = $('#no-of-glasses').val();

        //     console.log(water_time, water_glasses)

        //     $('#WATER-LOG').append('<p>BABA BOOEY</p>');


        // });

    </script>

</x-app-layout>
