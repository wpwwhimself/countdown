@extends("shipyard::layouts.admin")
@section("title", "Zegary")

@section("content")

<div class="flex down stagger-contents">
    @foreach(Auth::user()->subjects as $subject)
    <x-shipyard::app.section
        :title="$subject->name"
        :icon="$subject->icon"
        :extended="true"
        style="border-color: {{ $subject->color }};"
        inner-class="stagger-contents"
    >
        @foreach ($subject->entries as $entry)
            <x-entry.clock :entry="$entry" />
        @endforeach
    </x-shipyard::app.section>
    @endforeach
</div>

@endsection
