@php
    $config = \App\Enums\ReminderType::getConfig($type);
@endphp
<div class="inline-block w-6 h-6 text-gray-700 dark:text-gray-300 text-base">
    <x-dynamic-component :component="'heroicon-' . $config['icon']" :title="$config['label']"/>
</div>

