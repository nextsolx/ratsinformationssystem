@extends('layouts.app')

@section('content')
    <main class="ris-content ris-welcome">
        <div class="ris-welcome__content">

            <section class="ris-welcome__content_wrapper">
                <h1 class="ris-headline">
                    Stadtpolitik Köln
                </h1>
                <div class="ris-body-1">
                    Hier finden Sie Informationen rund um die Themen, welche aktuell in der Kölner Stadtpolitik behandelt werden.
                </div>
            </section>

            <section class="ris-welcome__content_wrapper">
                <div class="ris-title">Themen über Karte erkunden</div>
                <div class="ris-subheader">
                    Wählen Sie Ihren Stadtbezirk und finden Sie Themen in Ihrer Umgebung.
                </div>

                <map-mobile-app class="map-mobile"></map-mobile-app>

                <div class="ris-filter-buttons">
                    <div class="ris-filter-buttons__title">
                        Die 9 Stadtbezirke in Köln
                    </div>
                    <div>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Innenstadt
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Rodenkirchen
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Lindenthal
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Ehrenfeld
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Nippes
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Chorweiler
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Porz
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Kalk
                        </button>
                        <button class="ris-button ris-button_secondary ris-button_has-shadow">
                            Mülheim
                        </button>
                    </div>
                </div>
            </section>

            <section class="ris-card-list">
                <div class="ris-title">Aktuelle Themen</div>

                <div class="ris-card-list__item">
                    <a class="ris-link">Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis...</a>
                    <div class="ris-caption">Thema 2477/2018</div>
                    <div class="ris-caption">27.10.2018</div>
                </div>

                <div class="ris-card-list__item">
                    <a class="ris-link">Bewohnerparken Köln-Lindenthal</a>
                    <div class="ris-caption">Thema 2477/2018</div>
                    <div class="ris-caption">27.10.2018</div>
                </div>

                <a href="{{ route('themes-map') }}" class="ris-link ris-link_has-icon">
                    Alle Themen
                </a>
            </section>

            <section class="ris-card-list">
                <div class="ris-title">Aktuelle Sitzungen</div>

                <div class="ris-card-list__item">
                    <a class="ris-link">Ausschuss für Anregungen und Beschwerden</a>
                    <div class="ris-caption">BA/0028/2018</div>
                    <div class="ris-body-2">Morgen, 17:00 Uhr</div>
                    <div class="ris-body-2">Rathaus, Spanischer Bau</div>
                </div>

                <div class="ris-card-list__item">
                    <a class="ris-link">Ausschuss für Anregungen und Beschwerden</a>
                    <div class="ris-caption">BA/0028/2018</div>
                    <div class="ris-body-2">Morgen, 17:00 Uhr</div>
                    <div class="ris-body-2">Rathaus, Spanischer Bau</div>
                </div>

                <a href="{{ route('calendar') }}" class="ris-link ris-link_has-icon">
                    Zum Sitzungskalender
                </a>
            </section>

            <section class="ris-welcome__content_wrapper">
                <div class="ris-title">Merkliste</div>
                <div class="ris-subheader">
                    Hier finden Sie Ihre gemerkten Themen, Sitzungen und Personen an einem Ort.
                </div>

                <a href="{{ route('themes-map') }}" class="ris-link ris-link_has-icon">
                    Zur Merkliste
                </a>
            </section>
        </div>

        <map-desktop-app class="map-desktop"></map-desktop-app>
    </main>
@endsection
