<?php

namespace App\Http\Controllers;

use App\Http\Resources\Search;
use App\Http\Resources\TopicWithData;
use App\Location;
use App\Meeting;
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
        $meetingsQuery = Meeting::with(['location', 'agenda', 'files', 'organizations', 'organizations.people'])
            ->whereNotNull('start')
            ->orderBy('start', 'DESC');

        $meetings = \App\Http\Resources\Meeting::collection($meetingsQuery->take(3)->get())->toResponse(request())->getData();

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

        $people = Person::where('name', 'like', "%$searchTerm%")->orderBy('family_name', 'asc')->paginate(15)
            ->setPath(url('/api/people-list?q=' . $searchTerm));

        $locations = Location::where('description', 'like', "%$searchTerm%")->paginate(15)
            ->setPath(url('api/locations?q=' . $searchTerm));

        $topics = Paper::where('name', 'like', "%$searchTerm%")->sort()->paginate(15)
            ->setPath(url('api/topics?q=' . $searchTerm));

        return new Search($people, $locations, $topics);
    }

    public function getLocations(Request $request)
    {
        $locationQuery = Location::all();

        if($search = $request->input('q')){
            $locationQuery = Location::where('description', 'like', "%$search%");
        }

        $locationData = \App\Http\Resources\Location::collection($locationQuery->paginate(15))
            ->toResponse(request())->getData();

        return [
            'locations' => $locationData->data,
            'links' => $locationData->links,
            'meta' => $locationData->meta,
        ];
    }
}
