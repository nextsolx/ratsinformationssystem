<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Person extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }

        $org = $this->organizations->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'party' => $this->party,
            'life' => $this->life,
            'lifeSource' => $this->life_source,
            'role' => $org ? $org->pivot->role : null,
            'function' => $org ? $org->pivot->role : null,
            'photo' => 'https://cdn.pixabay.com/photo/2016/08/08/09/17/avatar-1577909_1280.png',
            'email' => 'dielinke.koeln@stadt-koeln', // @todo - fix mock data
            'phone' => '0221-221 27840', // @todo - fix mock data
            'fax' => '0221-221 27840', // @todo - fix mock data
            'location' => 'Bezirksrathaus Rodenkirchen, Hauptstr. 85, 50996 Köln', // @todo - fix mock data
            'committeeList' => // @todo - fix mock data
                [
                'currentParty' =>
                    [
                        [
                            'name' => 'Ausschuss für Anregungen und Beschwerden',
                            'role' => '2. Stellvertretende Ausschussvorsitzende',
                            'party' => 'CDU',
                            'start_date' => '2018-08-20T12:00:00+01:00',
                            'end_date' => null,
                        ],
                        [
                            'name' => 'Rat',
                            'role' => 'Ratsmitglied',
                            'party' => 'CDU',
                            'start_date' => '2017-08-20T12:00:00+01:00',
                            'end_date' => '2018-08-20T12:00:00+01:00',
                        ],
                    ],
                'previousParty' =>
                    [
                        [
                            'name' => 'Ausschuss für Umwelt und Grün',
                            'role' => 'Ratsmitglied',
                            'party' => 'DIE GRÜNEN',
                            'start_date' => '2016-10-20T12:00:00+01:00',
                            'end_date' => '2017-08-20T12:00:00+01:00',
                        ],
                        [
                            'name' => 'Betriebsausschuss Abfallwirtschaftsbetrieb der Stadt Köln',
                            'role' => 'Ratsmitglied',
                            'party' => 'DIE GRÜNEN',
                            'start_date' => '2014-10-20T12:00:00+01:00',
                            'end_date' => '2016-08-20T12:00:00+01:00',
                        ],
                        [
                            'name' => 'Bezirksvertretung Nippes',
                            'role' => 'Beratendes Mitglied',
                            'party' => 'DIE GRÜNEN',
                            'start_date' => '2010-10-20T12:00:00+01:00',
                            'end_date' => '2014-08-20T12:00:00+01:00',
                        ],
                    ],
                ],
            'files' => // @todo - fix mock data
                [
                [
                    'name' => 'Erklärung nach dem Korruptionsbekämpfungsgesetz',
                    'downloadUrl' => 'http://lorem.link',
                ],
                [
                    'name' => 'Erklärung nach',
                    'downloadUrl' => 'http://lorem.link',
                ],
            ]
        ];
    }
}
