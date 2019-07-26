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

                <div class="ris-welcome-map ris-welcome-map__mobile">
                    <img src="./img/map-mobile-thumbnail.jpg" class="ris-welcome-map__img"
                         alt="Karte öffnen" />
                    <a href="{{ route('map') }}" class="ris-button ris-button_primary ris-button_bg-gray2"
                       title="Karte öffnen"
                    >
                        Karte öffnen
                    </a>
                </div>

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

            <section class="ris-card-list ris-card-list__themes">
                <div class="ris-title">Aktuelle Themen</div>

                <div class="ris-card-list__item ris-card-list__item_has-bookmark">
                    <div class="ris-card-list__themes-top">
                        <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                             alt="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"/>
                        <a class="ris-link" title="Bewohnerparken Köln-Lindenthal"
                           href="/"
                        >
                            Bewohnerparken Köln-Lindenthal
                        </a>
                    </div>
                    <div class="ris-card-list__themes-bottom">
                        <div class="ris-caption ris-card-list__themes-number">Thema 2477/2018</div>
                        <div class="ris-card-list__themes-completed">
                            <span class="ris-i ris-i__check ris-i_has-bg"></span>
                            Abgeschlossen
                        </div>
                        <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                    </div>
                </div>

                <div class="ris-card-list__item">
                    <div class="ris-card-list__themes-top">
                        <img src="./img/thumbnail-bridge-tile.png" class="ris-card-list__themes-img"
                             alt="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"/>
                        <a class="ris-link" title="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"
                            href="/"
                        >
                            Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis
                        </a>
                    </div>
                    <div class="ris-card-list__themes-bottom">
                        <div class="ris-caption ris-card-list__themes-number">Thema 2477/2018</div>
                        <div class="ris-progress-bar">
                            <div class="ris-progress-bar__progress" style="width: 60%"></div>
                        </div>
                        <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                    </div>
                </div>

                <div class="ris-card-list__item">
                    <div class="ris-card-list__themes-top">
                        <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                             alt="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"/>
                        <a class="ris-link" title="Bewohnerparken Köln-Lindenthal"
                            href="/"
                        >
                            Bewohnerparken Köln-Lindenthal
                        </a>
                    </div>
                    <div class="ris-card-list__themes-bottom">
                        <div class="ris-caption ris-card-list__themes-number">Thema 2477/2018</div>
                        <div class="ris-card-list__themes-completed">
                            <span class="ris-i ris-i__check ris-i_has-bg"></span>
                            Abgeschlossen
                        </div>
                        <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                    </div>
                </div>

                <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                    title="Alle Themen"
                >
                    Alle Themen
                </a>
            </section>

            <section class="ris-card-list ris-card-list__calendar">
                <div class="ris-title">Aktuelle Sitzungen</div>

                <div class="ris-card-list__item">
                    <a class="ris-link" title="Ausschuss für Anregungen und Beschwerden"
                        href="/"
                    >
                        Ausschuss für Anregungen und Beschwerden
                    </a>
                    <div class="ris-caption">BA/0028/2018</div>
                    <div class="ris-body-2 ris-card-list__calendar-date">Morgen, 17:00 Uhr</div>
                    <div class="ris-body-2 ris-card-list__calendar-place">Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119</div>
                </div>

                <div class="ris-card-list__item">
                    <a class="ris-link" title="Ausschuss für Anregungen und Beschwerden"
                        href="/"
                    >
                        Ausschuss für Anregungen und Beschwerden
                    </a>
                    <div class="ris-caption">BA/0028/2018</div>
                    <div class="ris-body-2 ris-card-list__calendar-date">Morgen, 17:00 Uhr</div>
                    <div class="ris-body-2 ris-card-list__calendar-place">Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119</div>
                </div>

                <a href="{{ route('calendar') }}" class="ris-link ris-link_has-icon"
                    title="Zum Sitzungskalender"
                >
                    Zum Sitzungskalender
                </a>
            </section>

            <section class="ris-welcome__content_wrapper ris-welcome__committee">
                <div class="ris-title">Gremien</div>
                <div class="ris-subheader">
                    Welche Gremien gibt es? Für welche Aufgaben sind diese zuständig? Erfahren Sie mehr über die politischen Organe Kölns!
                </div>
                <a href="{{ route('committee') }}" class="ris-link ris-link_has-icon"
                    title="Zur den Gremien"
                >
                    Zur den Gremien
                </a>
            </section>

            <section class="ris-welcome__content_wrapper ris-welcome__people-wrapper">
                <div class="ris-title">Personen</div>
                <div class="ris-subheader">
                    Wer macht in Köln Politik? Lernen Sie die Personen kennen, welche sich ehrenamtlich in den Gremien für Köln engagieren.
                </div>

                <div class="ris-body-2">
                    Neu in der Kölner Stadtpolitik
                </div>

                <div class="ris-welcome__people-list">
                    <div class="ris-welcome__people">
                        <img src="./img/person-1.jpg" class="ris-welcome__people-img"
                             alt="Constanze Aengenvoort"
                        />
                        <div>
                            <a href="{{ route('people') }}/1" class="ris-link"
                                title="Constanze Aengenvoort"
                            >
                                Constanze Aengenvoort
                            </a>
                            <div class="ris-caption">CDU</div>
                        </div>
                    </div>
                    <div class="ris-welcome__people">
                        <img src="./img/person-2.jpg" class="ris-welcome__people-img"
                             alt="Hamide Akbayir"
                        />
                        <div>
                            <a href="{{ route('people') }}/2" class="ris-link"
                               title="Hamide Akbayir"
                            >
                                Hamide Akbayir
                            </a>
                            <div class="ris-caption">DIE LINKE</div>
                        </div>
                    </div>
                    <div class="ris-welcome__people">
                        <img src="./img/person-3.jpg" class="ris-welcome__people-img"
                             alt="Horst Thelen"
                        />
                        <div>
                            <a href="{{ route('people') }}/3" class="ris-link"
                               title="Horst Thelen"
                            >
                                Horst Thelen
                            </a>
                            <div class="ris-caption">DIE GRÜNEN</div>
                        </div>
                    </div>
                    <div class="ris-welcome__people">
                        <img src="./img/person-4.jpg" class="ris-welcome__people-img"
                             alt="Lino Hammer"
                        />
                        <div>
                            <a href="{{ route('people') }}/4" class="ris-link"
                               title="Lino Hammer"
                            >
                                Lino Hammer
                            </a>
                            <div class="ris-caption">DIE GRÜNEN</div>
                        </div>
                    </div>
                    <div class="ris-welcome__people">
                        <img src="./img/person-5.jpg" class="ris-welcome__people-img"
                             alt="Stephan Pohl"
                        />
                        <div>
                            <a href="{{ route('people') }}/5" class="ris-link"
                               title="Stephan Pohl"
                            >
                                Stephan Pohl
                            </a>
                            <div class="ris-caption">SPD</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('people') }}" class="ris-link ris-link_has-icon"
                    title="Alle Personen"
                >
                    Alle Personen
                </a>
            </section>

            <section class="ris-welcome__content_wrapper ris-welcome__bookmarks">
                <div class="ris-title">Merkliste</div>
                <div class="ris-subheader">
                    Hier finden Sie Ihre gemerkten Themen, Sitzungen und Personen an einem Ort.
                </div>
                <a href="{{ route('bookmarks') }}" class="ris-link ris-link_has-icon"
                    title="Zur Merkliste"
                >
                    Zur Merkliste
                </a>
            </section>

            @include('layouts.footer')

        </div>

        <div class="ris-welcome-map ris-welcome-map__desktop">
            <div class="ris-welcome-map__desktop-sticky">
                <img src="./img/map-desktop-thumbnail.jpg" class="ris-welcome-map__img"
                     alt="Karte öffnen" />
                <a href="{{ route('map') }}" class="ris-button ris-button_primary ris-button_bg-gray2"
                    title="Karte öffnen"
                >
                    Karte öffnen
                </a>
            </div>
        </div>
    </main>
@endsection
