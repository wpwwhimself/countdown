@extends("shipyard::layouts.admin")
@section("title", "Zegary")

@section("content")

<div class="flex down stagger-contents">
    @foreach(Auth::user()->subjects as $subject)
    <x-shipyard::app.section
        :title="$subject->name"
        :subtitle="$subject->description"
        :icon="$subject->icon"
        :extended="true"
        style="border-color: {{ $subject->color }};"
        inner-class="flex right stagger-contents"
    >
        @foreach ($subject->entries as $entry)
        <x-entry.clock :entry="$entry" />
        @endforeach

        <x-slot:actions>
            <x-shipyard::ui.button
                icon="tag-plus"
                pop="Dodaj nowy wpis"
                action="none"
                onclick="openModal('add-entry', { subject_id: {{ $subject->id }}, })"
                class="tertiary"
            />
        </x-slot:actions>
    </x-shipyard::app.section>
    @endforeach

    <div class="flex right center middle">
        <x-shipyard::app.card>
            <x-shipyard::ui.button
                icon="folder-plus"
                label="Dodaj nowy temat"
                :action="route('admin.model.edit', ['model' => 'subjects'])"
                class="primary"
            />
            <x-shipyard::ui.button
                icon="database"
                label="Zarządzaj danymi"
                :action="route('admin.models')"
            />
        </x-shipyard::app.card>
    </div>
</div>

@endsection
