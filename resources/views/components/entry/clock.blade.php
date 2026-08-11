@props([
    "entry"
])

@php
$occurence = $entry->occurences->last();
@endphp

<x-shipyard::app.card
    class="entry-clock interactive"
    inner-class="flex down middle no-gap"
    onclick="openModal('add-occurence', {
        entry_id: {{ $entry->id }},
        date: '{{ date('Y-m-d') }}'
    })"
>
    <strong role="entry-name" class="accent primary">
        {{ $entry->name }}
    </strong>

    @if ($occurence)
    <span role="entry-big-number">{{ $occurence->bigNumber }}</span>

    <small role="entry-date" class="ghost" {{ Popper::pop($occurence->date->format('d.m.Y')) }}>
        {{ $occurence }}
    </small>
    <svg role="clock" width="100%" height="100%">
        <rect class="clock-hand" x="50%" y="0" width="3px" height="50%"
            style="rotate: {{ $occurence->rotation }}deg;"
        />
    </svg>

    @else
    <em class="accent error">brak wystąpień</em>
    @endif
</x-shipyard::app.card>
