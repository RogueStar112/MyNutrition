<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles --> 
    

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
        <!--         -->



    </head>
    <body class="antialiased max-w-[1600px] mx-auto">
      <nav class="flex justify-between items-center m-4 text-3xl font-extrabold">
        <img class="mx-auto md:mx-0" src="{{ asset('img/mynutritionlogo_upscaled.png')}}" width="256" height="256" alt="">

        <div class="flex hidden sm:flex sm:flex-row justify-around text-[#CF1909] gap-8">
            <a href="{{ route('login') }}">Login</a>

            <a href="{{ route('register') }}">Register</a>
        
            <p>Contact</p>
        </div>
      </nav>

      <div class="login-mobile flex sm:hidden justify-around text-[#CF1909] gap-8 text-2xl">
        <a href="{{ route('login') }}">Login</a>

        <a href="{{ route('register') }}">Register</a>
    </div>

      <header class="bg-orange-500 h-32 w-full my-4 flex items-center justify-center opacity-60 hidden">

        <p class="text-white text-3xl">INTRODUCTORY OFFER: 50% OFF MyNutrition Premium if you preorder!</p>

      </header>

      <main id="hero" class="grid md:grid-cols-[2fr_3fr] items-center relative">

        <div class="hero-text text-5xl md:text-8xl font-extrabold text-[#CF1909] relative text-center md:text-left my-24">

            Conquer your fitness goals <div class="md:absolute md:-right-[24.33%] md:bg-orange-800 md:text-white p-4 z-50 rounded-lg"><span>to</span><span class="md:text-white">day</span></div>

        </div>
        

        <div class="relative overflow-hidden">
            <img src="{{ asset('img/pexels-maksgelatin-4348629.jpg') }}" class="rounded-lg" alt="">


            <div class="absolute -bottom-8 -right-8 bg-orange-600 rounded-full w-48 h-48"></div>

            <div class="absolute -top-8 -left-8 bg-orange-600 rounded-full w-32 h-32"></div>
        </div>
        

        <div class="w-full h-32 bg-gradient-to-r from-orange-600 to-orange-400 flex items-center justify-center rounded-tr-lg relative">

            <div class="absolute -top-16 -left-4 bg-orange-400 rounded-full w-32 h-32"></div>

            <p class="text-white text-6xl font-black">Features</p>
{{-- 
            <div class="absolute -bottom-16 -right-4 bg-orange-600 rounded-full w-32 h-32 bg-white"></div> --}}

        </div>
      </main>

      <div class="bg-orange-600 w-full sm:h-screen [&>*]:px-16 [&>*]:text-white [&>*]:text-center grid md:grid-cols-3 grid-rows-[300px]">

        <div>
            <p class="text-5xl font-extrabold pt-16">Meal Logging</p>
            <p class="pt-4 text-2xl">Log your meals from a pre-existing database.</p>
        </div>

        <div>
            <p class="text-5xl font-extrabold pt-16">Dashboards</p>
            <p class="pt-4 text-2xl">See how far your progress has come.</p>
        </div>

        <div>
            <p class="text-5xl font-extrabold pt-16">Water Tracking</p>
            <p class="pt-4 text-2xl">Track your fluid intake to stay hydrated.</p>
        </div>

        <div>
            <p class="text-5xl font-extrabold pt-16">Meal Planning</p>
            <p class="pt-4 text-2xl">To prevent over/undereating, you can plan meals in the future.</p>
        </div>

        <div>
            <p class="text-5xl font-extrabold pt-16">Macro Goals</p>
            <p class="pt-4 text-2xl">Set your calorie goals.</p>
        </div>

        
        <div>
            <p class="text-5xl font-extrabold pt-16">Achievements</p>
            <p class="pt-4 text-2xl">Cause no achievement goes unnoticed!</p>
        </div>

      </div>

      <footer class="sticky bottom-0 h-32 bg-orange-800 text-white text-4xl flex items-center justify-center">

            &copy; 2025 Demie M.

      </footer>
    </body>
</html>
