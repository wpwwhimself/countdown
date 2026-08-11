@props([
    "entry"
])

@php
$occurence = $entry->occurences->last();
@endphp

<x-shipyard::app.card
    class="entry-clock"
    inner-class="flex down middle no-gap"
>
    <strong role="entry-name" class="accent primary">
        {{ $entry->name }}
    </strong>
    <span role="subject-name" class="subject-name ghost">
        {{ $entry->subject }}
    </span>
    <span role="entry-date">
        {{ $occurence }}
    </span>

    <svg role="clock" width="100%" height="100%">
        <rect class="clock-hand" x="calc(50% - 3px)" y="0" width="3px" height="50%"
            style="rotate: {{ $occurence->rotation }}deg;"
        />
    </svg>
</x-shipyard::app.card>
