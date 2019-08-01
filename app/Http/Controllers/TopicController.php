<?php

namespace App\Http\Controllers;

use App\Http\Resources\Topic;
use App\Paper;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function all(Request $request)
    {
        $paperQuery = \App\Paper::with(['location']);

        return Topic::collection($paperQuery->paginate(100));
    }

    public function index(Request $request, Paper $paper)
    {
        return new Topic($paper);
    }
}
