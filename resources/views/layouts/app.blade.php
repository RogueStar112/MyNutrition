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

        {{-- <script
 
			  src="https://code.jquery.com/jquery-3.7.0.min.js"
 
			  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
 
			  crossorigin="anonymous"></script> --}}
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
        <script
 
			  src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
 
			  integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
 
			  crossorigin="anonymous"></script>
  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation@2.2.1/dist/chartjs-plugin-annotation.min.js"></script>
        
 
        <script src="//unpkg.com/alpinejs" defer></script>

 

        
 
        @livewireStyles
 

 
    </head>
 
    <body class="antialiased bg-slate-700">
        
        <div class="min-h-screen bg-slate-100 dark:bg-slate-700">
            
            @include('layouts.navigation')
 

 
            <!-- Page Heading -->
            
            <div id="HEADER-MAIN-WRAPPER" class="relative">

            <div id="MOBILE-NOTIFICATIONS-CONTAINER" class="hidden fixed top-[calc(0px+6rem)] /top-[calc(50%-8rem)] top-1/2 left-1/2 blur-none! text-white z-[9999] translate-y-0 -translate-x-1/2 bg-slate-800 w-[calc(100%-2rem)] h-[calc(100%-2rem)] rounded-lg text-left p-6 text-2xl font-black italic">
                NOTIFICATIONS

                <div class="flex flex-col gap-2" id="MOBILE-NOTIFICATIONS-INNER">
                    @foreach ($mealNotifications as $mealNotification)
                            @foreach($mealNotification as $notification)
                                @isset($notification->id)
                                  <livewire:meal-notification-livewire :id="$notification->id" />
                                @endisset
                            @endforeach
                         @endforeach
                </div>
            </div>


            @if (isset($header))
 
                <header class="dark:bg-slate-700 bg-slate-100 " id="HEADER">
 
                    <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
 
                        {{ $header }}
 
                    </div>
 
                </header>
 
            @endif
 

 
            <!-- Page Content -->
 
            <main class="dark:bg-slate-700 h-full relative" id="MAIN">
 

 
                {{ $slot }}
 

 
 
                    <!-- Page Heading -->
 

 
                
 
                    <div class="fixed sm:hidden bottom-4 right-4 flex flex-col gap-6 z-[9999]">
                        <!-- Notification Button -->
                        <div class="relative" id="NOTIFICATIONS-BTN-MOBILE">

                            <div id="NOTIFICATIONS-COUNT-DOT" class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-center" value="0"></div>

                            <div id="NOTIFICATIONS-COUNT-MOBILE" class="absolute -top-2 -right-2 w-6 h-6 bg-orange-500 text-white rounded-full flex items-center justify-center text-center" value="0">0</div>

                            <button id="SHOW-NOTIFICATIONS-BTN-MOBILE" class="bg-orange-500 text-white rounded-full cursor-pointer w-[3rem] h-[3rem] flex items-center justify-center"> 
                                <i id="SHOW-NOTIFICATIONS-ICON-MOBILE" class="fa-solid fa-bell text-2xl select-none"></i>
                            </button>
                        </div>
                        
                        
                        @if(Route::currentRouteName() === 'meal.create' || Route::currentRouteName() === 'food.create' || Route::currentRouteName() === 'meal.edit_form')
 

                            <!-- Cart Button -->
                            <div class="relative">
                                <div id="ITEMS-COUNT-MOBILE" class="absolute -top-2 -right-2 w-6 h-6 bg-orange-700 text-white rounded-full flex items-center justify-center text-center" value="0">0</div>
                                <button id="SHOW-ITEMS-BTN-MOBILE" class="bg-orange-600 text-white flex justify-center items-center rounded-full cursor-pointer w-[3rem] h-[3rem]"> 
                                    <i id="SHOW-ITEMS-ICON" class="fa-solid fa-cart-shopping text-2xl select-none"></i>
                                </button>
                            </div>

                        
                        @endif
                    </div>

 

 
    
 

 

 

 
 

 

 
            </main>
            </div>
 
        </div>
 

{{--  
        <script src="node_modules\chart.js\dist\chart.umd.js"></script> --}}
 
        <script>
 
            // const myChart = new Chart(ctx, {...});
 
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
        

        <script>
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
   
            $( document ).ready(function() {
               $.ajax({
                               url: `/nutrition/notifications/load_count`,
                               method: 'GET',
                               headers: {
                                   'X-CSRF-TOKEN': csrfToken
   
                               },
                               data: {
                                   
                                   // no_of_foods: no_of_foods,
                                   // balancer: replacement_balancer,
                                   // query: query,
                                   // servingSize: servingSize,
                                   // quantity: quantity
                                   // ignoreServingSize: ignoreServingSize
                               },
                               success: function(response) {
                                   console.log(response)

                                   $('#NOTIFICATIONS-COUNT-MOBILE').html(response)
   
                                   if(response > 0) {
                                       $('#notifications-found').removeClass('hidden')
                                       $('#notifications-found-base').removeClass('hidden')
                                       $('#NOTIFICATIONS-COUNT-DOT').addClass('animate-ping')
                                   }
                               }
   
               });
           });

           $('#SHOW-NOTIFICATIONS-BTN-MOBILE').on("click", function(e) {


                               let notificationsContainer_div = $('#MOBILE-NOTIFICATIONS-CONTAINER');
                                   notificationsContainer_div.toggleClass('hidden');

                               let notificationsIcon = $('#SHOW-NOTIFICATIONS-ICON-MOBILE');
                                   notificationsIcon.toggleClass('fa-bell');
                                   notificationsIcon.toggleClass('fa-x');
                                
                            //    let notificationsContainer = $('#MOBILE-NOTIFICATIONS-INNER'); // Or any other suitable container
                            //     notificationsContainer.empty(); // Clear previous notifications if needed
                                


                            //     $.each(response.components, function(index, componentHtml) {
                            //         notificationsContainer.append(componentHtml);
                            //     });
                            }

                        
         )

        </script>
    </body>
</html>