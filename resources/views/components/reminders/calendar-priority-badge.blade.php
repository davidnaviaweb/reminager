@php
    $config = \App\Enums\ReminderPriority::getConfig($priority);
@endphp
<span class="flex flex-grow-0 flex-shrink-0 h-3 rounded-full self-center w-3" style="background-color: {{$config['color']}};" title="{{$config['label']}}"></span>
