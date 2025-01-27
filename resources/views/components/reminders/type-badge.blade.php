<div class="inline-block w-6 h-6 text-gray-700 dark:text-gray-300 text-base">
    @if($type === 'Task')
        <x-heroicon-c-pencil-square title="Task"/>
    @elseif($type === 'Event')
        <x-heroicon-c-calendar title="Event"/>
    @endif
</div>

