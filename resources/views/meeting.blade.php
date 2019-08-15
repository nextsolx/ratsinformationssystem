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
                    <li class="ris-tab" @click="openTab($event, 'member')">
                        <span class="ris-i ris-i_people"></span>
                        <h2 class="ris-h2">Teilnehmer</h2>
                        @if (isset($meeting['peopleCount']) and $meeting['peopleCount'] > 0)
                            <span class="ris-count">({{ $meeting['peopleCount'] }})</span>
                        @endif
                    </li>
                </ul>
            </section>

            <section class="ris-section-wrapper ris-tab-data ris-tab-data_active ris-tab-data-overview"
                ref="overview"
            >
                <div class="ris-overview-list">
                    <div class="ris-overview">
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
                    <div class="ris-overview">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_marker-with-dot"></span>
                            Sitzungsort
                        </div>
                        <div class="ris-body-2 ris-body-2__content">
                            Rathaus, Spanischer Bau, Ratssaal
                            <span class="ris-i ris-i_marker-with-dot"></span>
                        </div>
                    </div>
                    <div class="ris-overview">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_squares-in-square"></span>
                            Gremium
                        </div>
                        <div class="ris-body-2 ris-body-2__content">
                            Ausschuss für Anregungen und Beschwerden
                            <span class="ris-i ris-i_squares-in-square"></span>
                        </div>
                    </div>
                    <div class="ris-overview">
                        <div class="ris-body-2 ris-body-2__headline">
                            <span class="ris-i ris-i_doc"></span>
                            Dokumente
                        </div>
                        <div class="ris-body-2 ris-body-2__content ris-document-list">
                            @if (isset($meeting['files']) and count($meeting['files']) > 0)
                                @foreach($meeting['files'] as $file)
                                    <a class="ris-document ris-document-one ris-link" title="{{ $file['name'] }}"
                                        href="/{{ $file['downloadUrl'] }}"
                                    >
                                        <span class="ris-i ris-i_download"></span>
                                        <span class="ris-text">{{ $file['name'] }}</span>
                                        <span class="ris-i ris-i_download-with-box"></span>
                                    </a>
                                @endforeach
                            @else
                                <div class="ris-text">Keine Dokumente</div>
                            @endif


                        </div>
                    </div>
                </div>
            </section>

            <section class="ris-section-wrapper ris-tab-data ris-tab-data-agenda"
                ref="agenda"
            >
                <div class="ris-agenda">Agenda data</div>
            </section>

            <section class="ris-section-wrapper ris-tab-data ris-tab-data-member"
                ref="member"
            >
                @if (isset($meeting['people']) and count($meeting['people']) > 0)
                    <div class="ris-action-box">
                        <div class="ris-search ris-sorting__search">
                            <button class="ris-search__button">
                                <span class="ris-i ris-i_search"></span>
                            </button>
                            <input type="search" class="ris-search__input"
                                placeholder="Suche nach Themen, Vorlagen, Sitzungen..."
                            />
                        </div>
                        <dropdown
                            :label="'Sortierung nach'"
                            :options="['Funktion', 'Partei']"
                            @change="orderMembersBy"
                            :id="'meeting-member'"
                        ></dropdown>
                    </div>

                    <div class="ris-member-list">
                        {{--@todo --- fix mock data--}}
                        <div class="ris-h3 ris-h3__headline">Stimmberechtigte Teilnehmer</div>
                        <ul class="ris-ul ris-committee-members-main-list">
                            @foreach ($meeting['people'] as $people)
                                <li class="ris ris-member">
                                    <a href="/person/{{ $people->id }}" class="ris-member-link">
                                        <img src="@if (isset($people->photo)) {{ $people->photo }} @else /img/thumbnail-avatar.svg @endif" alt="{{ $people->name }}" class="ris-member-link__img"/>
                                        <div class="ris-member-link__content">
                                            <h3 class="ris-h3 ris-member-link__heading">{{ $people->name }}</h3>
                                            {{-- @todo --- fix mock data --}}
                                            <span class="ris-member-link__text">CDU</span>
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
                                        <span class="ris-member-link__text">AfD</span>
                                    </div>
                                    <span class="ris-i ris-i_chevron-right ris-link_right"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="ris-member-list_empty ris-h3">Keine Teilnehmer</div>
                @endif

            </section>

        </main>
    </meeting>

    @include('layouts.footer')

@endsection
