@extends("shipyard::layouts.admin")

@section("content")

<x-shipyard::app.section
    title="Witaj w KTB!"
    icon="hand-wave"
>
    <p>
        W tej aplikacji możesz uporządkować i śledzić <strong class="accent primary">wystąpienia ważnych dla Ciebie wydarzeń</strong>, np.:
    </p>
    <ul>
        <li>kiedy był ostatni przegląd Twojego samochodu i kiedy będzie następny?</li>
        <li>kiedy zakupiony został Twój odkurzacz i kiedy kończy się jego gwarancja?</li>
        <li>kiedy ukochana osoba ma urodziny?</li>
    </ul>
    <p>
        Każde z tych zdarzeń będzie wyświetlone w postaci małego zegara odliczającego czas do lub od wydarzenia.
    </p>

    @auth
    <div class="flex right center middle">
        <x-shipyard::ui.button
            label="Zegary"
            icon="clock"
            :action="route('clocks')"
        />
    </div>
    @else
    <p><strong>Załóż konto, aby zacząć śledzić swoje wydarzenia!</strong></p>
    @endauth
</x-shipyard::app.section>

@endsection
