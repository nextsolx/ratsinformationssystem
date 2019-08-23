<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleListRequest;
use App\Person;
use Illuminate\Http\Request;

class PersonenController extends Controller
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

        $peopleData = \App\Http\Resources\Person::collection($peopleQuery->paginate(100))
            ->toResponse(request())->getData();

        dd($peopleData->data);
        return view('people-list')->with([
            'members' => $peopleData->data,
            'links' => $peopleData->links,
            'breadcrumbs' => [
                'Personen' => route('theme-overview'),
            ]
        ]);
    }
}
