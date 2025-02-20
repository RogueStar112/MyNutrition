<div id="notification-meal-{{$mealId}}" class="py-4 w-full bg-slate-900 text-white text-[12px] whitespace-normal indent-0 leading-none text-center px-4 relative z-50 flex flex-col justify-left gap-4 items-start">
    <div class="grow text-justify">
        {{-- <span class="text-slate-400 grow">{{$key}})</span>  --}}

        @if($notificationType == 1)
            <p class="text-left w-full bg-gradient-to-b font-black text-xl from-red-600 via-green-500 to-orange-400 inline-block text-transparent bg-clip-text">MEAL PROMPT</p><br>
        @endif

        @if($notificationType == 2)
            <p class="text-left w-full bg-gradient-to-b font-black text-xl from-blue-600 via-orange-500 to-indigo-400 inline-block text-transparent bg-clip-text">MEAL REMINDER</p><br>
        @endif


        {{$message}}


    </div>

    <div class="flex w-full px-4 justify-around gap-4 items-end [&amp;>*]:p-2 [&amp;>*]:rounded-lg [&amp;>*]:w-fit gap-6 [&amp;>*]:text-center [&amp;>*]:cursor-pointer mt-2 min-w-max [&>*]:grow [&>*]:rounded-lg">

        @if($notificationType == 1)

        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white" wire:click="markAsEaten">Yes</button>
        <button type="button" class="bg-red-600 hover:bg-red-700 text-white" wire:click="markAsDeleted">No</button>
        <a href class="bg-yellow-600 hover:bg-yellow-700">Edit</button> 

        @endif

        @if($notificationType == 2)
        <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white" wire:click="dismissNotification">Dismiss</button>
        @endif

    </div>
    


</div>

