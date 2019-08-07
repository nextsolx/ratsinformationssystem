<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

class GremienController extends Controller
{
    public function list()
    {
        return view('committee')->with([
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
