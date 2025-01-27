<div class="flex flex-wrap gap-1 justify-{{$justify ?? '-around'}}">
    @foreach($labels as $label)
        <x-label-badge :label="$label" />
    @endforeach
</div>
