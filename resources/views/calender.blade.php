@extends('layouts.app')

@section('content')
    <main class="ris-content ris-calender">
        <h1 class="ris-calender__headline ris-headline">
            Sitzungskalender
        </h1>

        <div class="ris-calender__flex-wrapper">
            <calender-app></calender-app>

            <div class="ris-calender__content">
                <div class="ris-calender__card-list-wrapper">

                    <div class="ris-calender__card-list">
                        <section class="ris-calender__card-day">
                            <div class="ris-calender__card-day-left">
                                3<br/>
                                <span class="ris-calender__card-day-of-week">Mo</span>
                            </div>

                            <div class="ris-calender__card-day-right">
                                <div class="ris-calender__card">
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

                    <div class="ris-calender__card-list">
                        <section class="ris-calender__card-day">
                            <div class="ris-calender__card-day-left">
                                4<br/>
                                <span class="ris-calender__card-day-of-week">Di</span>
                            </div>

                            <div class="ris-calender__card-day-right">
                                <div class="ris-calender__card">
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

                                <div class="ris-calender__card">
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
