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
                ]
            ]
        ]);
    }
}
