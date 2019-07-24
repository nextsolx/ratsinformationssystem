@extends('layouts.app')

@section('content')
    <main class="ris-content ris-welcome">
        <div class="ris-welcome__content">
            <h1 class="ris-headline">
                Stadtpolitik Köln
            </h1>
            <div class="ris-body-1">
                Hier finden Sie Informationen rund um die Themen, welche aktuell in der Kölner Stadtpolitik behandelt werden.
            </div>

            <map-mobile-app class="map-mobile"></map-mobile-app>

            <section class="ris-card-list">
                <div class="ris-title">Kommende Stadtrat Sitzungen</div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">02.05.2019, 15:30 Uhr</div>
                    <a class="ris-link ris-link_has-icon">Ausschuss Soziales und Senioren</a>
                    <div class="ris-body-2">Historisches Rathaus, Konrad ....</div>
                </div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">02.05.2019, 15:30 Uhr</div>
                    <a class="ris-link ris-link_has-icon">Ausschuss Soziales und Senioren</a>
                    <div class="ris-body-2">Historisches Rathaus, Konrad ....</div>
                </div>

                <a href="{{ route('calendar') }}" class="ris-link ris-body2">
                    Zur Sitzungsübersicht
                </a>
            </section>

            <section class="ris-card-list">
                <div class="ris-title">Aktuelle Themen und Vorlagen</div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">Bürgereingabe: BV3/0020/2016</div>
                    <a class="ris-link ris-link_has-icon">Entwicklung einer Beteiligungskultur für Köln</a>
                    <div class="ris-body-2">Letzte Bearbeitung: 27.10.2018</div>
                </div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">Bürgereingabe: BV3/0020/2016</div>
                    <a class="ris-link ris-link_has-icon">Generalsanierung Drehbrücke Deutzer Hafen</a>
                    <div class="ris-body-2">Letzte Bearbeitung: 27.10.2018</div>
                </div>

                <a href="{{ route('themes-map') }}" class="ris-link ris-body2">
                    Alle Themen ansehen
                </a>
            </section>

            <div class="ris-title">Merkliste</div>
            <div class="ris-subheader">
                Hier finden Sie Ihre gemerkten Themen, Sitzungen und Personen an einem Ort.
            </div>

            <div class="ris-hint-box">
                <div>
                    <a href="{{ route('themes-map') }}" class="ris-link ris-link__secondary ris-body2">
                        Zur Merkliste
                    </a>
                </div>
            </div>
        </div>

        <map-desktop-app class="map-desktop"></map-desktop-app>
    </main>
@endsection
