<a href="{{route('reminders.show', $reminder)}}" wire:navigate class="w-full">
    <div class="flex flex-col sm:flex-row flex-1 justify-center sm:justify-start align-center">
        <x-reminders.calendar-priority-badge :priority="$reminder->priority"/>
        <span class="flex h-4 justify-center mt-1 sm:hidden text-center">{{$time}}</span>
        <span class="hidden text-base sm:inline ml-1 font-semibold truncate"
              title="{{$reminder->title}}">{{$reminder->title}}</span>
    </div>
    <div class="hidden sm:flex flex-1 justify-center sm:justify-start align-center mt-1">
        <span class="self-center"><x-heroicon-s-clock class="h-3 w-3"/></span>
        <span class="ml-1">{{$time}}</span>
    </div>
    <div
        class="flex-1 justify-center sm:justify-start align-center hidden sm:flex mt-2 pt-3 border-t border-t-gray-500">
        <x-reminders.labels-list :labels="$reminder->labels"/>
    </div>
</a>
