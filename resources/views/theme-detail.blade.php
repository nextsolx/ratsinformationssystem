@extends('layouts.app')

@section('content')
    <main class="ris-main ris-theme-detail">

        @include('layouts.breadcrumbs')

        <div class="ris-theme-detail__content ris-content ris-content_six-eight-eight">

            <section class="ris-section-wrapper ris-section-wrapper_full">
                <div class="ris-img-wrapper">
                    <img src="/img/thumbnail-very-big-bridge.jpg" class="ris-img"
                        alt="{{ $topic->name }}"/>
                </div>
                <div class="ris-caption">Thema 2408/2018</div>
                <h1 class="ris-headline">{{ $topic->name }}</h1>
                <div class="ris-caption">Zuletzt aktualisiert: 11.09.2018</div>
            </section>

            <section class="ris-section-wrapper">
                <div class="ris-title">Worum geht es?</div>
                <div class="ris-body-2">
                    Die alte Drehbrücke im Deutzer Hafen muss dringend saniert werden.
                    Dies wird rund 3.655.000 € kosten.
                    Für den Zeitraum der Arbeiten muss zudem der Fussgängerweg über die Brücke gesperrt werden.
                    Eine alternative Wegführung an der Severingsbrücke würde weitere 469.000 € kosten.
                </div>

                {{--<div>Nicht Beschrieben.</div>--}}
            </section>

            @if (isset($topic->location))
                <section class="ris-section-wrapper">
                    <div class="ris-title">Ort</div>

                    <div class="ris-map-img ris-img-wrapper">
                        <a href="{{ route('map') }}" class="ris-link"
                            title="Karte öffnen"
                        >
                            <img src="/img/thumbnail-very-big-map.jpg" class="ris-img"
                                alt="{{ $topic->name }}"/>
                        </a>
                    </div>

                    <div class="ris-map-detail">
                        <div class="ris-map-all-street-address ris-body-2">
                            <div>
                                <div>{{ $topic->location->streetAddress }}</div>
                                <div>{{ $topic->location->postalCode }} {{ $topic->location->city }}</div>
                            </div>
                        </div>

                        <a href="{{ route('map') }}" class="ris-link ris-link_has-icon"
                            title="Karte öffnen"
                        >
                            Karte öffnen
                        </a>
                    </div>
                </section>
            @endif

            @if (isset($topic->process))
                <section class="ris-section-wrapper">
                    <div class="ris-action-box">
                        <div class="ris-title">Politischer Prozess</div>
                        <div class="ris-select">
                            <div class="ris-select__label">Darstellung</div>

                            <select class="ris-select__select">
                                <option class="ris-select__option" data-sort-type="newest-first">
                                    Das Neuste zuerst
                                </option>
                                <option class="ris-select__option" data-sort-type="oldest-first">
                                    Chronologische Reihenfolge
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="ris-process">
                        @foreach ($topic->process as $process)
                            <div class="ris-process__item">
                                <div class="ris-process__created-at ris-body-2">{{ $process->created_at }}</div>
                                <div class="ris-process__role ris-title">{{ $process->role }}</div>
                                <div class="ris-process__description ris-body-2">Lorem description. Der Finanzausschuss hat über die Vorlage beraten und stimmt der Umsetzung uneingeschränkt zu. </div>
                                <div class="ris-process__meeting-summary">
                                    <div class="ris-process__meeting">
                                        <div class="ris-caption">Sitzung BV1/0035/2018</div>
                                        <div class="ris-caption">Tagesordnungspunkt (TOP) 3.11</div>
                                    </div>

                                    <a href="{{ route('map') }}" class="ris-link ris-link_has-icon"
                                        title="Karte öffnen"
                                    >
                                        Karte öffnen
                                    </a>
                                </div>

                                {{--@if (isset($process->meeting))
                                    <div class="ris-process__meeting">
                                        @if (isset($process->meeting->name))
                                            <div class="ris-process__meeting-name">{{ $process->meeting->name }}</div>
                                        @endif
                                        @if (isset($process->meeting->meeting_state))
                                            <div class="ris-process__meeting-state">{{ $process->meeting->meeting_state }}</div>
                                        @endif
                                        <div class="ris-process__meeting-created-at">{{ $process->meeting->created_at }}</div>
                                    </div>
                                @endif--}}
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

                {{--hide if data not exist--}}
                <section class="ris-section-wrapper">
                    <div class="ris-title">Ergebnis</div>
                    <div class="ris-body-2">
                        Der Rat war das entscheidende Gremium (Beschlussgremium) für dieses Thema.
                        Der Vorschlag der Verwaltung wurde ohne Änderungen beschlossen.
                        Der politische Prozess zu diesem Thema ist somit beendet.
                    </div>
                </section>

                {{--hide if data not exist--}}
                <section class="ris-section-wrapper">
                    <div class="ris-title">Was passiert Jetzt</div>
                    <div class="ris-body-2">
                        Der Rat war das entscheidende Gremium (Beschlussgremium) für dieses Thema.
                        Der Vorschlag der Verwaltung wurde ohne Änderungen beschlossen.
                        Der politische Prozess zu diesem Thema ist somit beendet.
                    </div>
                </section>

                <section class="ris-section-wrapper">
                    <div class="ris-title">Dokumente</div>

                    <div class="ris-document ris-document-many">
                        <div class="ris-icon-wrapper">
                            <img src="/img/pdf-many.svg" class="ris-img" alt="Alle Dokumente"/>
                        </div>
                        <div class="ris-text-wrapper">
                            <div class="ris-title">Alle Dokumente gebündelt</div>
                            <div class="ris-body-2">6 Dateien | 5,5 MB</div>
                        </div>
                    </div>
                    <div class="ris-document ris-document-one">
                        <div class="ris-icon-wrapper">
                            <img src="/img/pdf.svg" class="ris-img" alt="Beschlussvorlage Rat"/>
                        </div>
                        <span class="ris-text-wrapper">Beschlussvorlage Rat</span>
                    </div>

                    <div class="ris-document ris-document-one">
                        <div class="ris-icon-wrapper">
                            <img src="/img/pdf.svg" class="ris-img" alt="Anlage 1 - Zustimmung 14 Kostenberechnung"/>
                        </div>
                        <span class="ris-text-wrapper">Anlage 1 - Zustimmung 14 Kostenberechnung</span>
                    </div>
                </section>

        </div>

        @include('layouts.footer')

    </main>
@endsection
