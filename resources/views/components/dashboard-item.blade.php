<div class="h-full bg-slate-200 dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg col-span-{{ $colspan }} text-{{$textalign}}">
    <div class="relative p-6 text-gray-900 dark:text-white">
        <h1 class="text-2xl /uppercase font-extrabold">{{$heading}}</h1>
        {{ $slot }}
        <i class="absolute {{$icon}} -translate-y-1/2 translate-x-1/2 opacity-70 right-[10%]"></i>
    </div>


</div>