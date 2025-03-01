<nav class="bg-white dark:bg-slate-800 dark:text-white border-b border-gray-800" x-data="{ open : true }">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current dark:fill-white text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('nutrition_mainMenu')" :active="request()->routeIs('nutrition_mainMenu')">
                        {{ __('Nutrition') }}
                    </x-nav-link>

                    <x-nav-link :href="route('changelog')" :active="request()->routeIs(['changelog'])">
                        {{ __('Changelog') }}
                    </x-nav-link>

                    <x-nav-link :href="route('nutrition_advancedMenu')" :active="request()->routeIs(['nutrition_advancedMenu', 'suggester'])">
                        {{ __('Advanced') }}
                    </x-nav-link>

                
                </div>

                <!-- Links Before User -->

                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 sm:gap-8">

                {{-- @livewire('show-meal-notifications') --}}
                

                <form id="NOTIFICATION-FORM" class="relative" method="GET"  x-data="{ expand_notifications: false }">
                    @csrf
                    <button type="submit" id="notification-bell" class="flex relative justify-end fill-white text-3xl has-notifications cursor-pointer"" x-on:click="expand_notifications = ! expand_notifications" >
            
                        <div id="notifications-found" class="absolute bottom-0 right-0 bg-red-500 w-3 h-3 z-50 animate-ping rounded-full select-none hidden">
                        
                        </div>  

                        <div id="notifications-found-base" class="absolute bottom-0 right-0 bg-red-500 w-3 h-3 z-50 rounded-full text-sm select-none hidden">
                        
                        </div>  

                        {{-- <div id="notifications-base" class="rounded-lg absolute top-[100%] bg-slate-900 h-[128px] w-[256px]"  x-show="expanded">

                            <div class="text-2xl italic text-left font-extrabold px-4" >NOTIFICATIONS</div>


                            <div id="notification-meal" class="w-full bg-slate-900 text-white text-[12px] whitespace-normal indent-0 leading-none text-justify px-4 relative items-start">
                                
                                <span class="text-slate-400">1)</span>
                                Your meal named Meal Deal has passed the time planned (08/08/2023 11:00). Have you eaten this meal?


                                <div class="flex w-full px-4 justify-around items-end [&>*]:p-2 [&>*]:w-full [&>*]:text-center mt-2 gap-4">
                                    <div class="bg-green-600">YES</div>
                                    <div class="bg-red-600">NO</div>
                                </div>

                            </div>

                        
                            
                        </div>   --}}

                        <svg class="invert" width="24px" height="24px" viewBox="0 0 32 32" id="Lager_95" data-name="Lager 95" xmlns="http://www.w3.org/2000/svg">
                            <g id="Rectangle_1" data-name="Rectangle 1" transform="translate(4)" fill="none" stroke="#040505" stroke-miterlimit="10" stroke-width="4">
                            <path d="M12,0h0A12,12,0,0,1,24,12V24a0,0,0,0,1,0,0H0a0,0,0,0,1,0,0V12A12,12,0,0,1,12,0Z" stroke="none"/>
                            <path d="M12,2h0A10,10,0,0,1,22,12v8a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V12A10,10,0,0,1,12,2Z" fill="none"/>
                            </g>
                            <rect id="Rectangle_2" data-name="Rectangle 2" width="32" height="4" rx="2" transform="translate(0 20)" fill="#040505"/>
                            <path id="Path_9" data-name="Path 9" d="M16,32h0a4,4,0,0,1-4-4V26h8v2A4,4,0,0,1,16,32Z" fill="#040505"/>
                        </svg>

                        <span class="hidden relative /flex mr-3 h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    </button>

                    {{-- <livewire:meal-notification-livewire :id=20 /> --}}

                    {{-- @foreach ($mealNotifications as $mealNotification)
                        <livewire:meal-notification-livewire :id="$mealNotification->id" />
                    @endforeach --}}

                    <div id="notifications-base" class="rounded-lg absolute top-[100%] bg-slate-900 max-h-[440px] overflow-y-scroll w-[256px] right-0"  x-show="expand_notifications ">

                        <h2 class="text-2xl italic font-extrabold m-4 text-center">NOTIFICATIONS</h2>

                        @if(count($mealNotifications) == 0)

                            <p class="text-center text-white">No notifications.</p>

                        @else

                            <p class="text-slate-500 text-center"><i class="fas fa-bell gap-4"></i> {{count($mealNotifications)}}</p>

                        @endif

                        @foreach ($mealNotifications as $mealNotification)
                            @foreach($mealNotification as $notification)
                                @isset($notification->id)
                                  <livewire:meal-notification-livewire :id="$notification->id" />
                                @endisset
                            @endforeach
                         @endforeach
                        {{-- <div class="text-2xl italic text-left font-extrabold px-4 border-b-4 border-b-slate-500" >NOTIFICATIONS</div>


                        <div id="notification-meal" class="w-full bg-slate-900 text-white text-[12px] whitespace-normal indent-0 leading-none text-justify px-4 relative items-start">
                            
                            <span class="text-slate-400">1)</span>
                            Your meal named Meal Deal has passed the time planned (08/08/2023 11:00). Have you eaten this meal?


                            <div class="flex w-full px-4 justify-around items-end [&>*]:p-2 [&>*]:w-full [&>*]:text-center mt-2 gap-4">
                                <div class="bg-green-600">YES</div>
                                <div class="bg-red-600">NO</div>
                            </div>

                        </div> --}}

                    
                        
                    </div>  

                    {{-- <script>
                        document.addEventListener('click', function(event) {
                            const notificationsBase = document.getElementById('notifications-base');
                            const notificationBell = document.getElementById('notification-bell');

                            // Check if the click is outside the notification dropdown and the bell button
                            if (notificationsBase && !notificationsBase.contains(event.target) && !notificationBell.contains(event.target)) {
                                // Close the dropdown
                                Alpine.store('expanded_notifications', false); // Assuming you're using Alpine.js for x-data
                            }
                        });
                    </script> --}}
                </form>

                

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:fill-white dark:text-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out dark:bg-slate-800 dark:text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': ! open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': ! open, 'hidden': open}" class="hidden sm:hidden dark:bg-slate-800 dark:text-white dark:focus:bg-slate-900">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('nutrition_mainMenu')" :active="request()->routeIs('nutrition_mainMenu')">
                {{ __('Nutrition') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

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
                                $('#notifications-found-base').html(response)

                                if(response > 0) {
                                    $('#notifications-found').removeClass('hidden')
                                    $('#notifications-found-base').removeClass('hidden')
                                }
                            }

            });
        });
        
         $('#notification-bell').on("click", function(e) {
            e.preventDefault();

            $.ajax({
                            url: `/nutrition/notifications/load`,
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
                                // console.log(response)
                                // $('#notifications-base').html(response)

                                // response_Keys = Object.keys(response);

                                // console.log(response)
                                // console.log(response_Keys);
                                
                               let notificationsContainer = $('#notifications-base'); // Or any other suitable container
                                notificationsContainer.empty(); // Clear previous notifications if needed

                                $.each(response.components, function(index, componentHtml) {
                                    notificationsContainer.append(componentHtml);
                                });
                            }

            });
         })

         
    </script>

</nav>
