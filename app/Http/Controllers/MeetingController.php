<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetMeetingsRequest;
use App\Http\Resources\Meeting;
use App\Http\Resources\MeetingWithData;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MeetingController extends Controller
{
    public function calendar(Request $request)
    {
        $from = $request->input('from');

        $meetingsQuery = \App\Meeting::with(\App\Meeting::$basicScope)
            ->whereNotNull('start')
            ->orderBy('start', 'DESC');

        if ($from = $from ? Carbon::parse($from) : null) {
            $meetingsQuery->where('start' , '>=', $from);
        }

        $meetings = Meeting::collection($meetingsQuery->paginate(100))->toResponse(request())->getData();

        return view('meeting-list')->with([
            'meetings' => $meetings->data,
            'links' => $meetings->links,
            'breadcrumbs' => [
                'Kalendar' => route('meeting-list'),
            ]
        ]);
    }

    public function all(GetMeetingsRequest $request)
    {
        $from = $request->input('from');
        $year = $request->input('year');
        $month = $request->input('month');

        $meetingsQuery = \App\Meeting::with(\App\Meeting::$basicScope)
            ->whereNotNull('start')
            ->orderBy('start', 'DESC');


        if ($from = $from ? Carbon::parse($from) : null) {
            $meetingsQuery = $meetingsQuery->where('start' , '>=', $from);
        }

        if ($year) {
            $date = Carbon::parse()->year($year)->month($month);


            $meetingsQuery = $meetingsQuery
                ->whereBetween('start' , [
                    $date->startOfMonth()->subWeek()->clone(),
                    $date->endOfMonth()->addWeeks(2)->clone()
                ]);
        }

        return Meeting::collection($meetingsQuery->paginate(100));
    }

    public function index($id)
    {
        return new MeetingWithData(\App\Meeting::findOrFail($id));
    }

    public function getMeeting(Request $request, $id)
    {
        $meeting = new MeetingWithData(\App\Meeting::with(\App\Meeting::$basicScope)->findOrFail($id));

        return view('meeting')->with([
            'meeting' => (array) $meeting->toResponse($request)->getData()->data,
            'breadcrumbs' => [
                'Kalendar' => route('meeting-list'),
                'Sitzung' => 'sitzung',
                $meeting->name => route('meeting', $meeting->id),
            ]
        ]);
    }
}
