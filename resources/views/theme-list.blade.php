@extends('layouts.app')

@section('content')
    <main class="ris-main ris-theme-list">

        @include('layouts.breadcrumbs')

        <theme-list inline-template
                :default-district-list="{{json_encode($district_list)}}"
        >

            <div class="ris-theme-list__content ris-content ris-content_six-eight-eight">
                <section class="ris-section-wrapper">
                    <h1 class="ris-headline">
                        @if (url()->current() === route('new-themes'))
                            Neue Themen
                        @elseif (url()->current() === route('progress-themes'))
                            Kürzlich aktualisiert
                        @elseif (url()->current() === route('finished-themes'))
                            Kürzlich abgeschlossen
                        @else {
                            Neue Themen
                        @endif
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
                            <span class="ris-i ris-i_chevron-double"></span>
                    </div>
                    </div>
                </section>

                @if (!empty($theme_list))
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes"
                        v-show="themeListData.length === 0 && firstLoading"
                    >

                        @include('components.theme',
                            ['theme_list' => $theme_list, 'theme_type' => $theme_type]
                        )

                    </section>
                @else
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                    <theme
                            :theme-list-data="themeListData"
                            :theme-list-type="themeListType"
                    >
                    </theme>
                </section>

            </div>
        </theme-list>

        @include('layouts.footer')

    </main>
@endsection
