@extends('layouts.app')

@section('content')

    @include('layouts.breadcrumbs')

    <meeting inline-template>
        <main class="ris-main ris-meeting ris-content_six-eight-eight">

            <section class="ris-section-wrapper ris-meeting__headline">
                {{--@todo --- fix mock data--}}
                <div class="ris-caption ris-caption__top">Rat/0043/2018</div>
                <h1 class="ris-headline">
                    {{ $meeting['title'] }}
                </h1>
            </section>

            <section class="ris-section-wrapper ris-tab">
                <ul class="ris-tab-list">
                    <li class="ris-tab ris-tab_active" @click="openTab($event, 'overview')">
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
                    <li class="ris-tab" @click="openTab($event, 'participant')">
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
                            {{ \Illuminate\Support\Carbon::parse($meeting['dateFrom'])->locale('de')->format('l, d. F Y') }}
                            {{ \Illuminate\Support\Carbon::parse($meeting['dateFrom'])->format('H:i') }}-{{ \Illuminate\Support\Carbon::parse($meeting['dateTill'])->format('H:i') }}
                            Uhr
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
                            <span class="ris-i ris-i_squares-in-square"></span>
                            Gremium
                        </div>
                        <div class="ris-body-2 ris-body-2__content">
                            Ausschuss für Anregungen und Beschwerden
                            <span class="ris-i ris-i_squares-in-square"></span>
                        </div>
                    </div>
                    <div class="ris-flex">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_doc"></span>
                            Dokumente
                        </div>
                        <div class="ris-body-2 ris-body-2__content ris-document-list">
                            @foreach($meeting['files'] as $file)
                                <a class="ris-document ris-document-one ris-link" title="{{ $file['name'] }}"
                                    href="/{{ $file['downloadUrl'] }}"
                                >
                                    <span class="ris-i ris-i_download"></span>
                                    <span class="ris-text">{{ $file['name'] }}</span>
                                    <span class="ris-i ris-i_download-with-box"></span>
                                </a>
                            @endforeach
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

    @include('layouts.footer')

@endsection
