<?php

namespace App\Http\Controllers;

use App\Organization;

class PersonenController extends Controller
{

    public function view()
    {
        return view('people-list')->with([
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
        ]);
    }
}
