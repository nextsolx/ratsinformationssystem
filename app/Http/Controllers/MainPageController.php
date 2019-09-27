<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Resources\Search;
use App\Http\Resources\TopicWithData;
use App\Location;
use App\Meeting;
use App\Organization;
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

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');

        $people = Person::where('name', 'like', '%'.$searchTerm.'%')->get();

        $organizations = Organization::where('name', 'like', '%'.$searchTerm.'%')->get();

        $meetings = Meeting::where('name', 'like', '%'.$searchTerm.'%')->get();

        $files = File::where('name', 'like', '%'.$searchTerm.'%')->get();

        $locations = Location::where('description', 'like', '%'.$searchTerm.'%')->get();

        $topics = Paper::where('name', 'like', '%'.$searchTerm.'%')->get();

        return new Search($meetings, $people, $organizations, $files, $locations, $topics);
    }
}
