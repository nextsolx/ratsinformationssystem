<?php

namespace App\Http\Controllers;

use App\Organization;

class GremienController extends Controller
{
    public function list()
    {
        $committees = \App\Http\Resources\Organization::collection(Organization::paginate(100))
            ->toResponse(request())->getData();

        return view('committee')->with([
            'committees' => $committees->data,
            'links' => $committees->links,
        ]);
    }
}
