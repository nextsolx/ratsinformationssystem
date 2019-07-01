<?php

namespace App\Http\Controllers;

use App\Http\Resources\Conference;
use Illuminate\Support\Carbon;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = $this->data();

        return Conference::collection($conferences);
    }

    private function data()
    {
        return collect([
            (object) [
                'title' => 'Naturschutzbeirat bei der Unteren Naturschutzbehörde',
                'location' => 'Stadthaus Deutz, Konferenzraum 16.F.43',
                'date' =>  Carbon::parse('2019-07-01 07:00:00')
            ], (object) [
                'title' => 'Bauausschuss',
                'location' => 'Historisches Rathaus, Konrad-Adenauer Saal, Raum-Nr. 1.18',
                'date' =>  Carbon::parse('2019-07-01 14:00:00')
            ], (object) [
                'title' => 'Betriebsausschuss Gebäudewirtschaft',
                'location' => 'Historisches Rathaus, Konrad-Adenauer Saal, Raum-Nr. 1.18',
                'date' =>  Carbon::parse('2019-07-01 05:00:00')
            ],
        ]);
    }
}
