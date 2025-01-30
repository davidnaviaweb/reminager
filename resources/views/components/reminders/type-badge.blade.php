@php
    $config = \App\Enums\ReminderType::getConfig($type);
@endphp
<div class="inline-block w-10 h-10">
    <x-dynamic-component :component="'heroicon-' . $config['icon']" :title="$config['label']"/>
</div>

