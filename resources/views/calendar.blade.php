@extends('layouts.app')

@section('content')
    <main class="ris-content ris-calendar">
        <h1 class="ris-calendar__headline ris-headline">
            Sitzungskalender
        </h1>

        <div class="ris-calendar__flex-wrapper">
            <calendar-app></calendar-app>

            <div class="ris-calendar__content">
                <div class="ris-calendar__card-list-wrapper">

                    <div class="ris-calendar__card-list">
                        <section class="ris-calendar__card-day">
                            <div class="ris-calendar__card-day-left">
                                3<br/>
                                <span class="ris-calendar__card-day-of-week">Mo</span>
                            </div>

                            <div class="ris-calendar__card-day-right">
                                <div class="ris-calendar__card">
                                    <h2 class="ris-headline">
                                        Unterausschuss Kulturbauten
                                    </h2>
                                    <div class="ris-subheader">
                                        UAK/0019/2018
                                    </div>
                                    <div class="ris-session-count">
                                        <div class="ris-session-count__agenda">22</div>
                                        <div class="ris-session-count__people">30</div>
                                        <div class="ris-session-count__file">22</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="ris-calendar__card-list">
                        <section class="ris-calendar__card-day">
                            <div class="ris-calendar__card-day-left">
                                4<br/>
                                <span class="ris-calendar__card-day-of-week">Di</span>
                            </div>

                            <div class="ris-calendar__card-day-right">
                                <div class="ris-calendar__card">
                                    <h2 class="ris-headline">
                                        Integrationsrat
                                    </h2>
                                    <div class="ris-subheader">
                                        IR/0034/2018
                                    </div>
                                    <div class="ris-session-count">
                                        <div class="ris-session-count__agenda">22</div>
                                        <div class="ris-session-count__people">30</div>
                                        <div class="ris-session-count__file">22</div>
                                    </div>
                                </div>

                                <div class="ris-calendar__card">
                                    <h2 class="ris-headline">
                                        Ausschuss Schule und Weiterbildung
                                    </h2>
                                    <div class="ris-subheader">
                                        SHA/0036/2018
                                    </div>
                                    <div class="ris-session-count">
                                        <div class="ris-session-count__agenda">22</div>
                                        <div class="ris-session-count__people">30</div>
                                        <div class="ris-session-count__file">22</div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                @include('layouts.footer')

            </div>

        </div>
    </main>
@endsection
