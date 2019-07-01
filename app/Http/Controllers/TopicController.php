<?php

namespace App\Http\Controllers;

use App\Http\Resources\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = $this->data();

        return Topic::collection($topics);
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
