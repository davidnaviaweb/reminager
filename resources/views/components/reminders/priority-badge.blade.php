@php
    $config = \App\Enums\ReminderPriority::getConfig($priority);
@endphp
<div class="flex items-center justify-center border-2 rounded-full text-white font-extrabold w-10 h-10"
     style="color: {{$config['color']}}; border-color: {{$config['color']}};"
     title="{{ $config['label'] }}">
    <span class="font-serif text-xl mx-auto">{{ $config['text'] }}</span>
</div>
