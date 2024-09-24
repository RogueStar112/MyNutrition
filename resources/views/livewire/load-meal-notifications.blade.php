<div id="notifications-base" class="rounded-lg absolute top-[100%] bg-slate-900 max-h-[440px] overflow-y-scroll w-[256px] right-0" x-show="expand_notifications">

    <div class="text-2xl italic text-left font-extrabold px-4 border-b-4 border-b-slate-500" >NOTIFICATIONS</div>

    @foreach ($mealNotifications as $notification)
        @livewire('meal-notification', ['mealId' => $notification['id'], 'message' => $notification['message']], key($notification['id'])))

        <livewire:meal-notification :id="$id" :message="$message" />
    @endforeach
</div>