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

    <div class="ring-2 ring-green-500 collapse grid-cols-7 grid-flow-col"></div>

    <div class="py-4 relative mx-auto max-w-7xl overflow-hidden">

        <div id="viewmodes-container" class="flex justify-end bg-slate-700">
            <div class="tri-state-toggle flex gap-4 p-6 w-fit list-none">
              <input class="radio-button" type="radio" name="toggle" id="view-monthly" />
              <label for="view-monthly">Monthly</label>
              <input class="radio-button" type="radio" name="toggle" id="view-weekly" />
              <label for="view-weekly">Weekly</label>
              <input class="radio-button" type="radio" name="toggle" id="view-daily" selected/>
              <label for="view-daily">Daily</label>
            </div>
          </div>

        <div></div>

        {{-- <div id="WEEKLY-VIEW" class="p-4 bg-orange-800">

            <div></div>

            <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight m-4">
                {{ __('Daily View') }}
            </h2>

                <div id="TASK-VISUALIZER-WEEKLY" class="/overflow-x-scroll overflow-hidden max-w-7xl mx-auto /sm:px-6 /lg:px-8 even:bg-slate-800 flex [&>*]:grow h-[50vh] max-h-[300px] border-4 relative">

                    <div id="TASKS-WEEKLY" class=" w-full h-full absolute left-0 flex justify-center items-center /w-1/3 /h-1/5 /border-4 /border-orange-500 rounded-lg z-50">
                        
                        <p class="text-center text-gray-400 text-2xl select-none">{{date('d/m/Y')}}</p>

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
                    <div class="bg-green-500 h-[12px] w-[12px] rounded-full"></div>Exercise
                    <div class="bg-blue-500 h-[12px] w-[12px] rounded-full"></div>Sleep

                </div>
                <div class="w-fit bg-slate-900 p-4 rounded-lg text-right text-white sm:px-6 lg:px-8">Calorie Target: 2500kcal</div>
                </div>
            </div> --}}
        
        <div id="DAILY-VIEW" class="p-4">

  

            <div class="m-4 flex flex-col md:flex-row justify-between">
                <h2 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
                    {{ __('Daily View') }}
                </h2>

                <div id="date-range-picker" date-rangepicker class="flex justify-end items-center">
                    <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none [&>div]:flex-col">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input id="datepicker-range-start" name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input id="datepicker-range-end" name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                </div>
                </div>
            </div>
            
            <div></div>


                <div id="TASK-VISUALIZER" class="/overflow-x-scroll overflow-hidden max-w-7xl mx-auto /sm:px-6 /lg:px-8 even:bg-slate-800 flex [&>*]:grow h-[50vh] max-h-[300px] border-4 relative [&>button]:opacity-0 [&>button]:duration-200 [&>button]:hover:opacity-50 rounded-lg">
                    
                    <button id="PREV-DAY" class="absolute top-1/4 left-0 text-9xl text-white opacity-50 z-50 cursor-pointer"> < </button>

                    <button id="NEXT-DAY" class="absolute top-1/4 right-0 text-9xl text-white opacity-50 z-50 cursor-pointer"> > </button>

                    <div id="TASKS" class=" w-full h-full absolute left-0 flex justify-center items-center /w-1/3 /h-1/5 /border-4 /border-orange-500 rounded-lg z-40">
                        
                        

                        <p class="text-center text-gray-400 text-2xl select-none">{{date('d/m/Y')}}</p>

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
                    <div class="bg-green-500 h-[12px] w-[12px] rounded-full"></div>Exercise
                    <div class="bg-blue-500 h-[12px] w-[12px] rounded-full"></div>Sleep

                </div>
                <div class="w-fit bg-slate-900 p-4 rounded-lg text-right text-white sm:px-6 lg:px-8">Calorie Target: 2500kcal</div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>


    <script>

        // a few consts first...
        // we'll call the task visualizer like it's a television.
        const tv = $('#TASK-VISUALIZER');

        const tv_width = tv.width();
        const tv_height = tv.height();

        const tasks = $('#TASKS');

        let noOfTasks = 1;

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

           // For ID
   

            tasks.append(`<div id='task-${noOfTasks}' class="new-task bg-green-500 rounded-lg text-white absolute flex justify-center items-center h-8 z-0" style="background-color: #${color}; left: ${(x_time_start/tv_width)*100}%; width:${(x_time_end-x_time_start)/tv_width*100}%; top:${y_index}px;"><p class='select-none'>${caption}</p></div>`);

            noOfTasks += 1;
        }

        // createNewTask_Time('Sleep', '2196f3', 0, 5.90, 0)
        // createNewTask_Time('Breakfast (600kcal)', 'FF0000', 6, 10.25, 10);
        // createNewTask_Time('Lunch (850kcal)', 'FF0000', 12, 18, 50)
        // createNewTask_Time('Snack', 'FF0000', 18, 19, 90)
        // createNewTask_Time('Dinner (1000kcal)', 'FF0000', 19, 25, 130);
        // createNewTask_Time('Sleep', '2196f3', 22, 27, 170)
        // createNewTask_Time('Walk', '4caf50', 10.30, 11.90, 30)


        // createNewTask('Walk (30 min)', '33BB33', 210, 430, 10);
        // createNewTask('Breakfast (650kcal)', 'FF0000', 320, 640, 50);
        // createNewTask('Sleep', '2222FF', 800, 1400, 90);

        // $('#TASKS').draggable({ axis: 'x' });

        $('.new-task').each(function(i, obj) {



        })
        
        const taskData = [
            [
                { task: "Sleep", description: "...", time_start: 0, time_end: 7.5, bg_color: "2196f3" },
                { task: "Breakfast", description: "...", time_start: 8, time_end: 11.5, bg_color: "FF0000" },
                { task: "Walk", description: "...", time_start: 12, time_end: 13.5, bg_color: "4caf50" },
                { task: "Lunch", description: "...", time_start: 13.5, time_end: 18, bg_color: "FF0000" },
                { task: "Dinner", description: "...", time_start: 18, time_end: 21, bg_color: "FF0000" },
                { task: "Sleep", description: "...", time_start: 22, time_end: 25, bg_color: "2196f3" },
                // ... more tasks for day 1
            ],
            [
                { task: "Sleep", description: "...", time_start: 0, time_end: 11, bg_color: "2196f3" },
                { task: "Lunch", description: "...", time_start: 12, time_end: 17.5, bg_color: "FF0000" },
                // ... tasks for day 2
            ],
            [
                { task: "Sleep", description: "...", time_start: 0, time_end: 7.5, bg_color: "2196f3" },
                { task: "Breakfast", description: "...", time_start: 8, time_end: 11.5, bg_color: "FF0000" },
                { task: "Dinner", description: "...", time_start: 18, time_end: 21, bg_color: "FF0000" },
                { task: "Sleep", description: "...", time_start: 22, time_end: 25, bg_color: "2196f3" },
                // ... more tasks for day 1
            ],
            // ... data for more days
        ];

        const radioButtons = document.querySelectorAll('.radio-button');



            radioButtons.forEach(radioButton => {
            radioButton.addEventListener('focus', () => {
                radioButtons.forEach(btn => btn.classList.remove('ring-2', 'ring-green-500'));
                radioButton.classList.add('ring-2', 'ring-green-500');
            });

            radioButton.addEventListener('blur', () => {
                radioButton.classList.remove('ring-2', 'ring-green-500'); 
            });
            });

            const prevDayBtn = $('#PREV-DAY');
            const nextDayBtn = $('#NEXT-DAY');
            const taskTable = $('#TASKS');

            // let currentDay = 0; 

            // Get the initial width of the table
            // let currentWidth = taskTable.width();

            // prevDayBtn.on('click', () => {
            //     currentDay--;
            //     taskTable.css({
            //         left: -(currentWidth * currentDay),
            //         transition: 'left 0.3s ease' // Add transition for smooth effect
            //     });
            // });

            // nextDayBtn.on('click', () => {
            //     currentDay++;
            //     taskTable.css({
            //         left: -(currentWidth * currentDay),
            //         transition: 'left 0.3s ease' 
            //     });
            // });

            let currentDay = 0; // Start with the first day
            const totalDays = taskData.length; 

            // Function to populate the table with tasks for a given day
            function loadTasksForDay(dayIndex) {
                taskTable.empty(); // Clear the table content

                const tableWidth = taskTable.width();

                taskData[dayIndex].forEach((task, taskIndex) => {
                    const row = $('<tr>');

                    const leftPercent = (task.time_start / 25) * 100;
                    const widthPercent = ((task.time_end - task.time_start) / 25) * 100;

                    const taskElement = $(`
                        <div 
                            id='task-${dayIndex}-${taskIndex}' 
                            class="new-task bg-green-500 rounded-lg text-white absolute flex justify-center items-center h-8 z-0 opacity-0" 
                            style="
                                background-color: #${task.bg_color}; 
                                left: ${leftPercent}%; 
                                width: ${widthPercent}%; 
                                top: ${(taskIndex + 1) * 36}px;
                                transition: opacity 0.3s ease; /* Add transition property */
                            "
                        >
                            <p class='select-none'>${task.task}</p>
                        </div>
                    `);

                    row.append(taskElement);
                    taskTable.append(row);

                    // Fade in after a slight delay for a smoother effect
                    setTimeout(() => {
                        taskElement.addClass('opacity-100'); // Use Tailwind's opacity-100 class
                    }, 50); // Adjust the delay (50ms) as needed
                })
            }

            // Initial load
            loadTasksForDay(currentDay);

            prevDayBtn.on('click', () => {
                currentDay = Math.max(0, currentDay - 1); // Don't go before the first day
                loadTasksForDay(currentDay);
            });

            nextDayBtn.on('click', () => {
                currentDay = Math.min(totalDays - 1, currentDay + 1); // Don't go beyond the last day
                loadTasksForDay(currentDay);
            });
    </script>
</x-app-layout>
