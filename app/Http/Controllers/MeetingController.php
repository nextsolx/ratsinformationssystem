<?php

namespace App\Http\Controllers;


use App\Http\Resources\Meeting;
use App\Http\Resources\MeetingWithData;
use App\OParl\OParlApiManager;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MeetingController extends Controller
{
    public function all(Request $request)
    {
        $from = $request->input('from');


        $meetingsQuery = \App\Meeting::whereNotNull('start')
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
