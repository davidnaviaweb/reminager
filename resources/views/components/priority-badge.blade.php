@php
    $config = match ($priority){
        'High' => [
            'color' => '#ff4d4d',
            'text' => '!!!',
            ],
        'Medium' => [
            'color' => '#ffcc00',
            'text' => '!!',
            ],
        'Low' => [
            'color' => '#5cb85c',
            'text' => '!',
            ],
        default => [
            'color' => 'gray',
            'text' => '?',
            ],
    }

@endphp
<div class="flex items-center justify-center border-2 rounded-full text-white font-extrabold w-10 h-10"
     style="color: {{$config['color']}};border-color: {{$config['color']}};">
    <span class="font-serif text-xl mx-auto">{{ $config['text'] }}</span>
</div>
