@extends('layouts.app')

@section('content')
    <main class="ris-main ris-themes">

        @include('layouts.breadcrumbs')

        <themes inline-template>

            <div class="ris-themes__content">
                <h1 class="ris-headline">
                    Themen
                </h1>

                <div class="ris-action-box">
                    <div class="ris-filter"
                        :class="{'ris-filter_active': activeFilter}"
                    >
                        <div class="ris-filter__subheader ris-filter__subheader_has-left-icon ris-subheader"
                            @click="collapseFilter"
                        >
                            Filtern
                        </div>

                        <div class="ris-filter__content-wrapper">
                            <div class="ris-filter__content">

                                <div class="ris-filter-buttons">
                                    <div class="ris-filter-buttons__title">
                                        Nach Bezirken filtern
                                    </div>

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

                                <div class="ris-filter-buttons">
                                    <div class="ris-filter-buttons__title">
                                        Nach Postleitzahlen filtern
                                    </div>

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
                        </div>
                    </div>

                    <div class="ris-select">
                        <div class="ris-select__label">Sortierung</div>
                        <select class="ris-select__select">
                            <option class="ris-select__option" data-sort-type="progress">
                                Fortschritt
                            </option>
                            <option class="ris-select__option" data-sort-type="creation-date">
                                Einstellungsdatum
                            </option>
                        </select>
                    </div>
                </div>

                <section class="ris-top-box">
                    <div class="ris-title">Top-Themen</div>

                    <div class="swiper-container">
                        <div class="swiper-wrapper">

                            @foreach ($topics as $topic)
                                @if ($loop->iteration > 10)
                                    @break
                                @endif

                                <a class="ris-top-box__card swiper-slide" href="{{ route('people') }}/1"
                                   title="{{ $topic->name }}"
                                >
                                    <div class="ris-top-box__card-top">
                                        <img src="./img/thumbnail-bridge-big-tile.png" class="ris-top-box__card-img"
                                             alt="{{ $topic->name }}"/>
                                        <div class="ris-body-1">
                                            {{ $topic->name }}
                                        </div>
                                    </div>
                                    <div class="ris-top-box__card-bottom">
                                        <div class="ris-caption ris-top-box__card-number">
                                            Thema &nbsp;
                                            <span>2477</span>
                                            /
                                            <span>{{ Carbon\Carbon::parse('27.10.2018')->year }}</span>
                                        </div>
                                        <div class="ris-top-box__card-progress-box">
                                            <div class="ris-progress-bar">
                                                <div class="ris-progress-bar__progress" style="width: 25%"></div>
                                            </div>
                                            <div class="ris-caption ris-top-box__card-date">27.10.2018</div>
                                        </div>
                                    </div>
                                </a>

                            @endforeach

                        </div>
                    </div>

                </section>

                <section class="ris-card-list ris-card-list__themes">
                    <div class="ris-title">Neue Themen</div>

                    @foreach ($topics as $topic)
                        @if ($loop->iteration > 3)
                            @break
                        @endif
                        <a class="ris-card-list__item" title="{{ $topic->name }}"
                           href="{{ route('themes') }}"
                        >
                            <div class="ris-card-list__themes-top">
                                <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                                     alt="{{ $topic->name }}"/>
                                <div class="ris-body-1">
                                    {{ $topic->name }}
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
                                    <div class="ris-progress-bar__progress" style="width: 25%"></div>
                                </div>
                                <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                            </div>
                        </a>
                    @endforeach

                    <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                       title="Mehr anzeigen"
                    >
                        Mehr anzeigen
                    </a>
                </section>



                <section class="ris-card-list ris-card-list__themes">
                    <div class="ris-title">Kürzlich aktualisiert</div>

                    @foreach ($topics as $topic)
                        @if ($loop->iteration > 3)
                            @break
                        @endif
                        <a class="ris-card-list__item" title="{{ $topic->name }}"
                           href="{{ route('themes') }}"
                        >
                            <div class="ris-card-list__themes-top">
                                <img src="./img/thumbnail-map-tile.png" class="ris-card-list__themes-img"
                                     alt="{{ $topic->name }}"/>
                                <div class="ris-body-1">
                                    {{ $topic->name }}
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
                                    <div class="ris-progress-bar__progress" style="width: 75%"></div>
                                </div>
                                <div class="ris-caption ris-card-list__themes-date">27.10.2018</div>
                            </div>
                        </a>
                    @endforeach

                    <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                       title="Mehr anzeigen"
                    >
                        Mehr anzeigen
                    </a>
                </section>



                <section class="ris-card-list ris-card-list__themes">
                    <div class="ris-title">Kürzlich abgeschlossen</div>

                    @foreach ($topics as $topic)
                        @if ($loop->iteration > 3)
                            @break
                        @endif
                        <a class="ris-card-list__item" title="{{ $topic->name }}"
                           href="{{ route('themes') }}"
                        >
                            <div class="ris-card-list__themes-top">
                                <img src="./img/thumbnail-bridge-tile.png" class="ris-card-list__themes-img"
                                     alt="{{ $topic->name }}"/>
                                <div class="ris-body-1">
                                    {{ $topic->name }}
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
                    @endforeach

                    <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                       title="Mehr anzeigen"
                    >
                        Mehr anzeigen
                    </a>
                </section>
            </div>

        </themes>

        @include('layouts.footer')

    </main>
@endsection
