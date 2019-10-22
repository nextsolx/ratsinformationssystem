@extends('layouts.app')

<?php
$meeting_agenda = [];
$meeting_agenda_search = [];
if (isset($meeting['agenda']) and count($meeting['agenda']) > 0
    and (isset($meeting['agenda'][0]) and is_object($meeting['agenda'][0]))) {
    $meeting_agenda = $meeting['agenda'][0];
    $meeting_agenda_search = Arr::collapse($meeting['agenda'][0]);
}

$meeting_people = [];
if (isset($meeting['people']) and count($meeting['people']) > 0) {
    $meeting_people = $meeting['people'];
}
?>

@section('content')

    <meeting inline-template
        :agenda-list="{{ json_encode($meeting_agenda_search) }}"
        :people-list="{{ json_encode($meeting_people) }}"
    >
        <main class="ris-main ris-meeting">

            @include('layouts.breadcrumbs')

            <div class="ris-content_six-eight-eight">
                <section class="ris-section-wrapper ris-meeting__headline">
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
                        <li class="ris-tab" @click="openTab($event, 'agenda')">
                            <span class="ris-i ris-i_list"></span>
                            <h2 class="ris-h2">Tagesordnung</h2>
                            @if (isset($meeting['agendaCount']) and $meeting['agendaCount'] > 0)
                                <span class="ris-count">({{ $meeting['agendaCount'] }})</span>
                            @endif
                        </li>
                        <li class="ris-tab" @click="openTab($event, 'member')">
                            <span class="ris-i ris-i_people"></span>
                            <h2 class="ris-h2">Teilnehmer</h2>
                            @if (isset($meeting['peopleCount']) and $meeting['peopleCount'] > 0)
                                <span class="ris-count">({{ $meeting['peopleCount'] }})</span>
                            @endif
                        </li>
                    </ul>
                </section>

                <section class="ris-section-wrapper ris-tab-data ris-section-meeting-overview ris-tab-data_active"
                    ref="overview"
                >
                    <div class="ris-overview">
                        <div class="ris-description ris-description__headline">
                            <span class="ris-i ris-i_calendar"></span>
                            Termin
                        </div>
                        <div class="ris-description ris-description__content">
                            {{ \Illuminate\Support\Carbon::parse($meeting['dateFrom'])->locale('de')->format('l, d. F Y') }}
                            {{ \Illuminate\Support\Carbon::parse($meeting['dateFrom'])->format('H:i') }}-{{ \Illuminate\Support\Carbon::parse($meeting['dateTill'])->format('H:i') }}
                            Uhr
                            <span class="ris-i ris-i_calendar"></span>
                        </div>
                    </div>

                    @if (isset($meeting['location']))
                        <div class="ris-overview">
                            <div class="ris-description ris-description__headline">
                                <span class="ris-i ris-i_marker-with-dot"></span>
                                Sitzungsort
                            </div>
                            <div class="ris-description ris-description__content">
                                {{ $meeting['location']->description }}
                                <span class="ris-i ris-i_marker-with-dot"></span>
                            </div>
                        </div>
                    @endif

                    @if (isset($meeting['organizations']))
                        <div class="ris-overview">
                            <div class="ris-description ris-description__headline">
                                <span class="ris-i ris-i_squares-in-square"></span>
                                Gremium
                            </div>
                            <div class="ris-description ris-description__content">
                                {{ $meeting['organizations'][0]->title }}
                                <span class="ris-i ris-i_squares-in-square"></span>
                            </div>
                        </div>
                    @endif

                    <div class="ris-overview">
                        <div class="ris-description ris-description__headline">
                            <span class="ris-i ris-i_doc"></span>
                            Dokumente
                        </div>
                        <div class="ris-document-list">
                            @if (isset($meeting['files']) and count($meeting['files']) > 0)
                                @foreach($meeting['files'] as $file)
                                    <a class="ris-document-list__item ris-link" title="{{ $file->name }}"
                                        href="{{ $file->downloadUrl }}"
                                    >
                                        <span class="ris-i ris-i_download"></span>
                                        <span class="ris-text">{{ $file->name }}</span>
                                        <span class="ris-i ris-i_download-with-box"></span>
                                    </a>
                                @endforeach
                            @else
                                <div class="ris-text">Keine Dokumente</div>
                            @endif
                        </div>
                    </div>
                </section>



                <section class="ris-section-wrapper ris-tab-data ris-section-meeting-agenda"
                    ref="agenda"
                >
                    @if ($meeting_agenda)
                        <search
                            @input="searchAgenda"
                        ></search>

                        <div class="ris-agenda-list">
                            <h3 class="ris-h3 ris-h3__headline">
                                <span class="ris-i ris-i_eye"></span>
                                Öffentlicher Teil
                            </h3>

                            @include('components.meeting.agenda-list',
                                    ['agenda_grouped_list' => $meeting_agenda, 'agenda_public_type' => 1]
                                )
                        </div>

                        <?php
                            $agenda_private_exist = false;
                            foreach ($meeting_agenda as $agenda_list) {
                                foreach ($agenda_list as $agenda) {
                                    if ($agenda->public === 0) {
                                         $agenda_private_exist = true;
                                    }
                                }
                            }
                        ?>
                        @if ($agenda_private_exist)
                            <div class="ris-agenda-list">
                                <h3 class="ris-h3 ris-h3__headline">
                                    <span class="ris-i ris-i_eye-crossed"></span>
                                    Nicht öffentlicher Teil
                                </h3>

                                @include('components.meeting.agenda-list',
                                        ['agenda_grouped_list' => $meeting_agenda, 'agenda_public_type' => 0]
                                    )
                            </div>
                        @endif
                    @else
                        <div class="ris-empty ris-h3">Nichts ist auf der Tagesordnung</div>
                    @endif
                </section>



                <section class="ris-section-wrapper ris-tab-data ris-section-meeting-member"
                    ref="member"
                >
                    @if (count($meeting_people) > 0)
                        <member-list :members="{{ json_encode($meeting_people) }}"></member-list>
                    @else
                        <div class="ris-empty ris-h3">Keine Teilnehmer</div>
                    @endif
                </section>
            </div>

        </main>
    </meeting>

    @include('layouts.footer')

@endsection
