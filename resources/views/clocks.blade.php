@extends("shipyard::layouts.admin")
@section("title", "Zegary")

@section("content")

@foreach(Auth::user()->subjects as $subject)
<x-shipyard::app.section
    :title="$subject->name"
    :icon="$subject->icon"
    :extended="true"
    style="border-color: {{ $subject->color }};"
>
    @foreach ($subject->entries as $entry)
        <x-entry.clock :entry="$entry" />
    @endforeach
</x-shipyard::app.section>
@endforeach

@endsection
