@extends('layouts.app')

@section('content')
    <main class="ris-main ris-welcome ris-content ris-content_has-widget ris-content_six-eight-eight">
        <div class="ris-welcome__content">
            <div class="ris-welcome__content_padding">
                <section class="ris-section-wrapper">
                    <h1 class="ris-headline">
                        Stadtpolitik Köln
                    </h1>
                    <div class="ris-body-1">
                        Hier finden Sie Informationen rund um die Themen, welche aktuell in der Kölner Stadtpolitik behandelt werden.
                    </div>
                </section>

                <section class="ris-section-wrapper">
                    <div class="ris-title">Themen über Karte erkunden</div>
                    <div class="ris-subheader">
                        Wählen Sie Ihren Stadtbezirk und finden Sie Themen in Ihrer Umgebung.
                    </div>

                    <a class="ris-welcome-map ris-welcome-map__mobile" title="Karte öffnen"
                        href="{{ route('map') }}"
                    >
                        <img src="/img/map-mobile-thumbnail.jpg" class="ris-welcome-map__img"
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
                            <a href="{{ route('theme-overview', 'district=Innenstadt') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Innenstadt"
                            >
                                Innenstadt
                            </a>
                            <a href="{{ route('theme-overview', 'district=Rodenkirchen') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Rodenkirchen"
                            >
                                Rodenkirchen
                            </a>
                            <a href="{{ route('theme-overview', 'district=Lindenthal') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Lindenthal"
                            >
                                Lindenthal
                            </a>
                            <a href="{{ route('theme-overview', 'district=Ehrenfeld') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Ehrenfeld"
                            >
                                Ehrenfeld
                            </a>
                            <a href="{{ route('theme-overview', 'district=Nippes') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Nippes"
                            >
                                Nippes
                            </a>
                            <a href="{{ route('theme-overview', 'district=Chorweiler') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Chorweiler"
                            >
                                Chorweiler
                            </a>
                            <a href="{{ route('theme-overview', 'district=Porz') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Porz"
                            >
                                Porz
                            </a>
                            <a href="{{ route('theme-overview', 'district=Kalk') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Kalk"
                            >
                                Kalk
                            </a>
                            <a href="{{ route('theme-overview', 'district=Mülheim') }}"
                                class="ris-link ris-button ris-button_secondary ris-button_has-shadow"
                                title="Mülheim"
                            >
                                Mülheim
                            </a>
                        </div>
                    </div>
                </section>

                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                        <div class="ris-title">Aktuelle Themen</div>

                        @if (isset($topics))
                            @include('components.theme',
                                ['theme_list' => $topics, 'theme_type' => 'new', 'limit' => 3]
                            )

                            <a href="{{ route('theme-overview') }}" class="ris-link ris-link_button ris-link_right"
                                title="Alle Themen"
                            >
                                Alle Themen
                                <span class="ris-i ris-i_chevron-right"></span>
                            </a>
                        @else
                            <div class="ris-body-1">Keine Themen verfügbar.</div>
                        @endif
                    </section>


                    <section class="ris-section-wrapper ris-card-list ris-card-list__calendar">
                        <div class="ris-title">Aktuelle Sitzungen</div>

                        @if (isset($meetings))
                            @include('components.calendar',
                                    ['calendar_list' => $meetings, 'limit' => 3]
                                )

                            <a href="{{ route('calendar-list') }}" class="ris-link ris-link_button ris-link_right"
                                title="Zum Sitzungskalender"
                            >
                                Zum Sitzungskalender
                                <span class="ris-i ris-i_chevron-right"></span>
                            </a>
                        @else
                            <div class="ris-body-1">Keine Sitzungen verfügbar.</div>
                        @endif
                    </section>

                <section class="ris-section-wrapper ris-welcome__committee">
                    <div class="ris-title">Gremien</div>
                    <div class="ris-subheader">
                        Welche Gremien gibt es? Für welche Aufgaben sind diese zuständig? Erfahren Sie mehr über die politischen Organe Kölns!
                    </div>
                    <a href="{{ route('committee-list') }}" class="ris-link ris-link_button ris-link_right"
                        title="Zur den Gremien"
                    >
                        Zur den Gremien
                        <span class="ris-i ris-i_chevron-right"></span>
                    </a>
                </section>

                <section class="ris-section-wrapper ris-welcome__people-wrapper">
                    <div class="ris-title">Personen</div>
                    <div class="ris-subheader">
                        Wer macht in Köln Politik? Lernen Sie die Personen kennen, welche sich ehrenamtlich in den Gremien für Köln engagieren.
                    </div>

                    @if (isset($people))
                        <div class="ris-body-2">
                            Neu in der Kölner Stadtpolitik
                        </div>

                        <div class="ris-welcome__people-list">
                            @include('components.people',
                                    ['people_list' => $people, 'limit' => 5]
                                )
                        </div>
                        <a href="{{ route('people-list') }}" class="ris-link ris-link_button ris-link_right"
                            title="Alle Personen"
                        >
                            Alle Personen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    @else
                        <div class="ris-body-1">Keine Personen verfügbar.</div>
                    @endif
                </section>
            </div>

        </div>

        <div class="ris-welcome__widget">
            <a class="ris-welcome-map ris-welcome-map__desktop" title="Karte öffnen"
               href="{{ route('map') }}"
            >
                <img src="/img/map-desktop-thumbnail.jpg" class="ris-welcome-map__img"
                     alt="Karte öffnen" />
                <div class="ris-button ris-button_primary ris-button_bg-gray2">
                    Karte öffnen
                </div>
            </a>
        </div>
    </main>

    @include('layouts.footer')

@endsection
