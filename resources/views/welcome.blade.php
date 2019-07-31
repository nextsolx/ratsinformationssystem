@extends('layouts.app')

@section('content')
    <main class="ris-main ris-welcome">
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

                <a class="ris-welcome-map ris-welcome-map__mobile" title="Karte öffnen"
                    href="{{ route('map') }}"
                >
                    <img src="./img/map-mobile-thumbnail.jpg" class="ris-welcome-map__img"
                         alt="Karte öffnen" />
                    <div class="ris-button ris-button_primary ris-button_bg-gray2">
                        Karte öffnen
                    </div>
                </a>

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

                <a class="ris-card-list__item" title="Bewohnerparken Köln-Lindenthal"
                     href="{{ route('themes') }}"
                >
                    <div class="ris-card-list__themes-top">
                        <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                             alt="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"/>
                        <div class="ris-body-1">
                            Bewohnerparken Köln-Lindenthal
                        </div>
                    </div>
                    <div class="ris-card-list__themes-bottom">
                        <div class="ris-caption ris-card-list__themes-number">
                            Thema &nbsp;
                            <span>2477</span>
                            /
                            <span>{{ Carbon\Carbon::parse('27.10.2018')->year }}</span>
                        </div>
                        <div class="ris-card-list__themes-completed">
                            <span class="ris-i ris-i__check ris-i_has-bg"></span>
                            Abgeschlossen
                        </div>
                        <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                    </div>
                </a>

                <a class="ris-card-list__item" title="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"
                     href="{{ route('themes') }}"
                >
                    <div class="ris-card-list__themes-top">
                        <img src="./img/thumbnail-bridge-tile.png" class="ris-card-list__themes-img"
                             alt="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"/>
                        <div class="ris-body-1">
                            Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis
                        </div>
                    </div>
                    <div class="ris-card-list__themes-bottom">
                        <div class="ris-caption ris-card-list__themes-number">
                            Thema &nbsp;
                            <span>2477</span>
                            /
                            <span>{{ Carbon\Carbon::parse('27.10.2018')->year }}</span>
                        </div>
                        <div class="ris-progress-bar">
                            <div class="ris-progress-bar__progress" style="width: 60%"></div>
                        </div>
                        <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                    </div>
                </a>

                <a class="ris-card-list__item" title="Bewohnerparken Köln-Lindenthal"
                     href="{{ route('themes') }}"
                >
                    <div class="ris-card-list__themes-top">
                        <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                             alt="Generalsanierung Drehbrücke Deutzer Hafen Teilergebnis"/>
                        <div class="ris-body-1">
                            Bewohnerparken Köln-Lindenthal
                        </div>
                    </div>
                    <div class="ris-card-list__themes-bottom">
                        <div class="ris-caption ris-card-list__themes-number">
                            Thema &nbsp;
                            <span>2477</span>
                            /
                            <span>{{ Carbon\Carbon::parse('27.10.2018')->year }}</span>
                        </div>
                        <div class="ris-card-list__themes-completed">
                            <span class="ris-i ris-i__check ris-i_has-bg"></span>
                            Abgeschlossen
                        </div>
                        <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                    </div>
                </a>

                <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                    title="Alle Themen"
                >
                    Alle Themen
                </a>
            </section>

            <section class="ris-card-list ris-card-list__calendar">
                <div class="ris-title">Aktuelle Sitzungen</div>

                <a class="ris-card-list__item" title="Ausschuss für Anregungen und Beschwerden"
                   href="{{ route('calendar') }}"
                >
                    <div class="ris-body-1">
                        Ausschuss für Anregungen und Beschwerden
                    </div>
                    <div class="ris-caption">BA/0028/2018</div>
                    <div class="ris-body-2 ris-card-list__calendar-date">Morgen, 17:00 Uhr</div>
                    <div class="ris-body-2 ris-card-list__calendar-place">Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119</div>
                </a>

                <a class="ris-card-list__item" title="Ausschuss für Anregungen und Beschwerden"
                   href="{{ route('calendar') }}"
                >
                    <div class="ris-body-1">
                        Ausschuss für Anregungen und Beschwerden
                    </div>
                    <div class="ris-caption">BA/0028/2018</div>
                    <div class="ris-body-2 ris-card-list__calendar-date">Morgen, 17:00 Uhr</div>
                    <div class="ris-body-2 ris-card-list__calendar-place">Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119</div>
                </a>

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
                    <a class="ris-welcome__people" href="{{ route('people') }}/1"
                        title="Constanze Aengenvoort"
                    >
                        <img src="./img/person-1.jpg" class="ris-welcome__people-img"
                             alt="Constanze Aengenvoort"
                        />
                        <div>
                            <div class="ris-body-1">
                                Constanze Aengenvoort
                            </div>
                            <div class="ris-caption">CDU</div>
                        </div>
                    </a>
                    <a class="ris-welcome__people" href="{{ route('people') }}/2"
                        title="Hamide Akbayir"
                    >
                        <img src="./img/person-2.jpg" class="ris-welcome__people-img"
                             alt="Hamide Akbayir"
                        />
                        <div>
                            <div class="ris-body-1">
                                Hamide Akbayir
                            </div>
                            <div class="ris-caption">DIE LINKE</div>
                        </div>
                    </a>
                    <a class="ris-welcome__people" href="{{ route('people') }}/3"
                       title="Horst Thelen"
                    >
                        <img src="./img/person-3.jpg" class="ris-welcome__people-img"
                             alt="Horst Thelen"
                        />
                        <div>
                            <div class="ris-body-1">
                                Horst Thelen
                            </div>
                            <div class="ris-caption">DIE GRÜNEN</div>
                        </div>
                    </a>
                    <a class="ris-welcome__people" href="{{ route('people') }}/4"
                       title="Lino Hammer"
                    >
                        <img src="./img/person-4.jpg" class="ris-welcome__people-img"
                             alt="Lino Hammer"
                        />
                        <div>
                            <div class="ris-body-1">
                                Lino Hammer
                            </div>
                            <div class="ris-caption">DIE GRÜNEN</div>
                        </div>
                    </a>
                    <a class="ris-welcome__people" href="{{ route('people') }}/5"
                        title="Stephan Pohl"
                    >
                        <img src="./img/person-5.jpg" class="ris-welcome__people-img"
                             alt="Stephan Pohl"
                        />
                        <div>
                            <div class="ris-body-1">
                                Stephan Pohl
                            </div>
                            <div class="ris-caption">SPD</div>
                        </div>
                    </a>
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

        <a class="ris-welcome-map ris-welcome-map__desktop" title="Karte öffnen"
           href="{{ route('map') }}"
        >
            <img src="./img/map-desktop-thumbnail.jpg" class="ris-welcome-map__img"
                 alt="Karte öffnen" />
            <div class="ris-button ris-button_primary ris-button_bg-gray2">
                Karte öffnen
            </div>
        </a>
    </main>
@endsection
