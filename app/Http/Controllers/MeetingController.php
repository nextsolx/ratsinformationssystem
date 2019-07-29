<?php

namespace App\Http\Controllers;

use App\Http\Resources\Meeting;
use App\Http\Resources\MeetingWithData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MeetingController extends Controller
{
    public function calendar(Request $request)
    {
        $from = $request->input('from');

        $meetingsQuery = \App\Meeting::with(['location', 'agenda', 'files', 'organizations', 'organizations.people'])
            ->whereNotNull('start')
            ->orderBy('start', 'DESC');

        if ($from = $from ? Carbon::parse($from) : null) {
            $meetingsQuery->where('start' , '>=', $from);
        }

        $meetings = Meeting::collection($meetingsQuery->paginate(100))->toResponse(request())->getData();

        return view('calendar')->with([
            'meetings' => $meetings->data,
            'links' => $meetings->links,
        ]);
    }

    public function all(Request $request)
    {
        $from = $request->input('from');

        $meetingsQuery = \App\Meeting::with(['location', 'agenda', 'files', 'organizations', 'organizations.people'])
            ->whereNotNull('start')
            ->orderBy('start', 'DESC');


        if ($from = $from ? Carbon::parse($from) : null) {
            $meetingsQuery->where('start' , '>=', $from);
        }

        return Meeting::collection($meetingsQuery->paginate(100));
    }

    public function index($id)
    {
        return new MeetingWithData(\App\Meeting::findOrFail($id));
    }
}
