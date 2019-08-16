<?php

namespace App\Http\Controllers;

use App\Http\Resources\Topic;
use App\Paper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function all(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = \App\Paper::with(Paper::$basicScope)->sort();

        if ($postalCode) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($postalCode) {
                $query->where('postal_code', '=', $postalCode);
            });
        }

        if ($district) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($district) {
                $query->where('sub_locality', '=', $district);
            });
        }
        return Topic::collection($paperQuery->paginate(100));
    }

    public function topic(Request $request, Paper $paper)
    {
        $topic = (new Topic($paper))->toResponse(request())->getData()->data;

        return view('theme-detail')->with([
            'topic' => $topic,
            'breadcrumbs' => [
                'Themen' => route('theme-overview'),
                $paper->name => route('committee', $paper->id),
            ]
        ]);
    }

    public function index(Request $request, Paper $paper)
    {
        return new Topic($paper);
    }

    public function themen(Request $request)
    {
        $topics = Topic::collection(
            Paper::with(Paper::$basicScope)->sort()->paginate(100)
        )->toResponse(request())->getData();

        $new = Topic::collection(
            Paper::with(Paper::$basicScope)->sort()->new()->paginate(3)
        )->toResponse(request())->getData();

        $finished = Topic::collection(
            Paper::with(Paper::$basicScope)->sort()->finished()->paginate(3)
        )->toResponse(request())->getData();

        $prograss = Topic::collection(
            Paper::with(Paper::$basicScope)->sort()->updated()->paginate(3)
        )->toResponse(request())->getData();

        return view('theme-overview')->with([
            'topics' => $topics->data,
            'topics_new' => $new->data,
            'topics_progress' => $prograss->data,
            'topics_finished' => $finished->data,
            'district_list' => [
                'Innenstadt', 'Rodenkirchen', 'Lindenthal', 'Ehrenfeld',
                'Nippes',  'Chorweiler', 'Porz',  'Kalk',  'Mülheim'
            ],
            'links' => $topics->links,
            'breadcrumbs' => [
                'Themen' => route('theme-overview')
            ]
        ]);
    }

    public function newThemes(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = \App\Paper::with(Paper::$basicScope)->sort()->new();

        if ($postalCode) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($postalCode) {
                $query->where('postal_code', '=', $postalCode);
            });
        }

        if ($district) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($district) {
                $query->where('sub_locality', '=', $district);
            });
        }

        $topics = Topic::collection($paperQuery->paginate(100))->toResponse(request())->getData();

        return view('theme-list')->with([
            'theme_list' => $topics->data,
            'theme_type' => 'new',
            'district_list' => [
                'Innenstadt', 'Rodenkirchen', 'Lindenthal', 'Ehrenfeld',
                'Nippes',  'Chorweiler', 'Porz',  'Kalk',  'Mülheim'
            ],
            'links' => $topics->links,
            'breadcrumbs' => [
                'Neue Themen' => route('new-themes')
            ]
        ]);
    }

    public function progressThemes(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = \App\Paper::with(Paper::$basicScope)->sort()->updated();

        if ($postalCode) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($postalCode) {
                $query->where('postal_code', '=', $postalCode);
            });
        }

        if ($district) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($district) {
                $query->where('sub_locality', '=', $district);
            });
        }

        $topics = Topic::collection($paperQuery->paginate(100))->toResponse(request())->getData();

        return view('theme-list')->with([
            'theme_list' => $topics->data,
            'theme_type' => 'progress',
            'district_list' => [
                'Innenstadt', 'Rodenkirchen', 'Lindenthal', 'Ehrenfeld',
                'Nippes',  'Chorweiler', 'Porz',  'Kalk',  'Mülheim'
            ],
            'links' => $topics->links,
            'breadcrumbs' => [
                'Kürzlich aktualisiert' => route('progress-themes')
            ]
        ]);
    }

    public function finishedThemes(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = \App\Paper::with(Paper::$basicScope)->sort()->finished();

        if ($postalCode) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($postalCode) {
                $query->where('postal_code', '=', $postalCode);
            });
        }

        if ($district) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($district) {
                $query->where('sub_locality', '=', $district);
            });
        }

        $topics = Topic::collection($paperQuery->paginate(100))->toResponse(request())->getData();

        return view('theme-list')->with([
            'theme_list' => $topics->data,
            'theme_type' => 'finished',
            'district_list' => [
                'Innenstadt', 'Rodenkirchen', 'Lindenthal', 'Ehrenfeld',
                'Nippes',  'Chorweiler', 'Porz',  'Kalk',  'Mülheim'
            ],
            'links' => $topics->links,
            'breadcrumbs' => [
                'Kürzlich abgeschlossen' => route('finished-themes')
            ]
        ]);
    }
}
