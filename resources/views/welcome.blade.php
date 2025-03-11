<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MyNutrition</title>

        
        <!-- Icon -->
        <link rel="icon" href="{{ asset('img/mynutritionlogo_scales_upscaled.png') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        {{-- <link rel="stylesheet" href="dist/fontawesome-5.11.2/css/all.min.css" /> --}}
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
    <body class="antialiased mx-auto overflow-x-hidden bg-white dark:bg-gray-800 min-h-screen">

      <header>
        <nav class="flex justify-between items-center mx-auto text-3xl font-extrabold / /sticky top-0 z-50 bg-transparent max-w-[1600px]">
            <img class="mx-auto md:mx-0" src="{{ asset('img/mynutritionlogo_upscaled.png')}}" width="128" height="128" alt="">

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
      </header>

      {{-- <header class="bg-orange-500 h-32 w-full my-4 flex items-center justify-center opacity-60 hidden">

        <p class="text-white text-3xl">INTRODUCTORY OFFER: 50% OFF MyNutrition Premium if you preorder!</p>

      </header> --}}

      <main class="container mx-auto">
        <div id="hero" class="md:grid md:grid-cols-[2fr_3fr] items-center relative  h-full mx-auto">

            <div class="hero-text text-5xl md:text-8xl font-extrabold relative text-center md:text-left md:my-24 text-white md:text-[#CF1909] py-12 z-50">

                Conquer your 
                
                <div class="flex gap-4 items-center justify-center sm:justify-start relative">
                
                    <div id="slideshow-text" class="flex items-center /gap-4 relative overflow-hidden max-w-[179.5px] sm:max-w-[327.017px] /[&>*]:flex-1"  style="right: 0px;">

                        <div id="slideshow-wrapper" class="slideshow-wrapper flex overflow-hidden" style="right: 20px; border-radius:
                            30% 70% 58% 42% / 70% 58% 42% 30%">
                            <div class="bg-orange-500 text-white p-4 rounded-lg">fitness</div>
                            <div class="bg-orange-500 text-white p-4 rounded-lg">fitness</div>
                            <div class="bg-orange-500 text-white p-4 rounded-lg">fitness</div>                    
                            <div class="bg-orange-500 text-white p-4 rounded-lg">fitness</div>
                            <div class="bg-orange-500 text-white p-4 rounded-lg">fitness</div>
                        </div>
                    </div> 
                    
                    <div>goals</div>
                </div>         
                
                <div class="md:absolute md:-right-[24.33%] bg-orange-800 md:text-white md:p-4 z-40 rounded-lg select-none"><span>to</span><span class="md:text-white">day</span></div>

            </div>
            
            <div class="absolute top-0 md:relative z-0">

                <div class="relative overflow-hidden h-full [&>img]:object-cover z-30" style="border-radius:
    83% 17% 90% 10% / 23% 84% 16% 77%;">
                    <img src="{{ asset('img/pexels-maksgelatin-4348629.jpg') }}" class="top-0 rounded-lg /opacity-70 z-50"  alt="">

                    <img class="absolute top-0 bg-gradient-to-r from-transparent to-orange-500 z-0 left-0 hidden /opacity-60" src="{{ asset('img/pexels-ella-olsson-572949-1640774.jpg')}}" alt="">

                    <div class="absolute sm:-bottom-8 -bottom-0 -right-8 bg-orange-600 rounded-full sm:w-48 sm:h-48 w-16 h-16"></div>

                    <div class="absolute sm:-top-8 -left-8 bg-orange-800 rounded-full sm:w-48 sm:h-48 w-16 h-16 z-10"></div>
                </div>

            </div>
            

            {{-- <div class="w-full h-32 bg-gradient-to-r from-orange-600 to-orange-400 flex items-center justify-center rounded-tr-lg relative">

                <div class="absolute -top-16 -left-4 bg-orange-400 rounded-full w-32 h-32 z-50 md:z-0"></div>

                <p class="text-white text-6xl font-black">Features</p>
    
                <div class="absolute -bottom-16 -right-4 bg-orange-600 rounded-full w-32 h-32 bg-white"></div>

            </div> --}}

    

        </main>

        
        <div class="grid grid-cols-1 px-12 md:px-0 md:grid-cols-3 mt-32 mx-auto text-orange-600 max-w-[1600px] [&>*]:text-center gap-4 [&>*>img]:h-[421px] [&>*>img]:object-cover" id="features">
            
            <div class="md:col-span-3 inline-block bg-gradient-to-r from-orange-400 via-red-500 to-orange-400 bg-clip-text text-7xl text-transparent font-black">FEATURES</div>
            <div class="text-center text-4xl font-extrabold mt-8">
                <p>Nutrition Tracking</p>
                
                <img class="mt-8 rounded-lg" src="{{ asset('img/mynutrition_nutritiontracking.png')}}" alt="">

                <p class="mt-8">Calories, Fat, Carbs and Protein are all tracked.</p>
            </div>
            <div class="text-center text-4xl font-extrabold mt-8">
                
                <p>Track your fluids</p>

                <img class="mt-8 rounded-lg" src="{{ asset( 'img/mynutrition_water.png' ) }}">

                <p class="mt-8">
                    Hydration is important, and you can track that down too!
                </p>
            </div>
            <div class="text-center text-4xl font-extrabold mt-8">
                <p>Meal Logging</p>

                <img class="mt-8 rounded-lg" src="{{ asset( 'img/mynutrition_meallog.png') }}">

                <p class="mt-8">
                    Track your meals, at any custom meal times you wish.
                </p>
            </div>


        </div>

        <div class="flex flex-col mt-16" id="slogan">
            <div class="flex flex-col sm:flex-row justify-center items-center [&>p]:text-orange-600 [&>p]:text-7xl gap-4 h-fit">
                <p class="text-orange-600 font-black hidden sm:flex">Whether</p>
                <img class="w-[250px] md:w-[350px]" src="{{ asset('img/dietimage_cropped.png')}}" width="350" alt="">        
                <p class="font-black">OR</p>
                <img  class="w-[350px] md:w-[450px]" src="{{ asset('img/exerciseimage_cropped.png')}}" width="400" alt="">
                <p class="hidden sm:flex">,</p>
            </div>

            <div class="flex justify-center items-center [&>p]:text-orange-600 [&>p]:text-7xl gap-6">
                <p>MyNutrition's got you covered.</p>
            </div>

        </div>

        {{-- <div class="bg-orange-600 w-full sm:h-[50vh] /[&>*]:px-16 [&>*]:text-white [&>*]:text-center flex place-items-center rounded-tr-lg  mx-auto items-center relative overflow-x-scroll text-center">

                <div id="slideshow-container" class="flex h-full place-items-center justify-start gap-4 text-center [&>*]:shrink-0 relative">

                    <div class="flex items-center justify-center selected absolute -left-2 text-2xl top-1/2 prev-slide w-12 h-12 bg-blue-500 rounded-full">

                        <
                        
                    </div>


                    <div class="flex items-center justify-center selected absolute -right-2 text-2xl top-1/2 next-slide w-12 h-12 bg-blue-500 rounded-full"> 

                        >

                    </div>
                    
                    
                    <div id="slides" class="bg-orange-800 flex items-center h-full overflow-x-scroll w-[640px] [&>*]:w-[640px] [&>*]:shrink-0 snap-x [&>*]:snap-center scroll-smooth">
                        <div>
                            <p class="text-5xl font-extrabold">Meal Logging</p>
                            <p class="pt-4 text-2xl">Log your meals from a pre-existing database.</p>
                        </div>

                        <div>
                            <p class="text-5xl font-extrabold">Dashboards</p>
                            <p class="pt-4 text-2xl">See how far your progress has come.</p>
                        </div>

                        <div>
                            <p class="text-5xl font-extrabold">Water Tracking</p>
                            <p class="pt-4 text-2xl">Track your fluid intake to stay hydrated.</p>
                        </div>

                        <div>
                            <p class="text-5xl font-extrabold">Meal Planning</p>
                            <p class="pt-4 text-2xl">To prevent over/undereating,<br>you can plan meals in the future.</p>
                        </div>

                        <div>
                            <p class="text-5xl font-extrabold">Macro Goals</p>
                            <p class="pt-4 text-2xl">Set your calorie goals.</p>
                        </div>

                        
                        <div>
                            <p class="text-5xl font-extrabold">Achievements</p>
                            <p class="pt-4 text-2xl">Cause no achievement goes unnoticed!</p>
                        </div>
                    </div>
                </div>

                <div>
                    

                </div>


                <div></div>
                <div></div>
        </div>  --}}

        <div style="position:relative;flex:none" class="">
            <div id="wave-container" class="">
                <svg class="" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ff5a1f" fill-opacity="1" d="M0,192L120,176C240,160,480,128,720,138.7C960,149,1200,203,1320,229.3L1440,256L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path></svg>
            </div>
        </div>
        
      </div>

      <footer class="/sticky bottom-0 bg-gradient-to-b from-orange-500 to-orange-800 text-white text-4xl flex flex-col items-center justify-center border-t-4 border-t-orange-500">

        <div class="grid grid-cols-1 sm:grid-cols-[1fr_3fr] w-full max-w-[1600px]">
          
            <div>
                <img src="{{ asset('img/MyNutrition_white.png')}}" alt="" class="pr-8 border-r-4 border-r-white/50">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2">
                <ul class="flex flex-col gap-4 ml-16 justify-center">
                    <li class="font-black">Socials</li>
                    <li><a href="https://www.linkedin.com/in/demie-mistica-049779296/"><i class="fab fa-linkedin  w-[45px] text-center"></i>  LinkedIn</a></li>
                    <li><a href="https://github.com/RogueStar112"><i class="fab fa-github w-[45px] text-center"></i>  GitHub</a></li>
                    <li><i class="fab fa-discord"></i>  Discord</li>
                </ul>
                

                <ul class="flex flex-col gap-4 ml-16 justify-center">
                    <li class="font-black">Other Projects</li>
                    <li>MyBudget</li>
                    <li>MyHabits</li>
                    <li><a href="https://www.demie-mistica.com">Portfolio</a></li>
                </ul>
            </div>


            <p class="col-span-full text-center py-12">&copy; 2025 Demie M.</p>  

        </div>



      </footer>

      <div class="absolute bottom-0">
      {{-- <svg class="fixed bottom-0 z-0 opacity-60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgb(208 56 1 / var(--tw-bg-opacity, 1))" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg> --}}

      {{-- <svg class="fixed bottom-0 z-0 opacity-80" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#d03801" fill-opacity="1" d="M0,256L30,250.7C60,245,120,235,180,234.7C240,235,300,245,360,245.3C420,245,480,235,540,218.7C600,203,660,181,720,144C780,107,840,53,900,26.7C960,0,1020,0,1080,48C1140,96,1200,192,1260,218.7C1320,245,1380,203,1410,181.3L1440,160L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg> --}}
      </div>

    </body>

    <script>
        
    </script>
</html>
