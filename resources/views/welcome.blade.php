@extends('layouts.app')

@section('content')
    <main class="ris-content ris-content__welcome">
        <div class="ris-welcome">
            <div class="ris-welcome__headline">
                <img class="ris-welcome__headline-img_left" src="./img/couple_near_table.png" alt="Kölner Stadtpolitik"/>
                <div>
                    <h1 class="ris-headline">
                        Kölner Stadtpolitik
                    </h1>
                    <div class="ris-subheader">
                        Einfach und Transparent
                    </div>
                </div>
            </div>

            <map-mobile-app class="map-mobile"></map-mobile-app>

            <section class="ris-card-list">
                <div class="ris-title">Kommende Stadtrat Sitzungen</div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">02.05.2019, 15:30 Uhr</div>
                    <a class="ris-link ris-link_has-icon">Ausschuss Soziales und Senioren</a>
                    <div class="ris-body-2">Historisches Rathaus, Konrad ....</div>
                </div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">02.05.2019, 15:30 Uhr</div>
                    <a class="ris-link ris-link_has-icon">Ausschuss Soziales und Senioren</a>
                    <div class="ris-body-2">Historisches Rathaus, Konrad ....</div>
                </div>

                <a href="/kalender" class="ris-link ris-body2">
                    Zur Sitzungsübersicht
                </a>
            </section>

            <section class="ris-card-list">
                <div class="ris-title">Aktuelle Themen und Vorlagen</div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">Bürgereingabe: BV3/0020/2016</div>
                    <a class="ris-link ris-link_has-icon">Entwicklung einer Beteiligungskultur für Köln</a>
                    <div class="ris-body-2">Letzte Bearbeitung: 27.10.2018</div>
                </div>

                <div class="ris-card-list__item">
                    <div class="ris-caption">Bürgereingabe: BV3/0020/2016</div>
                    <a class="ris-link ris-link_has-icon">Generalsanierung Drehbrücke Deutzer Hafen</a>
                    <div class="ris-body-2">Letzte Bearbeitung: 27.10.2018</div>
                </div>

                <a href="/themen_and_karte" class="ris-link ris-body2">
                    Alle Themen ansehen
                </a>
            </section>

            <div class="ris-hint-box">
                <div>
                    <div class="ris-title">Die Gremien</div>
                    <div class="ris-subheader">
                        Wer entscheidet? Welches Organ ist für mein Anliegen zuständig?
                    </div>
                    <a href="/themen_and_karte" class="ris-link ris-link__secondary ris-body2">
                        Was macht der Stadtrat?
                    </a>
                </div>
                <img class="ris-welcome__headline-img_right" src="./img/car_with_man.png" alt="Kölner Stadtpolitik"/>
            </div>
        </div>

        <map-desktop-app class="map-desktop"></map-desktop-app>
    </main>
@endsection
