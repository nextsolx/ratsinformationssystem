<?php

namespace App\Http\Controllers;

use App\Http\Resources\Topic;
use App\OParl\OParlApiManager;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        list($topics, $pages) = OParlApiManager::topics($request->input('page'));

        $topics = new LengthAwarePaginator(
            $topics,
            $pages['totalElements'],
            $pages['elementsPerPage'],
            $pages['currentPage']
        );

        return Topic::collection($topics);
    }

    public function all(Request $request)
    {
        list($topics, $pages) = OParlApiManager::topics($request->input('page'));

        $topics = new LengthAwarePaginator(
            $topics,
            $pages['totalElements'],
            $pages['elementsPerPage'],
            $pages['currentPage']
        );

        return view('themes')->with([
            'topics' => Topic::collection($topics)->toResponse(request())->getData()->data,
            'links' => $topics->toArray(),
        ]);
    }
}
