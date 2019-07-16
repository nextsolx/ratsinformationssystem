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
        list($meetings, $pages) = OParlApiManager::topics($request->input('page'));

        $meetings = new LengthAwarePaginator(
            $meetings,
            $pages['totalElements'],
            $pages['elementsPerPage'],
            $pages['currentPage']
        );

        return Topic::collection($meetings);
    }

    private function data()
    {
        return collect([
            (object) [
                'title' => 'Bewohnerparken Köln-Lindenthal',
            ], (object) [
                'title' => 'Mitführen von Hunden auf den städtischen Friedhöfen',
            ], (object) [
                'title' => 'Generalsanierung Drehbrücke Deutzer Hafen',
            ],
        ]);
    }
}
