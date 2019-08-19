@extends('layouts.app')

@section('content')

    @include('layouts.breadcrumbs')

    <people inline-template>    <main class="ris-main ris-people ris-content_six-eight-eight">
            <section class="ris-section-wrapper ris-people__headline">
                <img src="/img/thumbnail-big-people.svg" alt="Hamide Akbayir"
                    class="ris-people__img"
                />
                <div>
                    <h1 class="ris-headline">
                        Hamide Akbayir
                    </h1>
                    <div class="ris-body-2">DIE LINKE</div>
                    <div class="ris-caption">Gremienmitglied seit 2014</div>
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
                <div class="ris-people__contact-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__text">E-Mail</div>
                        <span class="ris-i ris-i_email"></span>
                    </div>
                    <a class="ris-link ris-link_phone" href="mailto:dielinke.koeln@stadt-koeln">dielinke.koeln@stadt-koeln</a>
                </div>
                <div class="ris-people__contact-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__text">Telefon</div>
                        <span class="ris-i ris-i_phone"></span>
                    </div>
                    <a class="ris-link" href="tel:0221-221 27840">0221-221 27840</a>
                </div>
                <div class="ris-people__contact-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__text">Fax</div>
                        <span class="ris-i ris-i_fax"></span>
                    </div>
                    <a class="ris-link" href="tel:0221-221 27841">0221-221 27841</a>
                </div>
                <div class="ris-people__contact-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__text">Adresse</div>
                        <span class="ris-i ris-i_marker-with-dot"></span>
                    </div>
                    <div class="ris-text">Bezirksrathaus Rodenkirchen, Hauptstr. 85, 50996 Köln</div>
                </div>
            </section>

            <section class="ris-section-wrapper ris-people__committee ris-tab-data"
                ref="committee"
            >
                <h2 class="ris-h2">Gremien</h2>
                <div class="ris-people__committee-count ris-body-2">Aktuell (2 Gremium)</div>
                <div class="ris-people__committee-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__headline">Ausschuss für Anregungen und Beschwerden</div>
                        <div class="ris-body-2__text">2. Stellvertretende Ausschussvorsitzende</div>
                    </div>
                    <div class="ris-caption">07/2014 - Heute</div>
                </div>
                <div class="ris-people__committee-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__headline">Rat</div>
                        <div class="ris-body-2__text">Ratsmitglied</div>
                    </div>
                    <div class="ris-caption">07/2014 - Heute</div>
                </div>

                <div class="ris-people__committee-count ris-body-2">Ehemalig (1 Gremium)</div>
                <div class="ris-people__committee-detail">
                    <div class="ris-body-2">
                        <div class="ris-body-2__headline">Ausschuss für Umwelt und Grün</div>
                        <div class="ris-body-2__text">Ratsmitglied</div>
                    </div>
                    <div class="ris-caption">07/2014 - Heute</div>
                </div>
            </section>

            <section class="ris-section-wrapper ris-people__document-list ris-tab-data"
                ref="document-list"
            >
                <h2 class="ris-h2">Dokumente</h2>
                <a class="ris-document ris-link" title="Erklärung nach dem Korruptionsbekämpfungsgesetz"
                    href="/downloadUrl"
                >
                    <img class="ris-img" src="/img/pdf.svg" alt="Erklärung nach dem Korruptionsbekämpfungsgesetz"/>
                    <span class="ris-text">Erklärung nach dem Korruptionsbekämpfungsgesetz</span>
                    <span class="ris-i ris-i_download-with-box"></span>
                </a>
                <a class="ris-document ris-link" title="Erklärung nach dem Korruptionsbekämpfungsgesetz"
                    href="/downloadUrl"
                >
                    <img class="ris-img" src="/img/pdf.svg" alt="Erklärung nach"/>
                    <span class="ris-text">Erklärung nach</span>
                    <span class="ris-i ris-i_download-with-box"></span>
                </a>

                {{--@if (isset($meeting['files']) and count($meeting['files']) > 0)
                    @foreach($meeting['files'] as $file)
                        <a class="ris-document ris-link" title="{{ $file['name'] }}"
                            href="/{{ $file['downloadUrl'] }}"
                        >
                            <img src="/img/pdf.svg" alt="{{ $file['name'] }}"/>
                            <span class="ris-text">{{ $file['name'] }}</span>
                            <span class="ris-i ris-i_download-with-box"></span>
                        </a>
                    @endforeach
                @else
                    <div class="ris-text">Keine Dokumente</div>
                @endif--}}
            </section>
        </main>
    </people>

    @include('layouts.footer')

@endsection
