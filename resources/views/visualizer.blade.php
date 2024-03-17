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
        <div id="TASK-VISUALIZER" class="overflow-x-scroll max-w-7xl mx-auto /sm:px-6 /lg:px-8 even:bg-slate-800 flex [&>*]:grow h-[50vh] max-h-[300px] relative">

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

        <div class="flex justify-between items-center">
        <div class="w-fit rounded-lg my-4 bg-slate-900 text-white p-4 flex items-center gap-6">Legend

            <div class="bg-orange-500 h-[12px] w-[12px] rounded-full"></div>Meal
            <div class="bg-yellow-500 h-[12px] w-[12px] rounded-full"></div>Exercise
            <div class="bg-blue-500 h-[12px] w-[12px] rounded-full"></div>Sleep

        </div>
        <div class="w-full text-right text-white sm:px-6 lg:px-8 mt-4">Calorie Target: 2500kcal</div>
        </div>
    </div>

    <script>

        // a few consts first...
        // we'll call the task visualizer like it's a television.
        const tv = $('#TASK-VISUALIZER');

        const tv_width = tv.width();
        const tv_height = tv.height();

        const tasks = $('#TASKS');

        console.log(tv_width, tv_height);

        const tv_cell_width = tv_width / 25;

        function calibrateScreen() {
            const tv_width = tv.width();
            const tv_height = tv.height();
            const tv_cell_width = tv_width / 25;
        }

        // window.onresize = calibrateScreen;
 
        function createNewTask(caption, color, x_start, x_end, y_index) {

            tasks.append(`<div class="bg-green-500 rounded-lg text-white absolute flex justify-center items-center h-8" style="background-color: #${color}; left: ${x_start}px; width:${x_end-x_start}px; top:${y_index}px;">${caption}</div>`);



        }

        function createNewTask_Time(caption, color, time_start, time_end, y_index) {

           let x_time_start = time_start*tv_cell_width;
           let x_time_end = time_end*tv_cell_width;

            tasks.append(`<div class="bg-green-500 rounded-lg text-white absolute flex justify-center items-center h-8" style="background-color: #${color}; left: ${x_time_start}px; width:${(x_time_end-x_time_start)/tv_width*100}%; top:${y_index}px;">${caption}</div>`);

        }

        createNewTask_Time('Sleep', '0000FF', 0, 5.90, 0)
        createNewTask_Time('Breakfast (600kcal)', 'FF0000', 6, 10.25, 10);
        createNewTask_Time('Lunch (850kcal)', 'FF0000', 12, 17.75, 50)
        createNewTask_Time('Snack', 'FF0000', 18, 19, 90)
        createNewTask_Time('Dinner (1000kcal)', 'FF0000', 19, 25, 130);
        createNewTask_Time('Sleep', '0000FF', 22, 25, 170)
    
        createNewTask_Time('Walk', 'BBBB33', 10.35, 11.90, 30)
        // createNewTask('Walk (30 min)', '33BB33', 210, 430, 10);
        // createNewTask('Breakfast (650kcal)', 'FF0000', 320, 640, 50);
        // createNewTask('Sleep', '2222FF', 800, 1400, 90);

        
    </script>
</x-app-layout>
