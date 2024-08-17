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
        
        <div id="DAILY-VIEW" class="p-4 grid grid-cols-[2fr_1fr] grid-rows-[90px_minmax(200px, 1fr)] gap-2">

            <div id="DAILY-VISUALIZER-VIEW">

                <div class="mt-4 flex flex-col md:flex-row justify-between place-items-center  bg-slate-800 rounded-lg p-2">
                    <h2 class="text-center mb-4 md:mb-0 md:text-left font-semibold italic uppercase dark:text-white text-2xl mx-auto text-gray-800 leading-tight">
                        {{ __('Daily View') }}
                    </h2>
                    
                    <div id="daterange-controls" class="flex justify-between p-4">
                        <div id="date-range-picker" date-rangepicker class="flex justify-end items-center">
                            <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none [&>div]:flex-col">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="datepicker-range-start" name="dailypicker-start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="datepicker-range-end" name="dailypicker-end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">
                        </div>
                        </div>

                        <button type="button" id="update-dailyview-btn" class="btn bg-green-500 p-2 rounded-lg ml-2 text-white hover:bg-green-600">Update</button>
                    </div>
            </div>
            
            {{-- Empty divs to keep the time visuals visible --}}
            <div></div>

            <div id="TASK-DATES" class="flex justify-around bg-slate-800 h-8 justify-center items-center my-2 rounded-lg">

            </div>

            <div></div>


                <div id="TASK-VISUALIZER" class="/max-w-[66.7%] overflow-x-scroll md:overflow-hidden /max-w-7xl /sm:px-6 /lg:px-8 even:bg-slate-800 flex [&>*]:grow h-[50vh] max-h-[400px] border-4 relative [&>button]:opacity-0 [&>button]:duration-200 [&>button]:hover:opacity-50 rounded-lg">
                    
                    <button id="PREV-DAY" class="absolute top-1/4 left-0 text-9xl text-white opacity-50 z-50 cursor-pointer"> < </button>

                    <button id="NEXT-DAY" class="absolute top-1/4 right-0 text-9xl text-white opacity-50 z-50 cursor-pointer"> > </button>

                    <div id="TASKS" class=" w-full h-full absolute left-0 flex justify-center items-center /w-1/3 /h-1/5 /border-4 /border-orange-500 rounded-lg z-40">
                        
                        

                        <p class="text-center text-gray-400 text-2xl select-none">{{date('d/m/Y')}}</p>

                    </div>
                    
                    @for ($i=0; $i<$hrs; $i++)
                        <div id="hr-{{$i}}" class="even:bg-slate-800 odd:shadow-2xl odd:bg-transparent relative">

                            @if($i == 0)
                            <p class="absolute top-0 left-1 text-white opacity-60 font-extrabold pt-4 z-50 ">TIME</p>
                            @endif

                            @if($i < 10)
                            <p class="absolute bottom-0 left-1 text-white opacity-60 font-extrabold">0{{$i}}</p>
                            @else
                            <p class="absolute bottom-0 left-1 text-white opacity-60 font-extrabold">{{$i}}</p> 
                            @endif
                        </div>
                    @endfor

                    
            

                </div>


                <div id="MEAL-LEGEND" class="flex justify-between items-center /max-w-[66.7%]">
                <div class="w-fit rounded-lg my-4 bg-slate-900 text-white p-4 flex items-center gap-6">Legend

                    <div class="bg-orange-500 h-[12px] w-[12px] rounded-full"></div>Meal
                    <div class="bg-green-500 h-[12px] w-[12px] rounded-full"></div>Exercise
                    <div class="bg-blue-500 h-[12px] w-[12px] rounded-full"></div>Sleep

                </div>
                <div class="w-fit bg-slate-900 p-4 rounded-lg text-right text-white sm:px-6 lg:px-8">Calorie Target: 2500kcal</div>
                </div>
            </div>

           
        

            <div id="TASK-VISUALIZER-DAILY-LIST" class="grid grid-rows-[106px_1fr] grid-flow-col gap-3">

                <div id="TASK-VISUALIZER-DAILY-LIST-DAYHEADER" class="h-full">
                    <div class="my-4 flex flex-col md:flex-row justify-between place-items-center  bg-slate-800 rounded-lg p-2 h-full">
                        <h2 id="DAILY-DATE-SELECTED" class="text-center mx-auto my-4 md:text-left font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
                            {{ date("d/m/Y") }}
                        </h2>
                    </div>
                </div>

                <div id="TASK-VISUALIZER-DAILY-LIST-TASKS" class="flex flex-col gap-3">

                </div>


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
        
        let taskData = [
            [
                { task: "Sleep", description: [{type: "duration", value: 7.5, unit: "hrs"},
                {type: "estimated_calories_burnt", value: 550, unit: "kcal", description: "based on your (BMR / 24) * time slept."}], time_start: 0, time_end: 7.5, bg_color: "2196f3" },
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
                { task: "Sleep", description: "...", time_start: 18, time_end: 25, bg_color: "2196f3"}
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

            const taskTable_dailyList = $('#TASK-VISUALIZER-DAILY-LIST-TASKS');
            const taskDates = $('#TASK-DATES');

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
            let totalDays = taskData.length; 

            // Function to populate the table with tasks for a given day
            function loadTasksForDay(_dayIndex) {
                taskTable.empty(); // Clear the table content

                const tableWidth = taskTable.width();
                const tableHeight = taskTable.height();
                let dateKeys = Object.keys(taskData);

                console.log("DKS", dateKeys)
                console.log("TDBFFE", taskData)
                console.log("_DI", _dayIndex)

                dateKeys.forEach((dateKey, dayIndex) => {

                    // taskTable.empty()
                    
                    const tasksForDay = taskData[dateKeys[_dayIndex]]; 

                    console.log("TFD", tasksForDay)

                    tasksForDay.forEach((task, taskIndex) => {
                        
                        const row = $('<tr>');

                        const leftPercent = (task.time_start / 25) * 100;
                        const widthPercent = ((task.time_end - task.time_start) / 25) * 100;

                        const taskElement = $(`
                            <div 
                                id='task-${dayIndex}-${taskIndex}' 
                                class="new-task bg-green-500 rounded-lg text-white absolute flex justify-center items-center h-8 z-0 opacity-0 cursor-pointer" 
                                style="
                                    background-color: #${task.bg_color}; 
                                    left: ${leftPercent}%; 
                                    width: ${widthPercent}%; 
                                    top: ${(taskIndex + 1) * (tableHeight / 40)}%;
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
                })
            }

            function getDecimals(num) {
                return num - Math.floor(num); 
            }

            function convertTimeToReadableString(time) {
                const hours = Math.floor(time);
                const minutes = Math.round((time - hours) * 60);
                const amPm = hours < 12 ? 'AM' : 'PM';
                const formattedHours = (hours % 12) || 12; // Convert 0 to 12

                return `${formattedHours}:${minutes.toString().padStart(2, '0')} ${amPm}`;
            }



            function loadTasksForDay_list(_dayIndex) {
                const todaysDate = new Date();

                taskTable_dailyList.empty(); // Clear the table content
                const dateKeys = Object.keys(taskData);
                
                dateKeys.forEach((dateKey, dayIndex) => {
                    const tasksForDay = taskData[dateKeys[_dayIndex]]; 

                    taskTable_dailyList.empty()

                    tasksForDay.forEach((task, taskIndex) => {
                        const row = $('<tr>');

                        const taskElement = $(`
                            <div 
                                id='taskList-${dayIndex}-${taskIndex}' 
                                class="new-task w-full h-full rounded-lg text-white flex justify-between px-12 h-[53px] items-center bg-slate-800 h-8 z-0 opacity-0 cursor-pointer" 
                                style="
                                    background-color: #${task.bg_color}; 
                                    transition: opacity 0.3s ease; /* Add transition property */
                                "
                            >
                                <p class='select-none'>${task.task}</p>

                                <div>
                                    <p>${convertTimeToReadableString(task.time_start)} - ${convertTimeToReadableString(task.time_end)}</p>
                                </div>
                            </div>
                        `);

                        row.append(taskElement);
                        taskTable_dailyList.append(row);

                        setTimeout(() => {
                            taskElement.addClass('opacity-100'); 
                        }, 50); 
                    });
                });

            }

            function loadTaskDates(_dayIndex) {
                const todaysDate = new Date();

                taskDates.empty(); // Clear the table content
                const dateKeys = Object.keys(taskData);
                
                dateKeys.forEach((dateKey, dayIndex) => {
                    const tasksForDay = taskData[dateKey]; 
                    taskDates.empty()

                    tasksForDay.forEach((task, taskIndex) => {
                        const row = $('<tr>');

                        const taskElement = task.date_short ? $(`
                            <div 
                                id='taskDate-${dayIndex}-${taskIndex}' 
                                class="new-taskdate w-min rounded-lg text-white flex justify-between  h-[53px] items-center bg-slate-800 h-4 z-0 opacity-0 cursor-pointer" 
                                style="
                                    background-color: #${task.bg_color}; 
                                    transition: opacity 0.3s ease; /* Add transition property */
                                "
                            >
                                <p class=''>${task.date_short ? task.date_short : ""}</p>
                            </div>
                        `) : $(`<div></div>`);

                        row.append(taskElement);
                        taskDates.append(row);

                        setTimeout(() => {
                            taskElement.addClass('opacity-100'); 
                        }, 50); 
                    });
                });

            }
                

            // Initial load
            loadTasksForDay(currentDay);
            loadTasksForDay_list(currentDay);
            loadTaskDates(currentDay);

            prevDayBtn.on('click', () => {
                currentDay = Math.max(0, currentDay - 1); // Don't go before the first day
                
                console.log('TD PREV', Object.keys(taskData));

                $('#DAILY-DATE-SELECTED').text(`${Object.keys(taskData)[currentDay]}`)

                loadTasksForDay(currentDay);
                loadTasksForDay_list(currentDay);
                loadTaskDates(currentDay);
            });

            nextDayBtn.on('click', () => {
                currentDay = Math.min(totalDays - 1, currentDay + 1); // Don't go beyond the last day
                
                console.log('TD NEXT', Object.keys(taskData));

                $('#DAILY-DATE-SELECTED').text(`${Object.keys(taskData)[currentDay]}`)

                loadTasksForDay(currentDay);
                loadTasksForDay_list(currentDay);
                loadTaskDates(currentDay);
            });


            function convertDateFormat(dateString) {
                const [year, day, month] = dateString.split('-');
                return `${year}-${month}-${day}`; 
            }

            $('#update-dailyview-btn').on("click", function(e) {

                e.preventDefault();

                var csrfToken = $('meta[name="csrf-token"]').attr('content');


                var startDate = convertDateFormat($('#datepicker-range-start').val().split("/").reverse().join("-"));
                var endDate = convertDateFormat($('#datepicker-range-end').val().split("/").reverse().join("-"));
                

                $.ajax({
                        url: `/nutrition/visualizer/load/${startDate}/${endDate}`,
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            // date_start: startDate,
                            // date_end: endDate
                            // no_of_foods: no_of_foods,
                            // balancer: replacement_balancer,
                            // query: query,
                            // servingSize: servingSize,
                            // quantity: quantity
                            // ignoreServingSize: ignoreServingSize
                        },
                        success: function(response) {
                            console.log(response);
                            

                            taskData = response;
                            totalDays = Object.keys(taskData).length; 

                            console.log('TD UPDATE', Object.keys(taskData));

                            loadTasksForDay(currentDay);
                            loadTasksForDay_list(currentDay);
                            loadTaskDates(currentDay);

                            $('#DAILY-DATE-SELECTED').text(`${Object.keys(taskData)[currentDay]}`)
                        }
                })

            })
    </script>
</x-app-layout>
