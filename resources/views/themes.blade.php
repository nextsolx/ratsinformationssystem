@extends('layouts.app')

@section('content')
    <main class="ris-main ris-themes">

        @include('layouts.breadcrumbs')

        <div class="ris-themes__content">
            <h1 class="ris-headline">
                Themen
            </h1>

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
                                Thema
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
                                Thema
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
                                Thema
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

        @include('layouts.footer')

    </main>
@endsection
