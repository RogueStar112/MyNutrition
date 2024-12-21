<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>{{ config('app.name', 'MyNutrition') }}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        {{-- <link rel="stylesheet" href="dist/fontawesome-5.11.2/css/all.min.css" /> --}}


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script
			  src="https://code.jquery.com/jquery-3.7.0.min.js"
			  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
			  crossorigin="anonymous"></script>
        <script
			  src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
			  integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
			  crossorigin="anonymous"></script>




        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @livewireStyles

    </head>
    <body class="font-sans antialiased bg-slate-700">
        <div class="min-h-screen dark:bg-slate-700">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-slate-700">
                    <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="dark:bg-slate-700 h-full relative">

                {{ $slot }}

                @if(Route::currentRouteName() === 'meal.create' || Route::currentRouteName() === 'food.create')

                    <!-- Page Heading -->

                    <div id="MOBILE-WIDGETS" class="w-full h-min flex flex-col md:hidden justify-end absolute sticky bottom-[4rem] gap-8 select-none">

                        <div class="relative m-6">
                            <div id="NOTIFICATIONS-COUNT-MOBILE" class="absolute bottom-[-11px] right-[-11px] w-6 h-6 bg-orange-500 text-white rounded-full z-[9999] flex items-center justify-center text-center" value="0">0</div>
                            <button id="SHOW-NOTIFICATIONS-BTN-MOBILE" class="bg-orange-500 absolute top-0 right-0 text-white  sm:hidden rounded-full z-[9998] [&>*]:z-9999  cursor-pointer w-[3rem] h-[3rem]"> 
                                <i id="SHOW-NOTIFICATIONS-ICON-MOBILE" class="fa-solid fa-bell text-2xl select-none"></i>
                            </button>
                        </div>

                        <div class="relative m-6">
                            <div id="ITEMS-COUNT-MOBILE" class="absolute bottom-[-11px] right-[-11px] w-6 h-6 bg-orange-700 text-white rounded-full z-[9999] flex items-center justify-center text-center" value="0">0</div>
                            <button id="SHOW-ITEMS-BTN-MOBILE" class="select-all bg-orange-600 absolute top-0 right-0 text-white flex justify-center items-center sm:hidden rounded-full z-[9998] [&>*]:z-9999 top-0 cursor-pointer w-[3rem] h-[3rem]"> 
                                <i id="SHOW-ITEMS-ICON" class="fa-solid fa-cart-shopping text-2xl select-none"></i></button>
                        </div>


                    </div>

                        

                @endif


            </main>
        </div>

        <script src="node_modules\chart.js\dist\chart.umd.js"></script>
        <script>
            const myChart = new Chart(ctx, {...});
        </script>

        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

        
        <script>
            // var meal_json = {};
            
            // $(document).ready(function () {
            //     $( "#FOOD-ITEMS-CONTAINER" ).on( "change", function() {
            //         console.log('This should work POTATOLAND')
            //         $("#ITEMS-COUNT-MOBILE").text(`${meal_json.length}`)
            //     })
            // });
        </script>
        @livewireScripts
    </body>
</html>