<?php

namespace App\Http\Controllers;


use App\Http\Resources\Meeting;
use App\Http\Resources\MeetingWithData;
use App\OParl\OParlApiManager;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class MeetingController extends Controller
{
    public function all(Request $request)
    {
        $from = $request->input('from');
        $from = $from ? Carbon::parse($from) : null;

        list($meetings, $pages) = OParlApiManager::meetings($request->input('page'), $from);

        $meetings = new LengthAwarePaginator(
            $meetings,
            $pages['totalElements'],
            $pages['elementsPerPage'],
            $pages['currentPage']
        );

        return Meeting::collection($meetings);
    }

    public function index($id)
    {
        $meeting = OParlApiManager::meeting($id);

        return new MeetingWithData($meeting);
    }
}
