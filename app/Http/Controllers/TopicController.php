<?php

namespace App\Http\Controllers;

use App\Http\Resources\Topic;
use App\OParl\OParlApiManager;
use App\Paper;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TopicController extends Controller
{
    public function all(Request $request)
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

    public function index(Request $request, Paper $paper)
    {
        return new Topic($paper);
    }
}
