@extends('layouts.app')

@section('content')
    <main class="ris-main ris-theme-overview">

        @include('layouts.breadcrumbs')

        <theme-overview inline-template
            :default-district-list="{{json_encode($district_list)}}"
        >

            <div class="ris-theme-overview__content ris-content ris-content_six-eight-eight">
                <section class="ris-section-wrapper">
                    <h1 class="ris-headline">
                        Themen
                    </h1>

                    <div class="ris-action-box">
                        <div class="ris-filter"
                            :class="{'ris-filter_active': activeFilter}"
                        >
                            <div class="ris-filter__subheader ris-subheader"
                                @click="collapseFilter"
                            >
                            <span class="ris-i ris-i_filter"></span>
                                Filtern
                            </div>

                            <div class="ris-filter__content">
                                <div class="ris-filter-buttons ris-filter-buttons__selected"
                                        :class="selectedDistrictList.length > 0
                                        ? 'ris-filter-buttons__selected_active'
                                        : ''"
                                    v-show="selectedDistrictList.length > 0"
                                >
                                    <button class="ris-label ris-label_has-border"
                                            v-for="currentDistrictName in selectedDistrictList"
                                            @click="removeSelectedDistrict(currentDistrictName)"
                                    >
                                        @{{ currentDistrictName }}
                                        <span class="ris-i ris-i_close"></span>
                                    </button>
                                </div>

                                <div class="ris-filter-buttons"
                                    v-show="firstLoading"
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
                            <span class="ris-i ris-i_chevron-double"></span>
                        </div>
                    </div>
                </section>

                @if (!empty($topics))
                    <section class="ris-section-wrapper ris-top-card-list">
                        <div class="ris-title">Top-Themen</div>

                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($topics as $topic)
                                    @if ($loop->iteration > 10)
                                        @break
                                    @endif

                                    <a class="ris-top-card-list__item swiper-slide" title="{{ $topic->name }}"
                                        href="/thema/{{ $topic->id }}"
                                    >
                                        <div class="ris-top-card-list__item-top">
                                            <img src="/img/thumbnail-bridge-big-tile.png" class="ris-top-card-list__item-img"
                                                 alt="{{ $topic->name }}"/>
                                            <div class="ris-body-1">
                                                {{ $topic->name }}
                                            </div>
                                        </div>
                                        <div class="ris-top-card-list__item-bottom">
                                            <div class="ris-caption ris-top-card-list__item-number">
                                                Thema &nbsp;
                                                <span>2477</span>
                                                /
                                                <span>{{ Carbon\Carbon::parse('27.10.2018')->year }}</span>
                                            </div>
                                            <div class="ris-top-card-list__item-progress-box">
                                                <div class="ris-progress-bar">
                                                    <div class="ris-progress-bar__progress" style="width: 25%"></div>
                                                </div>
                                                <div class="ris-caption ris-top-card-list__item-date">27.10.2018</div>
                                            </div>
                                        </div>
                                    </a>

                                @endforeach
                            </div>
                        </div>

                    </section>
                @endif


                @if (!empty($topics_new))
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                        v-show="themeListNew.length === 0 && firstLoading"
                    >
                        <div class="ris-title">Neue Themen</div>

                        @include('components.theme',
                            ['theme_list' => $topics_new, 'theme_type' => 'new', 'limit' => 3]
                        )

                        <a href="{{ route('new-themes') }}" class="ris-link ris-link_button ris-link_right"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    </section>
                @else
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme-overview-list
                        :theme-list-data="themeListNew"
                        :theme-list-type="themeListNew ? 'new' : null"
                        :theme-first-loading="firstLoading"
                        :theme-type-link="'{{ route('new-themes') }}'"
                >
                </theme-overview-list>



                @if (!empty($topics_progress))
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                        v-show="themeListProgress.length === 0 && firstLoading"
                    >
                        <div class="ris-title">Kürzlich aktualisiert</div>

                        @include('components.theme',
                                ['theme_list' => $topics_progress, 'theme_type' => 'progress', 'limit' => 3]
                            )

                        <a href="{{ route('progress-themes') }}" class="ris-link ris-link_button ris-link_right"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    </section>
                @else
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme-overview-list
                        :theme-list-data="themeListProgress"
                        :theme-list-type="themeListProgress ? 'progress' : null"
                        :theme-first-loading="firstLoading"
                        :theme-type-link="'{{ route('progress-themes') }}'"
                >
                </theme-overview-list>



                @if (!empty($topics_finished))
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                        v-show="themeListFinished.length === 0 && firstLoading"
                    >
                        <div class="ris-title">Kürzlich abgeschlossen</div>

                        @include('components.theme',
                                ['theme_list' => $topics_finished, 'theme_type' => 'finished', 'limit' => 3]
                            )

                        <a href="{{ route('finished-themes') }}" class="ris-link ris-link_button ris-link_right"
                                title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    </section>
                @else
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme-overview-list
                        :theme-list-data="themeListFinished"
                        :theme-list-type="themeListFinished ? 'finished' : null"
                        :theme-first-loading="firstLoading"
                        :theme-type-link="'{{ route('finished-themes') }}'"
                >
                </theme-overview-list>
            </div>

        </theme-overview>

        @include('layouts.footer')

    </main>
@endsection
