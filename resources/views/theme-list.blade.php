@extends('layouts.app')

@section('content')
    <main class="ris-main ris-theme-list">

        @include('layouts.breadcrumbs')

            <div class="ris-theme-list__content ris-content ris-content_six-eight-eight">
                <section class="ris-section-wrapper">
                    <h1 class="ris-headline">
                        @if (!empty($topic_title))
                            {{ $topic_title }}
                        @else
                            Themen
                        @endif
                    </h1>

                    <div class="ris-action-box">
                        <ui-collapse></ui-collapse>
                        <ui-dropdown
                            :id="'theme-dropdown'"
                            label="Sortierung"
                            :value="@if ($theme_type === 'updated')
                                {label: 'Fortschritt', value: 'updated'}
                            @elseif ($theme_type === 'finished')
                                {label: 'Abgeschlossen', value: 'finished'}
                            @else
                                {label: 'Einstellungsdatum', value: 'new'}
                            @endif"
                            :options="[
                                {label: 'Einstellungsdatum', value: 'new'},
                                {label: 'Fortschritt', value: 'updated'},
                                {label: 'Abgeschlossen', value: 'finished'}
                            ]"
                            :open-on-new-tab="true"
                            :tab-url="'/themen?section'"
                        ></ui-dropdown>
                    </div>
                </section>

                @if (!empty($theme_list))
                    <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
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
                            @if ($theme_type === 'updated')
                                'updated'
                            @elseif ($theme_type === 'finished')
                                'finished'
                            @else
                                'new'
                            @endif
                        "
                    >
                    </theme-component-lazy>
                </section>
            </div>

    </main>

    @include('layouts.footer')

@endsection
