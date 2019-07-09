<?php

namespace App\Http\Controllers;


use App\Http\Resources\Meeting;
use App\OParl\OParlApiManager;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        list($meetings, $pages) = OParlApiManager::meetings($request->input('page'));

        $meetings = new LengthAwarePaginator(
            $meetings,
            $pages['totalElements'],
            $pages['elementsPerPage'],
            $pages['currentPage']
        );

        return Meeting::collection($meetings);
    }
}
