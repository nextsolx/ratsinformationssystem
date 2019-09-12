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
                        @if (url()->current() === route('progress-themes'))
                            Kürzlich aktualisiert
                        @elseif (url()->current() === route('finished-themes'))
                            Kürzlich abgeschlossen
                        @else
                            Neue Themen
                        @endif
                    </h1>

                    <div class="ris-action-box">
                        <collapse></collapse>
                        <dropdown
                            :id="'theme-dropdown'"
                            label="Sortierung"
                            :value="{label: 'Fortschritt', value: 'Fortschritt'}"
                            :options="[
                                {label: 'Einstellungsdatum', value: 'Einstellungsdatum'},
                                {label: 'Fortschritt', value: 'Fortschritt'}
                            ]"
                        ></dropdown>
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
                        <div class="ris-title">Keine Themen verfügbar.</div>
                    </section>
                @endif

                <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                    <theme-component-lazy
                        :theme-list-type="
                            @if (url()->current() === route('progress-themes'))
                                'updated'
                            @elseif (url()->current() === route('finished-themes'))
                                'finished'
                            @else
                                'new'
                            @endif
                        "
                    >
                    </theme-component-lazy>
                </section>
            </div>
        </theme-list>

        @include('layouts.footer')

    </main>
@endsection
