<!DOCTYPE html>
 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="{{ auth()->user()->theme }}">
 
    <head>
 
        <meta charset="utf-8">
 
        <meta name="viewport" content="width=device-width, initial-scale=1">
 
        <meta name="csrf-token" content="{{ csrf_token() }}">
 


 

        <meta property="og:title" content="MyNutrition">
 

        <meta property="og:description" content="Powered by Laravel">
 

        <meta property="og:image" content="{{ asset('img/mynutritionlogo_upscaled.jpg') }}">
 

        <meta property="og:url" content="{{ url()->current() }}">
 

        <meta property="og:type" content="website">
 

 
        <title>MyNutrition</title>
 

 
        <link rel="icon" href="{{ asset('img/mynutritionlogo_scales_upscaled.png') }}">
 

 
        <!-- Fonts -->
 
        {{-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" /> --}}
 
        <link rel="preconnect" href="https://fonts.bunny.net">
 
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        {{-- <link rel="stylesheet" href="dist/fontawesome-5.11.2/css/all.min.css" /> --}}
 

 
        <script>
            // Get saved theme from localStorage
            const savedTheme = localStorage.getItem('theme') || '{{ session('theme', 'light') }}';
    
            // Apply theme *before* rendering
            // if (savedTheme !== 'light') {
            //     document.documentElement.classList.add(`theme-${savedTheme}`);
            // }
        </script>
 
        <!-- Scripts -->
 
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link href="resources/css/app.css" rel="stylesheet">

        {{-- <link href="{{asset('resources/css/app.css')}}" rel="stylesheet">
        <link href="resources/css/app.js" rel=""> --}}

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
 
    <body class="antialiased bg-slate-700">
 
        <div class="min-h-screen bg-slate-100 dark:bg-slate-700 min-h-screen">
 
            @include('layouts.navigation')
 

 
            <!-- Page Heading -->
 
            @if (isset($header))
 
                <header class="dark:bg-slate-700 bg-slate-100">
 
                    <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
 
                        {{ $header }}
 
                    </div>
 
                </header>
 
            @endif
 

 
            <!-- Page Content -->
 
            <main class="dark:bg-slate-700 h-full relative overflow-hidden">
 

 
                {{ $slot }}
 

 
                @if(Route::currentRouteName() === 'meal.create' || Route::currentRouteName() === 'food.create')
 

 
                    <!-- Page Heading -->
 

 
                
 
                    <div class="fixed sm:hidden bottom-4 right-4 flex flex-col gap-6 z-[9999]">
                        <!-- Notification Button -->
                        <div class="relative">
                            <div id="NOTIFICATIONS-COUNT-MOBILE" class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-center" value="0">0</div>
                            <button id="SHOW-NOTIFICATIONS-BTN-MOBILE" class="bg-orange-500 text-white rounded-full cursor-pointer w-[3rem] h-[3rem] flex items-center justify-center"> 
                                <i id="SHOW-NOTIFICATIONS-ICON-MOBILE" class="fa-solid fa-bell text-2xl select-none"></i>
                            </button>
                        </div>
                    
                        <!-- Cart Button -->
                        <div class="relative">
                            <div id="ITEMS-COUNT-MOBILE" class="absolute -top-2 -right-2 w-6 h-6 bg-orange-700 text-white rounded-full flex items-center justify-center text-center" value="0">0</div>
                            <button id="SHOW-ITEMS-BTN-MOBILE" class="bg-orange-600 text-white flex justify-center items-center rounded-full cursor-pointer w-[3rem] h-[3rem]"> 
                                <i id="SHOW-ITEMS-ICON" class="fa-solid fa-cart-shopping text-2xl select-none"></i>
                            </button>
                        </div>
                    </div>

 

 
    
 

 

 

 
                @endif
 

 

 
            </main>
 
        </div>
 

 
        <script src="node_modules\chart.js\dist\chart.umd.js"></script>
 
        <script>
 
            const myChart = new Chart(ctx, {...});
 
        </script>
 

{{--  
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
 
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
  --}}

 

 
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