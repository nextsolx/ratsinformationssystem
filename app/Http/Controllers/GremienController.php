<?php

namespace App\Http\Controllers;

use App\Organization;

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
                    'party' => 'GRÜNE',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Frank Schneider',
                    'photo' => 'https://randomuser.me/api/portraits/men/27.jpg',
                    'role' => '1. Stellvertretender Ausschussvorsitzender',
                    'party' => 'SPD',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Hamide Akbayir',
                    'photo' => 'https://randomuser.me/api/portraits/men/25.jpg',
                    'role' => '2. Stellvertretende Ausschussvorsitzende',
                    'party' => 'DIE LINKE',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Polina Frebel',
                    'photo' => 'https://randomuser.me/api/portraits/women/4.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'SPD',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Erika Oedingen',
                    'photo' => 'https://randomuser.me/api/portraits/women/5.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'SPD',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Dagmar Paffen',
                    'photo' => 'https://randomuser.me/api/portraits/women/6.jpg',
                    'role' => 'Sachkundige Bürgerin nach § 58 Absatz 3 GO NRW',
                    'party' => 'auf Vorschlag der SPD',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Martin Erkelenz',
                    'photo' => 'https://randomuser.me/api/portraits/men/71.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'CDU',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Alexandra Gräfin von Wengersky',
                    'photo' => 'https://randomuser.me/api/portraits/men/72.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'CDU',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Martina Kanis',
                    'photo' => 'https://randomuser.me/api/portraits/women/9.jpg',
                    'role' => '',
                    'party' => 'auf Vorschlag der CDU-Fraktion',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Stephan Pohl',
                    'photo' => 'https://randomuser.me/api/portraits/men/76.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'CDU',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Frank Hauser',
                    'photo' => 'https://randomuser.me/api/portraits/men/79.jpg',
                    'role' => '',
                    'party' => 'GRÜNE',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Prof. Dr. Birgitt Killersreiter',
                    'photo' => 'https://randomuser.me/api/portraits/women/12.jpg',
                    'role' => 'Ratsmitglied',
                    'party' => 'GRÜNE',
                    'function' => 'Stimmberechtigte Mitgleider'
                ],
                [
                    'name' => 'Liane Bchir',
                    'photo' => 'https://randomuser.me/api/portraits/women/16.jpg',
                    'role' => 'Mitglieder mit beratender Stimme nach § 58 Abs 1 Satz 7 - 9 GO NRW',
                    'party' => 'AFD',
                    'function' => 'Beratende Mitglieder'
                ],
                [
                    'name' => 'Judith Wolter',
                    'photo' => 'https://randomuser.me/api/portraits/women/20.jpg',
                    'role' => 'Mitglieder mit beratender Stimme nach § 58 Abs. 1 Satz 11 GO NRW',
                    'party' => '',
                    'function' => 'Beratende Mitglieder'
                ],
                [
                    'name' => 'Heiko Nigmann',
                    'photo' => 'https://randomuser.me/api/portraits/man/20.jpg',
                    'role' => 'Sachkundige Einwohnerinnen und Einwohner nach § 22, 23, 23a, 23b Hauptsatzung der Stadt Köln',
                    'party' => 'Seniorenvertretung der Stadt Köln',
                    'function' => 'Beratende Mitglieder'
                ],
                [
                    'name' => 'Jürgen Schuiszill',
                    'photo' => 'https://randomuser.me/api/portraits/man/44.jpg',
                    'role' => 'Mitglieder mit beratender Stimme nach § 58 Abs. 1 Satz 11 GO NRW',
                    'party' => 'CDU',
                    'function' => 'Beratende Mitglieder'
                ],
                [
                    'name' => 'Hedwig Drießen',
                    'photo' => 'https://randomuser.me/api/portraits/man/81.jpg',
                    'role' => 'Mitglieder mit beratender Stimme nach § 58 Abs. 1 Satz 11 GO NRW',
                    'party' => 'Seniorenvertretung der Stadt Köln',
                    'function' => 'Stellvertretende beratende Mitglieder'
                ],
                [
                    'name' => 'Eugen Litvinov',
                    'photo' => 'https://randomuser.me/api/portraits/man/32.jpg',
                    'role' => 'Sachkundige Einwohnerinnen und Einwohner nach § 22, 23, 23a, 23b Hauptsatzung der Stadt Köln',
                    'party' => 'Integrationsrat',
                    'function' => 'Stellvertretende beratende Mitglieder'
                ],
                [
                    'name' => 'Jürgen Abcde',
                    'photo' => 'https://randomuser.me/api/portraits/man/51.jpg',
                    'role' => 'Mitglieder mit beratender Stimme nach § 58 Abs. 1 Satz 11 GO NRW',
                    'party' => '',
                    'function' => 'Stellvertretende beratende Mitglieder'
                ],
            ],
            'meetings' => [
                [
                    'title' => 'Sitzungs Nr. 6',
                    'date' => '2019-12-03 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 5',
                    'date' => '2019-10-29 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 4',
                    'date' => '2019-09-03 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 3',
                    'date' => '2017-07-02 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 3',
                    'date' => '2017-05-02 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 2',
                    'date' => '2019-05-14 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 1',
                    'date' => '2019-05-14 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 8',
                    'date' => '2018-11-27 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 7',
                    'date' => '2019-08-16 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 6',
                    'date' => '2019-09-13 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 5',
                    'date' => '2019-06-12 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 4',
                    'date' => '2018-05-08 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 3',
                    'date' => '2019-04-10 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => '',
                    'isCancelled' => false,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 2',
                    'date' => '2019-03-13 18:00:00',
                    'topCount' => rand(4, 16),
                    'attendeesCount' => rand(17, 33),
                    'decisionTemplate' => 'BA/0028/2018',
                    'isCancelled' => true,
                    'location' => 'Rathaus Spanischer Bau, Theodor-Heuss-Saal, Raum-Nr. A 119'
                ],
                [
                    'title' => 'Sitzungs Nr. 1',
                    'date' => '2018-01-16 18:00:00',
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
        $committees = \App\Http\Resources\Organization::collection(Organization::all())
            ->toResponse(request())->getData();

        return view('committee-list')->with([
            'committees' => $committees->data,
        ]);
    }
}
