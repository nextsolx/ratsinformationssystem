@extends('layouts.app')

@section('content')
    <main class="ris-main ris-theme">

        @include('layouts.breadcrumbs')

        <div class="ris-theme__content ris-content ris-content_six-eight-eight">

            <section class="ris-section-wrapper ris-section-wrapper_full">
                <div class="ris-img-wrapper">
                    <img src="/img/thumbnail-very-big-bridge.jpg" class="ris-img"
                        alt="{{ $topic->name }}"/>
                </div>
                <div class="ris-caption">Thema {{ $topic->reference }}</div>
                <h1 class="ris-headline">{{ $topic->name }}</h1>
                <div class="ris-caption">Zuletzt aktualisiert: {{ \Illuminate\Support\Carbon::parse($topic->modified)->format('d.m.Y') }}</div>
            </section>

            <section class="ris-section-wrapper">
                <h2 class="ris-h2">Worum geht es?</h2>
                @if (isset($topic->text))
                    <div class="ris-body-2 ris-theme__text">
                        {{ \Illuminate\Support\Str::limit(strip_tags($topic->text), 10000) }}
                    </div>
                @else
                    <div class="ris-body-2">Nicht Beschrieben.</div>
                @endif
            </section>

            @if (isset($topic->location) && count($topic->location) > 0)
                <section class="ris-section-wrapper">
                    <h2 class="ris-h2">Ort</h2>

                    <div class="ris-map-img ris-img-wrapper">
                        <a href="{{ route('map') }}" class="ris-link"
                            title="{{ $topic->location[0]->city }}"
                        >
                            <img src="/img/thumbnail-very-big-map.jpg" class="ris-img"
                                alt="{{ $topic->location[0]->city }}"/>
                        </a>
                    </div>

                    <div class="ris-map-detail">
                        <div class="ris-map-all-street-address ris-body-2">
                            <span class="ris-i ris-i_marker-with-dot"></span>
                            <div>
                                <div>{{ $topic->location[0]->streetAddress }}</div>
                                <div>{{ $topic->location[0]->postalCode }} {{ $topic->location[0]->city }}</div>
                            </div>
                        </div>

                        {{--@todo --- fix link--}}
                        <a href="{{ route('map') }}" class="ris-link ris-link_button ris-link_right"
                            title="{{ $topic->location[0]->city }}"
                        >
                            Karte öffnen
                            <span class="ris-i ris-i_resize-text"></span>
                        </a>
                    </div>
                </section>
            @endif

            @if (isset($topic->process))
                <theme-sort inline-template
                    :theme-id="'{{ $topic->id }}'"
                >
                    <section class="ris-section-wrapper">
                        <div class="ris-action-box">
                            <h2 class="ris-h2">Politischer Prozess</h2>

                            <dropdown
                                :id="'theme-dropdown'"
                                label="Darstellung"
                                :value="dropValue"
                                :options="[
                                    {label: 'Chronologische Reihenfolge', value: 'id'},
                                    {label: 'Das Neuste zuerst', value: 'dateFrom'},
                                ]"
                                @change="changeProcessList"
                            ></dropdown>
                        </div>

                        <div class="ris-process">
                            <div class="ris-process__detail ris-process__item">
                                <span class="ris-i ris-i_check ris-i_has-bg"></span>
                                <div class="ris-process__date ris-body-2">{{ \Illuminate\Support\Carbon::parse($topic->date)->format('d. F Y') }}</div>
                                <h3 class="ris-process__name ris-h3">{{ $topic->name }}</h3>
                                <div class="ris-process__text ris-body-2">{{ \Illuminate\Support\Str::limit(strip_tags($topic->text), 5000) }}</div>
                                <div class="ris-process__wrapper">
                                    <div class="ris-caption">Beschlussvorlage {{ $topic->reference }}</div>

                                    @if (isset($topic->files))
                                        <a href="{{ $topic->files[0]->accessUrl }}" class="ris-link ris-link_button ris-link_right"
                                            title="Beschlussvorlage öffnen"
                                        >
                                            Beschlussvorlage öffnen
                                            <span class="ris-i ris-i_resize-text"></span>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            @foreach ($topic->process as $process)
                                @if (isset($process->meeting) and isset($process->agendum))
                                    <div class="ris-process__agendum ris-process__item"
                                        v-if="!processSortedList.length > 0"
                                    >
                                        <span class="ris-i ris-i_check ris-i_has-bg"></span>

                                        @if (isset($process->meeting->dateFrom))
                                            <div class="ris-process__agendum-start ris-body-2">{{ \Illuminate\Support\Carbon::parse($process->meeting->dateFrom)->format('d. F Y') }}</div>
                                        @endif
                                        @if ($process->agendum->name)
                                            <h3 class="ris-process__agendum-name ris-h3">{{ $process->agendum->name }}</h3>
                                        @endif
                                        @if (isset($process->agendum->resolutionText))
                                            <div class="ris-process__meeting-state ris-body-2">{{ $process->agendum->resolutionText }}</div>
                                        @endif

                                        <div class="ris-process__wrapper">
                                            <div>
                                                <div class="ris-caption">Tagesordnungspunkt (TOP) {{ $process->agendum->number }}</div>
                                            </div>
                                            <a href="/meeting/{{ $process->meeting->id }}" class="ris-link ris-link_button ris-link_right"
                                                title="Zur Sitzung"
                                            >
                                                Zur Sitzung
                                                <span class="ris-i ris-i_chevron-right"></span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            <div class="ris-process__agendum ris-process__item"
                                v-for="process in processSortedList"
                                v-cloak
                            >
                                <span class="ris-i ris-i_check ris-i_has-bg"></span>

                                <div class="ris-process__agendum-start ris-body-2"
                                    v-if="process.meeting.dateFrom"
                                >
                                    @{{ process.meeting.dateFrom | momentDate }}
                                </div>
                                <h3 class="ris-process__agendum-name ris-h3"
                                    v-if="process.agendum.name"
                                >
                                    @{{ process.agendum.name }}
                                </h3>
                                <div class="ris-process__meeting-state ris-body-2"
                                    v-if="process.agendum.resolutionText"
                                >
                                    @{{ process.agendum.resolutionText }}
                                </div>

                                <div class="ris-process__wrapper">
                                    <div>
                                        <div class="ris-caption">Tagesordnungspunkt (TOP) @{{ process.agendum.number }}</div>
                                    </div>
                                    <a :href="'/meeting/' + process.meeting.id" class="ris-link ris-link_button ris-link_right"
                                        title="Zur Sitzung"
                                    >
                                        Zur Sitzung
                                        <span class="ris-i ris-i_chevron-right"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </section>
                </theme-sort>
            @endif

            @if (isset($topic->solution))
                <section class="ris-section-wrapper">
                    <h2 class="ris-h2">Ergebnis</h2>
                    <div class="ris-body-2">
                        {{ $topic->solution }}
                    </div>
                </section>
            @endif

            @if (isset($topic->whatNext))
                <section class="ris-section-wrapper">
                    <h2 class="ris-h2">Was passiert jetzt?</h2>
                    <div class="ris-body-2">
                        {{ $topic->whatNext }}
                    </div>
                </section>
            @endif

            <section class="ris-section-wrapper">
                <h2 class="ris-h2">Dokumente</h2>

                @if (isset($topic->files))
                    {{--
                    // @todo --- Alle Dokumente --- this will not be in this scope of functionality
                    <div class="ris-document ris-document-many">
                        <div class="ris-icon-wrapper">
                            <img src="/img/pdf-many.svg" class="ris-img" alt="Alle Dokumente"/>
                        </div>
                        <div class="ris-text-wrapper">
                            <div class="ris-title">Alle Dokumente gebündelt</div>
                            <div class="ris-body-2">6 Dateien | 5,5 MB</div>
                        </div>
                    </div>--}}

                    @foreach($topic->files as $file)
                        <a class="ris-document ris-document-one ris-link" title="{{ $file->name }}"
                            href="{{ $file->downloadUrl }}"
                        >
                            <div class="ris-icon-wrapper">
                                <img src="/img/pdf.svg" class="ris-img" alt="{{ $file->name }}"/>
                            </div>
                            <span class="ris-text-wrapper">{{ $file->name }}</span>
                            <span class="ris-i ris-i_download-with-box"></span>
                        </a>
                    @endforeach
                @else
                    <div class="ris-title">Keine Dokumente</div>
                @endif
            </section>

        </div>

        @include('layouts.footer')

    </main>
@endsection
