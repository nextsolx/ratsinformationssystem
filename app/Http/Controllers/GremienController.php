<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class GremienController extends Controller
{

    public function view(Request $request, Organization $organization)
    {
        $organization->load(['people', 'meetings']);
        $organizationData = (new \App\Http\Resources\Organization($organization))->toResponse(request())->getData()->data;

        return view('committee')->with(
            array_merge((array) $organizationData, [
                'breadcrumbs' => [
                    'Gremien' => route('committee-list'),
                    $organization->name => route('committee', $organization->id),
                ]])
        );
    }

    public function list()
    {
        $committees = \App\Http\Resources\Organization::collection(Organization::all())
            ->toResponse(request())->getData();

        return view('committee-list')->with([
            'committees' => $committees->data,
            'breadcrumbs' => [
                'Gremien' => route('committee-list'),
            ]
        ]);
    }
}
