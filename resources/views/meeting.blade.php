@extends('layouts.app')

<?php
$meeting_agenda = [];
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

    @include('layouts.breadcrumbs')

    <meeting inline-template
        :agenda-list="{{ json_encode($meeting_agenda_search) }}"
        :people-list="{{ json_encode($meeting_people) }}"
    >
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
                    <li class="ris-tab" @click="openTab($event, 'overview')">
                        <span class="ris-i ris-i_info"></span>
                        <h2 class="ris-h2">Übersicht</h2>
                    </li>
                    <li class="ris-tab ris-tab_active" @click="openTab($event, 'agenda')">
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

            <section class="ris-section-wrapper ris-tab-data ris-section-meeting-overview"
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
                <div class="ris-overview">
                    <div class="ris-description ris-description__headline">
                        <span class="ris-i ris-i_marker-with-dot"></span>
                        Sitzungsort
                    </div>
                    <div class="ris-description ris-description__content">
                        Rathaus, Spanischer Bau, Ratssaal
                        <span class="ris-i ris-i_marker-with-dot"></span>
                    </div>
                </div>
                <div class="ris-overview">
                    <div class="ris-description ris-description__headline">
                        <span class="ris-i ris-i_squares-in-square"></span>
                        Gremium
                    </div>
                    <div class="ris-description ris-description__content">
                        Ausschuss für Anregungen und Beschwerden
                        <span class="ris-i ris-i_squares-in-square"></span>
                    </div>
                </div>
                <div class="ris-overview">
                    <div class="ris-description ris-description__headline">
                        <span class="ris-i ris-i_doc"></span>
                        Dokumente
                    </div>
                    <div class="ris-document-list">
                        @if (isset($meeting['files']) and count($meeting['files']) > 0)
                            @foreach($meeting['files'] as $file)
                                <a class="ris-document-list__item ris-link" title="{{ $file->name }}"
                                    href="/{{ $file->downloadUrl }}"
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



            <section class="ris-section-wrapper ris-tab-data ris-tab-data_active ris-section-meeting-agenda"
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
                        {{--<button class="ris-link ris-link_button ris-button__back"
                            @click="backToList"
                            v-if="backButtonPublic"
                            v-cloak
                        >
                            <span class="ris-i ris-i_back"></span>
                            Zurück
                        </button>--}}

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
                            {{--<button class="ris-link ris-link_button ris-button__back"
                                @click="backToList"
                                v-if="backButtonPrivate"
                                v-cloak
                            >
                                <span class="ris-i ris-i_back"></span>
                                Zurück
                            </button>--}}
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
                    <div class="ris-action-box">
                        <search
                            @input="searchMember"
                        ></search>
                        <dropdown
                            :label="'Sortierung'"
                            :options="[ {label: 'Funktion', value: 'funktion'}, {label: 'Partei', value: 'partei'} ]"
                            :value="{label: 'Funktion', value: 'funktion'}"
                            @change="orderMembersBy"
                            :id="'meeting-member'"
                        ></dropdown>
                    </div>

                    <div class="ris-member-list">
                        <h3 class="ris-h3 ris-h3__headline">Stimmberechtigte Teilnehmer</h3>
                        <ul class="ris-ul ris-committee-members-main-list">
                            @foreach ($meeting_people as $people)
                                <li class="ris ris-member">
                                    <a href="/person/{{ $people->id }}" class="ris-member-link">
                                        <img src="@if (isset($people->photo)) {{ $people->photo }} @else /img/thumbnail-avatar.svg @endif"
                                            alt="{{ $people->name }}" class="ris-member-link__img"
                                        />
                                        <div class="ris-member-link__content">
                                            <div class="ris-h3 ris-member-link__heading">{{ $people->name }}</div>
                                            {{-- @todo --- fix mock data --}}
                                            <span class="ris-text">CDU</span>
                                        </div>
                                        <span class="ris-i ris-i_chevron-right ris-link_right"></span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        {{-- @todo --- fix mock data, all block --}}
                        <div class="ris-h3 ris-h3__headline">Beratende Teilnehmer</div>
                        <ul class="ris-ul ris-committee-members-main-list">
                            <li class="ris ris-member">
                                <a href="/person/id" class="ris-member-link">
                                    <img src="/img/thumbnail-avatar.svg" alt="Liane Bchir" class="ris-member-link__img"/>
                                    <div class="ris-member-link__content">
                                        <h3 class="ris-h3 ris-member-link__heading">Liane Bchir</h3>
                                        <span class="ris-text">AfD</span>
                                    </div>
                                    <span class="ris-i ris-i_chevron-right ris-link_right"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="ris-empty ris-h3">Keine Teilnehmer</div>
                @endif
            </section>

        </main>
    </meeting>

    @include('layouts.footer')

@endsection
