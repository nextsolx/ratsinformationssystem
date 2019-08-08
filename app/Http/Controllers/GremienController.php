<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class GremienController extends Controller
{

    public function view()
    {
        return view('committee')->with([
            'title' => 'Ausschuss für Anregungen und Beschwerden (BA)',
            'info' => 'Beratung von Anregungen und Beschwerden gemäß § 24 der Gemeindeordnung NRW in Verbindung mit § 14 der Hauptsatzung der Stadt Köln.

Seit der Reform der nordrheinwestfälischen Gemeindeordnung im Jahre 1994 gibt es für die Bürgerinnen und Bürger in einer Vielzahl kommunaler Angelegenheiten mehr Beteiligungsmöglichkeiten. So können Anregungen oder Beschwerden an den Rat oder eine Bezirksvertretung gerichtet werden. Weitere partizipative Instrumente sind der Einwohnerantrag, das Bürgerbegehren oder der Bürgerentscheid.

Wenn Sie also ein Anliegen haben, über das nur ein politisches Gremium (Rat, Ausschuss, Bezirksvertretung) entscheiden kann, dann reichen Sie eine Eingabe nach § 24 der Gemeindeordnung Nordrhein-Westfalen (GO NW) ein.

Nach § 24 GO NW hat jeder das Recht, sich einzeln oder in Gemeinschaft mit anderen schriftlich mit Anregungen oder Beschwerden in Angelegenheiten der Gemeinde an den Rat oder die Bezirksvertretung zu wenden.

Zur Behandlung der Eingaben an den Rat der Stadt Köln hat der Rat einen Ausschuss für Anregungen und Beschwerden gebildet. Je nach Zuständigkeit können Sie sich also an den Ausschuss oder die zuständige Bezirksvertretung wenden.

Nach Beteiligung der zuständigen Fachverwaltung wird Ihre Eingabe eingehend im Ausschuss für Anregungen und Beschwerden oder in der Bezirksvertretung beraten. Sie werden zu der Sitzung eingeladen und erhalten Gelegenheit, Ihre Eingabe vor den Politikerinnen und Politikern zu erläutern.

Zu den Anregungen und Beschwerden kann der Ausschuss Empfehlungen, zum Beispiel an den Rat oder die Verwaltung aussprechen. Die Bezirksvertretungen können innerhalb ihrer Zuständigkeitsbereiche selbst entscheiden.

Es gibt aber auch Angelegenheiten, für die ein besonderes Verwaltungsverfahren vorgeschrieben ist und bei denen der Ausschuss oder die Bezirksvertretungen in der Regel nicht tätig werden können. Dies ist etwa der Fall bei Dienstaufsichts-beschwerden oder wenn die Möglichkeit von Rechtsmitteln oder formellen Rechtsbehelfen (zum Beispiel Widersprüche, Klagen) gegeben ist.

Bei der Geschäftsstelle des Ausschusses für Anregungen und Beschwerden können Sie sich auch über weitere Möglichkeiten kommunalpolitischer Mitwirkung der Bürgerinnen und Bürger, zum Beispiel durch einen Einwohnerantrag (§ 24 GO NW) oder durch Bürgerbegehren und Bürgerbescheid (§ 26 GO NW), informieren.',
            'members' => [
                [
                    'name' => 'Horst Thelen',
                    'photo' => 'https://randomuser.me/api/portraits/men/24.jpg',
                    'role' => 'Ausschussvorsitzender',
                    'party' => 'GRÜNE'
                ],
                [
                    'name' => 'Frank Schneider',
                    'photo' => 'https://randomuser.me/api/portraits/men/27.jpg',
                    'role' => '1. Stellvertretender Ausschussvorsitzender',
                    'party' => 'SPD'
                ],
                [
                    'name' => 'Hamide Akbayir',
                    'photo' => 'https://randomuser.me/api/portraits/men/25.jpg',
                    'role' => '2. Stellvertretende Ausschussvorsitzende',
                    'party' => 'DIE LINKE'
                ],
                [
                    'name' => 'Polina Frebel',
                    'photo' => 'https://randomuser.me/api/portraits/women/4.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'SPD'
                ],
                [
                    'name' => 'Erika Oedingen',
                    'photo' => 'https://randomuser.me/api/portraits/women/5.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'SPD'
                ],
                [
                    'name' => 'Dagmar Paffen',
                    'photo' => 'https://randomuser.me/api/portraits/women/6.jpg',
                    'role' => 'Sachkundige Bürgerin nach § 58 Absatz 3 GO NRW',
                    'party' => 'auf Vorschlag der SPD'
                ],
                [
                    'name' => 'Martin Erkelenz',
                    'photo' => 'https://randomuser.me/api/portraits/men/71.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'CDU'
                ],
                [
                    'name' => 'Alexandra Gräfin von Wengersky',
                    'photo' => 'https://randomuser.me/api/portraits/men/72.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'CDU'
                ],
                [
                    'name' => 'Martina Kanis',
                    'photo' => 'https://randomuser.me/api/portraits/women/9.jpg',
                    'role' => '',
                    'party' => 'auf Vorschlag der CDU-Fraktion'
                ],
                [
                    'name' => 'Stephan Pohl',
                    'photo' => 'https://randomuser.me/api/portraits/men/76.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'CDU'
                ],
                [
                    'name' => 'Frank Hauser',
                    'photo' => 'https://randomuser.me/api/portraits/men/79.jpg',
                    'role' => '',
                    'party' => 'GRÜNE'
                ],
                [
                    'name' => 'Prof. Dr. Birgitt Killersreiter',
                    'photo' => 'https://randomuser.me/api/portraits/women/12.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'GRÜNE'
                ],
            ],
            'meetings' => [
                [
                    'title' => 'Sitzungs Nr. 6',
                    'date' => '03.12.2019',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 5',
                    'date' => '29.10.2019',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 4',
                    'date' => '03.09.2019',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 3',
                    'date' => '02.07.2019',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 2',
                    'date' => '14.05.2019',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 1',
                    'date' => '14.05.2019',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 8',
                    'date' => '27.11.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 7',
                    'date' => '30.10.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 6',
                    'date' => '13.09.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 5',
                    'date' => '12.06.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 4',
                    'date' => '08.05.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 3',
                    'date' => '10.04.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 2',
                    'date' => '13.03.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 1',
                    'date' => '16.01.2018',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
            ]
        ]);
    }

    public function list()
    {
        return view('committees')->with([
            'committees' => [
                [
                    'title' => 'Ausschuss Allgemeine Verwaltung und Rechtsfragen / Vergabe / Internationales',
                    'memberCount' => 29,
                    'nextMeetingDate' => Carbon::createFromFormat('Y-m-d', '2019-09-23')
                ],
                    [
                    'title' => 'Ausschuss Anregungen und Besch
                    erden', 'memberCount' => rand(
                        7, 49), 'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Ausschuss Kunst und Kultur',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Ausschuss Schule und Weiterbildung',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Ausschuss Soziales und Senioren',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Ausschuss für Umwelt und Grün',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Bauausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Finanzausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Gesundheitsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Hauptausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Jugendhilfeausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Liegenschaftsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Rechnungsprüfungsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Sportausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Stadtentwicklungsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Verkehrsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Wahlausschüsse',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Wahlprüfungsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
                [
                    'title' => 'Wirtschaftsausschuss',
                    'memberCount' => rand(17, 49),
                    'nextMeetingDate' => Carbon::now()->addDay(rand(64, 111))
                ],
            ]
        ]);
    }
}
