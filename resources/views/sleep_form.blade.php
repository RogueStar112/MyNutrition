<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold italic uppercase dark:text-white text-3xl text-gray-800 leading-tight">
            {{ __('Log Sleep Patterns') }}
        </h1>
    </x-slot>

   

    <div class="py-4 relative mx-auto max-w-7xl overflow-hidden">

        <div id="SLEEP-HERO">
            <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col gap-0 relative" aria-label="water-form-banner" style="/background: radial-gradient(closest-side, #0465A5, #334155);">

                <div class="relative w-full h-full overflow-hidden">

                    <h1 class="font-semibold text-3xl md:text-6xl uppercase dark:text-white text-3xl text-gray-800 leading-tight text-center md:text-left md:p-4 md:absolute top-1/2 z-50 primary-sleep-form md:-skew-y-6 md:w-[597px]" style="">
                        
                        Log <select id="sleep-type" class="no-select-arrow text-4xl appearance-none dark:text-white text-gray-800 leading-tight p-4 top-1/2 z-50 primary-sleep-form border-none uppercase px-2 w-[180px] outline-0 focus:outline-0" style="-moz-appearance: none;">
                            <option selected="" value="0" text-value="Basic">Basic</option>
                            <option value="1" text-value="REM">REM</option>
                            <option value="2" text-value="Core">Core</option>
                            <option value="3" text-value="Deep">Deep</option>
                            </select>Sleep
                    </h1>


                <svg class="absolute top-4 collapse md:visible" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320 z-50">
                    <path fill="#0465A5" fill-opacity="0.5" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>


                <div class="absolute collapse md:visible tertiary-sleep-form w-[128px] h-[128px] right-[53.5%] top-[79%] -skew-x-[24deg] z-20">
                    
                </div>

                <div class="absolute collapse md:visible primary-sleep-form w-[384px] /h-[64px] h-[128px] top-[14rem] right-[24.41rem] -skew-x-[24deg] -skew-y-[10deg] z-10">
                    
                </div>

                


                <svg class="hidden md:block md:relative shadow-2xl bottom-0 select-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#694F8E" fill-opacity="0.75" d="M0,160L48,144C96,128,192,96,288,122.7C384,149,480,235,576,245.3C672,256,768,192,864,192C960,192,1056,256,1152,261.3C1248,267,1344,213,1392,186.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                </div>

                {{-- <i class="collapse md:visible fas fa-bed fa-3x p-4 text-purple-200 scale-[1.7] -rotate-[30deg] absolute right-[20px] bottom-16 translate-x-1/2 -translate-y-1/2"></i>
                
                <i class="collapse md:visible fas fa-bed fa-3x p-4 text-purple-200 scale-[2.4] -rotate-[30deg] absolute right-[128px] bottom-[128px] translate-x-1/2 -translate-y-1/2"></i> --}}

                <i class="collapse md:visible fas fa-bed fa-3x p-4 text-[#FFDFD6] scale-[3] absolute right-20 bottom-0 translate-x-1/2 -translate-y-1/2"></i>

            </div>
            </div>
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1280" height="320" viewBox="0 0 1280">
                <!-- Define the clipping path -->
                <clipPath id="clip">
                    <path d="M0,288L6.9,261.3C13.7,235,27,181,41,144C54.9,107,69,85,82,90.7C96,96,110,128,123,117.3C137.1,107,151,53,165,26.7C178.3,0,192,0,206,48C219.4,96,233,192,247,208C260.6,224,274,160,288,154.7C301.7,149,315,203,329,202.7C342.9,203,357,149,370,154.7C384,160,398,224,411,213.3C425.1,203,439,117,453,101.3C466.3,85,480,139,494,170.7C507.4,203,521,213,535,218.7C548.6,224,562,224,576,192C589.7,160,603,96,617,64C630.9,32,645,32,658,32C672,32,686,32,699,69.3C713.1,107,727,181,741,186.7C754.3,192,768,128,782,106.7C795.4,85,809,107,823,138.7C836.6,171,850,213,864,192C877.7,171,891,85,905,85.3C918.9,85,933,171,946,224C960,277,974,299,987,293.3C1001.1,288,1015,256,1029,208C1042.3,160,1056,96,1070,96C1083.4,96,1097,160,1111,170.7C1124.6,181,1138,139,1152,117.3C1165.7,96,1179,96,1193,122.7C1206.9,149,1221,203,1234,240C1248,277,1262,299,1275,288C1289.1,277,1303,235,1317,181.3C1330.3,128,1344,64,1358,74.7C1371.4,85,1385,171,1399,202.7C1412.6,235,1426,213,1433,202.7L1440,192L1440,320L1433.1,320C1426.3,320,1413,320,1399,320C1385.1,320,1371,320,1358,320C1344,320,1330,320,1317,320C1302.9,320,1289,320,1275,320C1261.7,320,1248,320,1234,320C1220.6,320,1207,320,1193,320C1179.4,320,1166,320,1152,320C1138.3,320,1125,320,1111,320C1097.1,320,1083,320,1070,320C1056,320,1042,320,1029,320C1014.9,320,1001,320,987,320C973.7,320,960,320,946,320C932.6,320,919,320,905,320C891.4,320,878,320,864,320C850.3,320,837,320,823,320C809.1,320,795,320,782,320C768,320,754,320,741,320C726.9,320,713,320,699,320C685.7,320,672,320,658,320C644.6,320,631,320,617,320C603.4,320,590,320,576,320C562.3,320,549,320,535,320C521.1,320,507,320,494,320C480,320,466,320,453,320C438.9,320,425,320,411,320C397.7,320,384,320,370,320C356.6,320,343,320,329,320C315.4,320,302,320,288,320C274.3,320,261,320,247,320C233.1,320,219,320,206,320C192,320,178,320,165,320C150.9,320,137,320,123,320C109.7,320,96,320,82,320C68.6,320,55,320,41,320C27.4,320,14,320,7,320L0,320Z"></path>
                </clipPath>
            
                <!-- Apply the clipping path to the image -->
                <image width="1280" height="320" href="{{asset('storage/images/sleep/pexels-olly-3807760.jpg')}}" clip-path="url(#clip)" />
            </svg> --}}
            
            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1280" height="320" viewBox="0 0 1024 320">
                <!-- Define the clipping path -->
                <clipPath id="clip">
                    <path d="M0,288L30,256C60,224,120,160,180,160C240,160,300,224,360,261.3C420,299,480,309,540,282.7C600,256,660,192,720,154.7C780,117,840,107,900,90.7C960,75,1020,53,1080,80C1140,107,1200,181,1260,192C1320,203,1380,149,1410,122.7L1440,96L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
                </clipPath>
            
                <!-- Apply the clipping path to the image and adjust the aspect ratio -->
                <image x="240" width="1024" height="320" href="{{asset('storage/images/sleep/pexels-olly-3807760.jpg')}}" clip-path="url(#clip)" preserveAspectRatio="xMidYMid slice" />
            </svg> --}}
            

        </div>

        <form id="WATER-FORM" method="POST" class="shadow-2xl max-w-[1216px] mx-auto relative" action="{{ route('water.store') }}">
            @csrf
    
            
            <i class="collapse md:visible fas fa-clock fa-3x p-4 text-blue-200 scale-[1.7] absolute right-[80px] bottom-16 translate-x-1/2 -translate-y-1/2"></i>
            
            {{-- background: radial-gradient(closest-side, #0465A5, #334155); --}}
            <div style="background: radial-gradient(closest-side, #694F8E, #334155);">
    
            
                <div class="w-full max-w-[1216px] /bg-[#0465A5] mx-auto text-center pt-4 text-white text-3xl">
                    <p class="w-fit primary-sleep-form mx-auto p-4 -skew-x-12">Step one: Hours of sleep</p>
                    <p id="assume-text" class="w-fit secondary-sleep-form mx-auto p-4 -skew-x-12 text-lg">Assume each bed is 1 hour.</p>
                </div>
        
                <div class="w-full max-h-[256px] md:h-[128px] max-w-[1216px] mx-auto flex items-center justify-between px-2 md:px-24 py-12 md:py-0" style="/background-color: #0465A5; /background: radial-gradient(#0465A5, #9198e5);">
        
        
                            <i class="fa-solid fa-circle-minus fa-3x text-white" id="decrease-sleep"></i>
        
                            <div id="no-of-beds" value="5" class="text-[#0465A5] bg-white rounded-full fa-2x p-4 duration-100 ">
                                <i class="fa-solid fa-bed"></i>
                                <i class="fa-solid fa-bed"></i>
                                <i class="fa-solid fa-bed"></i>
                                <i class="fa-solid fa-bed"></i>
                                <i class="fa-solid fa-bed"></i>
                            </div>
        
                            
                            <i class="fa-solid fa-circle-plus fa-3x  text-white" id="increase-sleep"></i>
        
                </div>
                
                                <p id="total-slept" class="text-white text-center /bg-[#0465A5] max-w-[1216px] mx-auto">You have slept for <span id="hours-taken">1 </span>hours.</p>
                                <p class="text-white text-center /bg-[#0465A5] max-w-[1216px] mx-auto">That's <span id="hours-slept">5</span> <span id="sleep-duration">hours</span> of sleep</span>.</p>
        
                <div class="w-full max-w-[1216px] mx-auto /bg-[#0465A5] text-center pt-4 text-white text-3xl">
                    <p class="w-fit primary-sleep-form mx-auto p-4 -skew-x-12">Step two: When slept</p>
                    <p class="w-fit secondary-sleep-form mx-auto p-4 -skew-x-12 text-lg">When did you take this amount of <span class="sleep-type"></span> sleep?</p>
                </div>
        
        
                <div class="w-full h-[128px] max-w-[1216px] mx-auto flex items-center justify-between px-24" style="/background-color: #0465A5; /background: radial-gradient(#e66465, #9198e5);">
        
                            <input type="hidden" name="sleep-amount" id="sleep-amount" value="5">
                            <input type="hidden" name="sleep-type" id="sleep-type" value="0">
                            <input id="sleep-when" name="sleep-when" class="mx-auto p-4 rounded-full text-[#0465A5]" type="datetime-local" value="2024-03-31T06:00">
        
                </div>
        
        
                <div class="w-full h-[128px] max-w-[1216px] mx-auto flex items-center justify-between px-24 /bg-[#0465A5]">
        
                    <button type="submit" id="add-fluid-entry" class="bg-green-500 text-white mx-auto p-4">ADD ENTRY</button>
        
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
    
    
                <label for="no-of-beds">
                    Number of glasses (max 12)
    
                    <input type="number" id="no-of-beds" name="no-of-beds" class="block bg-slate-700 text-gray-200 w-full mt-1 rounded-md" min="0" max="12" placeholder="" value="" required/>
                
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
    </form> --}}
    </div>


    <script>

        let nounToUse = 'water'

        let sleepTypeVal = $('#sleep-type').val();
        let verbToUse = sleepTypeVal == 3 ? 'pieces' : 'glasses'

        // console.log('VTU', verbToUse)


        const currentDate = new Date();
        let day = currentDate.getDate();
        let month = currentDate.getMonth() + 1;
        let year = currentDate.getFullYear();


        // make day or month have a leading zero if value is less than 10 e.g. 9 becomes 09.
        if (day < 10) {

            day = `0${day}`;
        }

        if (month < 10) {

            month  = `0${month}`;

        }

        let hours = currentDate.getHours();
        let minutes = currentDate.getMinutes();

        // apply same leading zero logic to hours and minutes
        if (hours < 10) {

            hours = `0${hours}`;
        }

        if (minutes < 10) {

            minutes = `0${minutes}`;

        }

        $('#sleep-when').val(`${year}-${month}-${day}T${hours}:${minutes}`);

        $('#sleep-when').attr('value', `${year}-${month}-${day}T${hours}:${minutes}`);

        let no_of_hrs_slept = 5;

        $('#increase-sleep, #decrease-sleep').on('click', function() {

            if(this.id == 'increase-sleep') {
                no_of_hrs_slept += 1;
                } else {
                no_of_hrs_slept -= 1;
            }

            if(no_of_hrs_slept > 0) {


            } else {
                
                no_of_hrs_slept = 0;

            }


            let output_str = '';
            for(let i = 0; i<no_of_hrs_slept; i++) {
                if($('#sleep-type').find(":selected").val() == 3) {
                    output_str += '<i class="fas fa-apple-alt"></i> ';
                } else {
                    output_str += '<i class="fa-solid fa-bed"></i> ';
                }

            }


            $('#no-of-beds').html(output_str);
            // $('#hours-taken').html(Number.parseFloat(1*no_of_hrs_slept).toFixed(2));
            $('#hours-taken').html(` ${1*no_of_hrs_slept}`);
            $('#hours-slept').html(no_of_hrs_slept)
            $('#no-of-beds').attr('value', no_of_hrs_slept);
            $('#sleep-amount').val(no_of_hrs_slept)
        })

        // $('#log-water-btn').on('click', function() {

        //     let water_time = $('#water-time').val();
        //     let water_glasses = $('#no-of-beds').val();

        //     console.log(water_time, water_glasses)

        //     $('#WATER-LOG').append('<p>BABA BOOEY</p>');


        // });

        $('#sleep-type').on('change', function() {

            // console.log(this)
            // console.log(this.value);
            
            //IF WATER
            if(this.value == 0) {

                // $(".primary-sleep-form").css("background-color", "#14b8a6");
                //   $(".primary-sleep-form").css("color", "rgb(255, 255, 255)");

                // $(".secondary-sleep-form").css("background-color", "#0d9488");
                // $(".tertiary-water-form").css("background-color", "#0f766e");

                $("#no-of-beds>*").addClass('fa-solid fa-bed');
                $("#no-of-beds>*").removeClass('fas fa-apple-alt');
                
                // $('#sleep-type').text('glasses')

                $('#assume-text').text('Assume each bed is 1 hour.')

                $('#total-slept').removeClass('hidden');

                $('#sleep-type').val(this.value);
            }
            
            // IF COKE
            if(this.value == 1) {

                // $(".primary-sleep-form").css("background-color", "rgb(154, 81, 26)");
                // $(".primary-sleep-form").css("color", "rgb(255, 255, 255)");
                // $(".secondary-sleep-form").css("background-color", "rgb(115, 60, 19)");
                // $(".tertiary-water-form").css("background-color", "rgb(95, 60, 19)");

               $("#no-of-beds>*").addClass('fa-solid fa-bed');
               $("#no-of-beds>*").removeClass('fas fa-apple-alt');

                $('#sleep-duration').text('hours')

                $('#assume-text').text('Assume each bed is 1 hour.')

                $('#total-slept').removeClass('hidden');

                $('#sleep-type').val(this.value);
            }


            // IF MILK
            if(this.value == 2) {

                // $(".primary-sleep-form").css("background-color", "rgb(254,250,235)");
                // $(".primary-sleep-form").css("color", "rgb(0, 0, 0)");
                // $(".secondary-sleep-form").css("background-color", "rgb(135, 135, 135)");
                // $(".tertiary-water-form").css("background-color", "rgb(125, 125, 125)");

                $("#no-of-beds>*").addClass('fa-solid fa-bed');
                $("#no-of-beds>*").removeClass('fas fa-apple-alt');
                
                $('#sleep-duration').text('hours')

                $('#assume-text').text('Assume each bed is 1 hour.')

                $('#total-slept').removeClass('hidden');

                $('#sleep-type').val(this.value);
            }

            // IF FRUIT
            if(this.value == 3) {

            
                // $(".primary-sleep-form").css("background-color", "rgb(0, 80, 0)");
                // $(".primary-sleep-form").css("color", "rgb(0, 230, 0)");
                // $("#no-of-beds>*").removeClass('fa-solid fa-bed');
                // $("#no-of-beds>*").addClass('fas fa-apple-alt');



                // $(".secondary-sleep-form").css("background-color", "rgb(0, 155, 0)");
                // $(".tertiary-water-form").css("background-color", "rgb(0, 135, 0)");
                
                $('#sleep-duration').text('pieces');

                $('#assume-text').text('Assume each bed is 1 hour.')

                $('#total-slept').addClass('hidden');

                $('#sleep-type').val(this.value);

            }

            $('.sleep-type').text($(this).find(":selected").attr('text-value'))



        });


        

    </script>   

</x-app-layout>
