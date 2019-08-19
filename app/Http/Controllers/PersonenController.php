<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonenController extends Controller
{
    public function view()
    {
        $people = Person::with('organizations')->get();

        $peopleData = \App\Http\Resources\Person::collection($people)->toResponse(request())->getData();

        return view('people-list')->with([
            'members' => $peopleData->data,
            'breadcrumbs' => [
                'Personen' => route('people-list'),
            ]
        ]);
    }

    public function personDetail(Request $request, Person $person)
    {
        $person->load('organizations');

        $personData = (new \App\Http\Resources\Person($person))->toResponse(request())->getData();

        return view('people')->with([
            'person' => $personData->data,
            'breadcrumbs' => [
                'Personen' => route('people-list'),
                $person->name => route('people', $person->id),
            ]
        ]);
    }
}
