@extends('layouts.app')

@section('content')
    <meeting inline-template>
        <main class="ris-main ris-meeting">

            <section class="ris-section-wrapper">
                {{--@todo --- fix mock data--}}
                <div class="ris-caption ris-caption__top">Rat/0043/2018</div>
                <h1 class="ris-meeting__headline ris-headline">
                    {{ $meeting['title'] }}
                </h1>
            </section>

            <section class="ris-section-wrapper">
                <ul class="ris-tab-list">
                    <li class="ris-tab ris-tab_active ris-body-2" @click="openTab($event, 'overview')">
                        <span class="ris-i ris-i_info"></span>
                        <h2 class="ris-h2">Übersicht</h2>
                    </li>
                    {{--@todo - out of this scope functionality--}}
                    {{--<li class="ris-tab" @click="openTab('agenda')"
                    >
                        <span class="ris-i ris-i_list"></span>
                        <h2 class="ris-h2">Tagesordnung</h2>
                        <span class="ris-count">({{ $meeting['agenda'] }})</span>
                    </li>--}}
                    <li class="ris-tab ris-body-2" @click="openTab($event, 'participant')">
                        <span class="ris-i ris-i_people"></span>
                        <h2 class="ris-h2">Teilnehmer</h2>
                        <span class="ris-count">({{ $meeting['peopleCount'] }})</span>
                    </li>
                </ul>
            </section>

            <section class="ris-section-wrapper ris-tab-data ris-tab-data_active"
                ref="overview"
            >
                <div class="ris-overview">
                    <div class="ris-flex">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_calendar"></span>
                            Termin
                        </div>
                        <div class="ris-body-2 ris-body-2__content">
                            {{ $meeting['dateFrom'] }} 15:40 – 23:11 Uhr
                            <span class="ris-i ris-i_calendar"></span>
                        </div>
                    </div>
                    <div class="ris-flex">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_marker-with-dot"></span>
                            Sitzungsort
                        </div>
                        <div class="ris-body-2 ris-body-2__content">
                            Rathaus, Spanischer Bau, Ratssaal
                            <span class="ris-i ris-i_marker-with-dot"></span>
                        </div>
                    </div>
                    <div class="ris-flex">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_download"></span>
                            Dokumente
                        </div>
                        <div class="ris-body-2 ris-body-2__content ris-document-list">
                            <div class="ris-document">
                                <span class="ris-i ris-i_download"></span>
                                <span class="ris-text">Einladung Rat</span>
                                <span class="ris-i ris-i_add"></span>
                            </div>
                            <div class="ris-document">
                                <span class="ris-i ris-i_download"></span>
                                <span class="ris-text">Einladung Rat</span>
                                <span class="ris-i ris-i_add"></span>
                            </div>
                            <div class="ris-document">
                                <span class="ris-i ris-i_download"></span>
                                <span class="ris-text">Einladung Rat</span>
                                <span class="ris-i ris-i_add"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ris-section-wrapper ris-tab-data"
                ref="agenda"
            >
                <div class="ris-agenda">Agenda data</div>
            </section>

            <section class="ris-section-wrapper ris-tab-data"
                ref="participant"
            >
                <div class="ris-participant">Participant data</div>
            </section>

        </main>
    </meeting>
@endsection
