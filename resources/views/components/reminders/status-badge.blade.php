@php
    $config = \App\Enums\ReminderStatus::getConfig($status);
@endphp
<p class="px-2 py-1 inline-block rounded text-white"
   style="background-color: {{$config['bg-color']}}">
    {{ $config['label'] }}
</p>
