<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;
use App\Http\Requests\PeopleListRequest;

class PersonenController extends CachedController
{
    public function view(PeopleListRequest $request)
    {
        $peopleQuery = Person::with('organizations');

        $sort = $request->input('sort', 'family_name');
        $order = $request->input('order', 'ASC');

        $peopleQuery->orderBy($sort, $order);

        if ($letter = $request->input('letter')) {
            $peopleQuery->where('family_name', 'like', "$letter%");
        }

        if ($search = $request->input('search')) {
            $peopleQuery->where('name', 'like', "%$search%")
                ->orWhere('family_name', 'like', "%$search%")
                ->orWhere('given_name', 'like', "%$search%")
                ->orWhere('party', 'like', "%$search%");
        }

        $peopleData = \App\Http\Resources\Person::collection($peopleQuery->paginate(15))
            ->toResponse(request())->getData();

        return view('people-list')->with([
            'members' => $peopleData->data,
            'links' => $peopleData->links,
            'breadcrumbs' => [
                'Personen' => route('people-list'),
            ]
        ]);
    }

    public function getPeople(PeopleListRequest $request)
    {
        $peopleQuery = Person::with('organizations');

        $sort = $request->input('sort', 'family_name');
        $order = $request->input('order', 'ASC');

        $peopleQuery->orderBy($sort, $order)->whereNotNull('family_name');

        if ($letter = $request->input('letter')) {
            $peopleQuery->where('family_name', 'like', "$letter%");
        }

        if ($search = $request->input('search')) {
            $peopleQuery->where('name', 'like', "%$search%")
                ->orWhere('family_name', 'like', "%$search%")
                ->orWhere('given_name', 'like', "%$search%")
                ->orWhere('party', 'like', "%$search%");
        }

        if ($search = $request->input('q')) {
            $peopleQuery->where('name', 'like', "%$search%");
        }

        $peopleData = \App\Http\Resources\Person::collection($peopleQuery->paginate(15))
            ->toResponse(request())->getData();

        return [
            'members' => $peopleData->data,
            'links' => $peopleData->links,
            'meta' => $peopleData->meta,
            'breadcrumbs' => [
                'Personen' => route('theme-overview'),
            ]
        ];
    }

    public function personDetail(Request $request, Person $person)
    {
        $person->load('organizations','papers');

        $personData = (new \App\Http\Resources\Person($person))->toResponse(request())->getData();

        return view('people')->with([
            'person' => $personData->data,
            'breadcrumbs' => [
                'Personen' => route('people-list'),
                $person->name => route('person', $person->id),
            ]
        ]);
    }
}
