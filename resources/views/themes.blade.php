@extends('layouts.app')

@section('content')
    <main class="ris-main ris-themes">

        @include('layouts.breadcrumbs')

        <theme-list inline-template
            :default-district-list="{{json_encode($district_list)}}"
        >

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

                        <div class="ris-filter__content">
                            <div class="ris-filter-buttons ris-filter-buttons__selected"
                                    :class="selectedDistrictList.length > 0
                                    ? 'ris-filter-buttons__selected_active'
                                    : ''"
                            >
                                <button class="ris-label ris-label_has-border"
                                        v-for="currentDistrictName in selectedDistrictList"
                                        @click="removeSelectedDistrict(currentDistrictName)"
                                >
                                    @{{ currentDistrictName }}
                                </button>
                            </div>

                            <div class="ris-filter-buttons"
                                ref="defaultDistrictListBlock"
                            >
                                <div class="ris-filter-buttons__title">
                                    Nach Bezirken filtern
                                </div>

                                @foreach ($district_list as $district)
                                    <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                        @click="getTopicByDistrict"
                                    >
                                        {{ $district }}
                                    </button>
                                @endforeach
                            </div>

                            <div class="ris-filter-buttons"
                                v-if="districtList.length > 0 && !firstLoading"
                            >
                                <div class="ris-filter-buttons__title">
                                    Nach Bezirken filtern
                                </div>

                                <button class="ris-button ris-button_secondary ris-button_has-shadow"
                                    @click="getTopicByDistrict"
                                    v-for="district in districtList"
                                >
                                    @{{ district }}
                                </button>
                            </div>

                            <div class="ris-filter-buttons"
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

                                    <a class="ris-top-box__card swiper-slide" title="{{ $topic->name }}"
                                        href="/thema/{{ $topic->id }}"
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


                @if (!empty($topics_new))
                    <section class="ris-card-list ris-card-list__themes"
                        ref="defaultThemeListNewBlock"
                    >
                        <div class="ris-title">Neue Themen</div>

                        @foreach ($topics_new as $topic)
                            @if ($loop->iteration > 3)
                                @break
                            @endif
                            <a class="ris-card-list__item" title="{{ $topic->name }}"
                                href="/thema/{{ $topic->id }}"
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
                @else
                    <section class="ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme
                        :theme-list-data="themeListNew"
                        :theme-list-data-count="themeListNewCount"
                        :theme-list-type="themeListNew ? 1 : null"
                        :theme-first-loading="firstLoading"
                >
                </theme>



                @if (!empty($topics_progress))
                    <section class="ris-card-list ris-card-list__themes"
                        ref="defaultThemeListProgressBlock"
                    >
                        <div class="ris-title">Kürzlich aktualisiert</div>

                        @foreach ($topics_progress as $topic)
                            @if ($loop->iteration > 3)
                                @break
                            @endif
                            <a class="ris-card-list__item" title="{{ $topic->name }}"
                                href="/thema/{{ $topic->id }}"
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
                @else
                    <section class="ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme
                        :theme-list-data="themeListProgress"
                        :theme-list-data-count="themeListProgressCount"
                        :theme-list-type="themeListProgress ? 2 : null"
                        :theme-first-loading="firstLoading"
                >
                </theme>



                @if (!empty($topics_finished))
                    <section class="ris-card-list ris-card-list__themes"
                        ref="defaultThemeListFinishedBlock"
                    >
                        <div class="ris-title">Kürzlich abgeschlossen</div>

                        @foreach ($topics_finished as $topic)
                            @if ($loop->iteration > 3)
                                @break
                            @endif
                            <a class="ris-card-list__item" title="{{ $topic->name }}"
                                    href="/thema/{{ $topic->id }}"
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
                @else
                    <section class="ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme
                        :theme-list-data="themeListFinished"
                        :theme-list-data-count="themeListFinishedCount"
                        :theme-list-type="themeListFinished ? 3 : null"
                        :theme-first-loading="firstLoading"
                >
                </theme>
            </div>

        </theme-list>

        @include('layouts.footer')

    </main>
@endsection
