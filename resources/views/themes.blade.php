@extends('layouts.app')

@section('content')
    <main class="ris-main ris-themes">

        @include('layouts.breadcrumbs')

        <theme-list inline-template>

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

                                <div class="ris-filter-buttons" id="_filter-district-list">
                                    <div class="ris-filter-buttons__title">
                                        Nach Bezirken filtern
                                    </div>

                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Innenstadt
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Rodenkirchen
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Lindenthal
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Ehrenfeld
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Nippes
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Chorweiler
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Porz
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Kalk
                                    </button>
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        Mülheim
                                    </button>
                                </div>

                                <div class="ris-filter-buttons" id="_filter-postcode-list"
                                     v-if="postcodeList.length > 0"
                                >
                                    <div class="ris-filter-buttons__title">
                                        Nach Postleitzahlen filtern
                                    </div>

                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        v-for="postcode in postcodeList"
                                    >
                                         @{{ postcode }}
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

                @if (!empty($topics))
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
                @endif


                @if (!empty($topics))
                    <section class="ris-card-list ris-card-list__themes _theme-list-new-block">
                        <div class="ris-title">Neue Themen</div>

                        @foreach ($topics as $topic)
                            @if ($loop->iteration > 3)
                                @break
                            @endif
                            <a class="ris-card-list__item _theme-new-default" title="{{ $topic->name }}"
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

                        <theme v-if="themeListNew"
                            :theme-list-type="themeListNew ? 1 : null"
                            :theme-list-data="themeListNew"/>

                        <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                           title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                        </a>
                    </section>
                @endif


                @if (!empty($topics))
                    <section class="ris-card-list ris-card-list__themes _theme-list-progress-block">
                        <div class="ris-title">Kürzlich aktualisiert</div>

                        @foreach ($topics as $topic)
                            @if ($loop->iteration > 3)
                                @break
                            @endif
                            <a class="ris-card-list__item _theme-progress-default" title="{{ $topic->name }}"
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

                        <theme v-if="themeListProgress"
                            :theme-list-type="themeListProgress ? 2 : null"
                            :theme-list-data="themeListProgress"/>

                        <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                           title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                        </a>
                    </section>
                @endif


                @if (!empty($topics))
                    <section class="ris-card-list ris-card-list__themes _theme-list-finished-block">
                        <div class="ris-title">Kürzlich abgeschlossen</div>

                        @foreach ($topics as $topic)
                            @if ($loop->iteration > 3)
                                @break
                            @endif
                            <a class="ris-card-list__item _theme-finished-default" title="{{ $topic->name }}"
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

                        <theme v-if="themeListFinished"
                            :theme-list-type="themeListFinished ? 3 : null"
                            :theme-list-data="themeListFinished"/>

                        <a href="{{ route('themes') }}" class="ris-link ris-link_has-icon"
                           title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                        </a>
                    </section>
                @endif

            </div>

        </theme-list>

        @include('layouts.footer')

    </main>
@endsection
