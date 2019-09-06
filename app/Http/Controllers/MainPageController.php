<?php

namespace App\Http\Controllers;

use App\Http\Resources\Meeting;
use App\Http\Resources\TopicWithData;
use App\Paper;
use App\Person;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function welcome(Request $request)
    {
        $meetingsQuery = \App\Meeting::with(['location', 'agenda', 'files', 'organizations', 'organizations.people'])
            ->whereNotNull('start')
            ->orderBy('start', 'DESC');

        $meetings = Meeting::collection($meetingsQuery->take(3)->get())->toResponse(request())->getData();

        $topics = TopicWithData::collection(
            Paper::with(Paper::$basicScope)->sort()->new()->paginate(3)
        )->toResponse(request())->getData();

        $peopleQuery = Person::inRandomOrder();

        $people = \App\Http\Resources\Person::collection($peopleQuery->paginate(5))->toResponse(request())->getData();

        return view('welcome')->with([
            'meetings' => $meetings->data,
            'topics' => $topics->data,
            'people' => $people->data
        ]);
    }
}
