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
                                            <img src="./img/thumbnail-bridge-big-tile.png" class="ris-top-card-list__item-img"
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



                <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                    ref="defaultThemeListNewBlock"
                >
                    <div class="ris-title">Neue Themen</div>

                    @if (!empty($topics_new))
                        @include('components.theme',
                            ['theme_list' => $topics_new, 'theme_type' => 'new', 'limit' => 3]
                        )

                        <a href="{{ route('new-themes') }}" class="ris-link ris-link_has-icon"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                        </a>
                    @else
                        <div class="ris-body-1">There are no topics</div>
                    @endif

                </section>

                <theme-overview-list
                        :theme-list-data="themeListNew"
                        :theme-list-data-count="themeListNewCount"
                        :theme-list-type="themeListNew ? 'new' : null"
                        :theme-first-loading="firstLoading"
                        :theme-type-link="'{{ route('new-themes') }}'"
                >
                </theme-overview-list>



                <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                    ref="defaultThemeListProgressBlock"
                >
                    <div class="ris-title">Kürzlich aktualisiert</div>

                    @if (!empty($topics_progress))
                        @include('components.theme',
                                ['theme_list' => $topics_progress, 'theme_type' => 'progress', 'limit' => 3]
                            )

                        <a href="{{ route('progress-themes') }}" class="ris-link ris-link_has-icon"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                        </a>
                    @else
                        <div class="ris-body-1">There are no topics</div>
                    @endif

                </section>

                <theme-overview-list
                        :theme-list-data="themeListProgress"
                        :theme-list-data-count="themeListProgressCount"
                        :theme-list-type="themeListProgress ? 'progress' : null"
                        :theme-first-loading="firstLoading"
                        :theme-type-link="'{{ route('progress-themes') }}'"
                >
                </theme-overview-list>



                <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                    ref="defaultThemeListFinishedBlock"
                >
                    <div class="ris-title">Kürzlich abgeschlossen</div>

                    @if (!empty($topics_finished))
                        @include('components.theme',
                                ['theme_list' => $topics_finished, 'theme_type' => 'finished', 'limit' => 3]
                            )

                        <a href="{{ route('finished-themes') }}" class="ris-link ris-link_has-icon"
                                title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                        </a>
                    @else
                        <div class="ris-body-1">There are no topics</div>
                    @endif

                </section>

                <theme-overview-list
                        :theme-list-data="themeListFinished"
                        :theme-list-data-count="themeListFinishedCount"
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
