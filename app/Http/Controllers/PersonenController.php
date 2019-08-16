<?php

namespace App\Http\Controllers;

use App\Person;

class PersonenController extends Controller
{
    public function view()
    {
        $people = Person::with('organizations')->get();

        $peopleData = \App\Http\Resources\Person::collection($people)->toResponse(request())->getData();

        return view('people-list')->with([
            'members' => $peopleData->data,
            'breadcrumbs' => [
                'Personen' => route('theme-overview'),
            ]
        ]);
    }
}
