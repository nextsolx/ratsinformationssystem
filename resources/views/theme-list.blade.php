@extends('layouts.app')

@section('content')
    <main class="ris-main ris-themes">

        @include('layouts.breadcrumbs')

        <theme-list inline-template
                :default-district-list="{{json_encode($district_list)}}"
        >

            <div class="ris-themes__content">
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

                @if (!empty($theme_list))
                    <section class="ris-card-list ris-card-list__themes"
                        ref="defaultThemeList"
                    >

                        @include('components.theme',
                            ['theme_list' => $theme_list, 'theme_type' => $theme_type]
                        )

                    </section>
                @else
                    <section class="ris-card-list ris-card-list__themes">
                        <div class="ris-title">There are no topics</div>
                    </section>
                @endif

                <theme
                        :theme-list-data="themeListData"
                        :theme-list-type="themeListType"
                >
                </theme>

            </div>
        </theme-list>

        @include('layouts.footer')

    </main>
@endsection