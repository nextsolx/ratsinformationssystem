@extends('layouts.app')

@section('content')
    <main class="ris-main ris-theme-overview">

        @include('layouts.breadcrumbs')

        <theme-overview inline-template>

            <div class="ris-theme-overview__content ris-content ris-content_six-eight-eight">
                <section class="ris-section-wrapper">
                    <h1 class="ris-headline">
                        Themen
                    </h1>

                    <div class="ris-action-box">
                        <collapse></collapse>
                        <dropdown
                            :id="'theme-dropdown'"
                            label="Sortierung"
                            :value="dropValue"
                            :options="[
                                {label: 'Einstellungsdatum', value: 'date'},
                                {label: 'Fortschritt', value: 'progress'}
                            ]"
                        ></dropdown>
                    </div>
                </section>

                @if (!empty($topics_top))
                    <section class="ris-section-wrapper ris-top-card-list">
                        <div class="ris-title">Top-Themen</div>

                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($topics_top as $topic)
                                    <a class="ris-top-card-list__item swiper-slide" title="{{ $topic->name }}"
                                        href="{{ route('theme', $topic->id) }}"
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
                                                Thema {{ $topic->reference }}
                                            </div>
                                            <div class="ris-top-card-list__item-progress-box">
                                                @if ($topic->finished)
                                                    <div class="ris-item-finished">
                                                        <span class="ris-i ris-i_check ris-i_has-bg"></span>
                                                        Abgeschl
                                                    </div>
                                                @else
                                                    <div class="ris-progress-bar">
                                                        <div class="ris-progress-bar__progress" style="width: @if ($topic->newTopic) 25% @else 75% @endif"></div>
                                                    </div>
                                                @endif
                                                <div class="ris-caption ris-top-card-list__item-date">
                                                    {{ \Illuminate\Support\Carbon::parse($topic->date)->format('d.m.Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                @endforeach
                            </div>
                        </div>

                    </section>
                @endif

                <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                    <div class="ris-title">Neue Themen List</div>

                    @if (!empty($topics_new))
                        @include('components.theme',
                            ['theme_list' => $topics_new, 'theme_type' => 'new', 'limit' => 3]
                        )

                        <a href="{{ route('new-themes') }}" class="ris-link ris-link_button ris-link_right"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    @else
                        <div class="ris-body-1">Keine Themen verfügbar.</div>
                    @endif

                </section>

                <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                    <div class="ris-title">Kürzlich aktualisiert</div>

                    @if (!empty($topics_progress))
                        @include('components.theme',
                                ['theme_list' => $topics_progress, 'theme_type' => 'updated', 'limit' => 3]
                            )

                        <a href="{{ route('progress-themes') }}" class="ris-link ris-link_button ris-link_right"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    @else
                        <div class="ris-body-1">Keine Themen verfügbar.</div>
                    @endif

                </section>

                <section class="ris-section-wrapper ris-card-list ris-card-list__themes">
                    <div class="ris-title">Kürzlich abgeschlossen</div>

                    @if (!empty($topics_finished))
                        @include('components.theme',
                                ['theme_list' => $topics_finished, 'theme_type' => 'finished', 'limit' => 3]
                            )

                        <a href="{{ route('finished-themes') }}" class="ris-link ris-link_button ris-link_right"
                            title="Mehr anzeigen"
                        >
                            Mehr anzeigen
                            <span class="ris-i ris-i_chevron-right"></span>
                        </a>
                    @else
                        <div class="ris-body-1">Keine Themen verfügbar.</div>
                    @endif

                </section>
            </div>

        </theme-overview>

        @include('layouts.footer')

    </main>
@endsection
