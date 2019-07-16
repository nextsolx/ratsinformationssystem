<?php

namespace App\Http\Controllers;


use App\Http\Resources\Meeting;
use App\OParl\OParlApiManager;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class MeetingController extends Controller
{
    public function calendar(Request $request)
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

        return view('calendar')->with([
            'meetings' => Meeting::collection($meetings)->toResponse(request())->getData()->data,
            'links' => $meetings->toArray(),
        ]);

    }

    public function index(Request $request)
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
}
