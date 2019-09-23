@extends('layouts.app')

@section('content')

    @include('layouts.breadcrumbs')
    <people inline-template>
        <main class="ris-main ris-people ris-content_six-eight-eight">
            <section class="ris-section-wrapper ris-people__headline">
                <img src="{{ $person->photo ? $person->photo : '/img/thumbnail-big-people.svg' }}"
                    alt="{{ $person->name }}" class="ris-people__img"
                />
                <div>
                    <h1 class="ris-headline">
                        {{ $person->name }}
                    </h1>
                    @if ($person->party)
                        <div class="ris-body-2">{{ $person->party }}</div>
                    @endif
                    @if (isset($person->committeeList))
                        <div class="ris-caption">
                            Gremienmitglied seit
                            {{ \Illuminate\Support\Carbon::parse($person->memberships[count($person->memberships)-1]->start_date)->year }}
                        </div>
                    @endif
                </div>
            </section>

            <section class="ris-section-wrapper ris-tab__mobile">
                <ul class="ris-tab-list">
                    <li class="ris-tab ris-tab_active" @click="openTab($event, 'contact')">
                        <h2 class="ris-h2">Kontakt</h2>
                    </li>
                    <li class="ris-tab" @click="openTab($event, 'committee')">
                        <h2 class="ris-h2">Gremien</h2>
                    </li>
                    <li class="ris-tab" @click="openTab($event, 'document-list')">
                        <h2 class="ris-h2">Dokumente</h2>
                    </li>
                </ul>
            </section>

            <section class="ris-section-wrapper ris-people__contact ris-tab-data ris-tab-data_active"
                ref="contact"
            >
                <h2 class="ris-h2">Kontakt</h2>

                @if (isset($person->email))
                    <div class="ris-people__contact-detail">
                        <div class="ris-body-2">
                            <div class="ris-body-2__text">E-Mail</div>
                            <span class="ris-i ris-i_email"></span>
                        </div>
                        <a class="ris-link ris-link_phone" href="mailto:{{ $person->email }}">{{ $person->email }}</a>
                    </div>
                @endif
                @if (isset($person->phone))
                    <div class="ris-people__contact-detail">
                        <div class="ris-body-2">
                            <div class="ris-body-2__text">Telefon</div>
                            <span class="ris-i ris-i_phone"></span>
                        </div>
                        <a class="ris-link" href="tel:{{ $person->phone }}">{{ $person->phone }}</a>
                    </div>
                @endif
                @if (isset($person->fax))
                    <div class="ris-people__contact-detail">
                        <div class="ris-body-2">
                            <div class="ris-body-2__text">Fax</div>
                            <span class="ris-i ris-i_fax"></span>
                        </div>
                        <a class="ris-link" href="tel:{{ $person->fax }}">{{ $person->fax }}</a>
                    </div>
                @endif
                @if (isset($person->location))
                    <div class="ris-people__contact-detail">
                        <div class="ris-body-2">
                            <div class="ris-body-2__text">Adresse</div>
                            <span class="ris-i ris-i_marker-with-dot"></span>
                        </div>
                        <a class="ris-link ris-text" href="/karte">
                            @if (isset($person->location->streetAddress))
                                {{$person->location->streetAddress}}
                            @endif
                            <br>
                            @if (isset($person->location->postalCode))
                                {{$person->location->postalCode}}
                            @endif
                            @if (isset($person->location->city))
                                {{$person->location->city}}
                            @endif
                        </a>
                    </div>
                @endif
            </section>

            @if (isset($person->committeeList))
                <section class="ris-section-wrapper ris-people__committee ris-tab-data"
                    ref="committee"
                >
                    <h2 class="ris-h2">Gremien</h2>

                    @if (isset($person->committeeList) && isset ($person->memberships))
                        <div class="ris-people__committee-count ris-body-2">
                            Aktuell ({{ count($person->committeeList) }} Gremium)
                        </div>
                        @foreach ($person->memberships as $membership)
                            @for($i = 0; $i < count($person->committeeList); $i++)
                                @if($person->committeeList[$i]->id == $membership->organization_id)
                                    <div class="ris-people__committee-detail">
                                        <div class="ris-body-2">
                                            @if (isset($person->committeeList[$i]->name))
                                                <div class="ris-body-2__headline">{{ $person->committeeList[$i]->name }}</div>
                                            @endif
                                            @if (isset($person->committeeList[$i]->role))
                                                <div class="ris-body-2__text">{{ $person->committeeList[$i]->role }}</div>
                                            @endif
                                        </div>
                                        <div class="ris-caption">
                                            {{ \Illuminate\Support\Carbon::parse($membership->start_date)->format('m/Y') }} -
                                            @if (isset($membership->end_date) and $membership->end_date)
                                                {{ \Illuminate\Support\Carbon::parse($membership->end_date)->format('m/Y') }}
                                            @else
                                                Heute
                                            @endif
                                        </div>
                                    </div>
                                    @php $i=count($person->committeeList) @endphp
                                @endif
                            @endfor
                        @endforeach
                    @endif
                </section>
            @endif

            <section class="ris-section-wrapper ris-people__document-list ris-tab-data"
                ref="document-list"
            >
                <h2 class="ris-h2">Dokumente</h2>

                @if (isset($person->files))
                    @foreach($person->files as $file)
                        <a class="ris-document ris-link" title="{{ $file->name }}"
                            href="{{ $file->downloadUrl }}"
                        >
                            <img class="ris-img" src="/img/pdf.svg" alt="{{ $file->name }}"/>
                            <span class="ris-text">{{ $file->name }}</span>
                            <span class="ris-i ris-i_download-with-box"></span>
                        </a>
                    @endforeach
                @else
                    <div class="ris-text">Keine Dokumente</div>
                @endif
            </section>
        </main>
    </people>

    @include('layouts.footer')

@endsection
