<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Visualizer - Beta') }}
        </h1>
    </x-slot>

    @php   
        // constant variable 
        $hrs = 25;
    @endphp

    <div class="py-4 relative mx-auto max-w-7xl">
        <div id="TASK-VISUALIZER" class="max-w-7xl mx-auto /sm:px-6 /lg:px-8 even:bg-slate-800 flex [&>*]:grow h-[50vh] max-h-[300px] relative">

            <div id="TASKS" class=" w-full h-full absolute left-0 flex justify-center items-center /w-1/3 /h-1/5 border-4 border-orange-500 rounded-lg z-50 overflow-hidden">
                
                <p class="text-center text-white">Tasks Container</p>

            </div>
            
            @for ($i=0; $i<$hrs; $i++)
                <div id="hr-{{$i}}" class="even:bg-slate-800 odd:shadow-2xl odd:bg-transparent relative">

                    @if($i == 0)
                    <p class="absolute top-0 left-1 text-white opacity-60 font-extrabold">TIME</p>
                    @endif

                    @if($i < 10)
                    <p class="absolute bottom-0 left-1 text-white opacity-60 font-extrabold">0{{$i}}</p>
                    @else
                    <p class="absolute bottom-0 left-1 text-white opacity-60 font-extrabold">{{$i}}</p> 
                    @endif
                </div>
            @endfor

            
     

        </div>

        <div class="w-full text-right text-white sm:px-6 lg:px-8 mt-4">Calorie Target: 2500kcal</div>
    </div>

    <script>

        // a few consts first...
        // we'll call the task visualizer like it's a television.
        const tv = $('#TASK-VISUALIZER');

        const tv_width = tv.width();
        const tv_height = tv.height();

        const tasks = $('#TASKS');

        console.log(tv_width, tv_height);

        function createNewTask(caption, color, x_start, x_end, y_index) {

            tasks.append(`<div class="bg-green-500 rounded-lg text-white absolute flex justify-center items-center h-8" style="background-color: #${color}; left: ${x_start}px; width:${x_end-x_start}px; top:${y_index}px;">${caption}</div>`);



        }

        createNewTask('Exercise (30 min)', '33DD33', 210, 430, 0);
        createNewTask('Breakfast (650kcal)', 'FF0000', 320, 640, 40);
        createNewTask('Sleep', '2222FF', 800, 1400, 80);
    </script>
</x-app-layout>
