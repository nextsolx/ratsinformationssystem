<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaperListRequest;
use App\Http\Resources\Topic;
use App\Http\Resources\TopicWithData;
use App\Paper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function all(PaperListRequest $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = \App\Paper::with(Paper::$basicScope);

        if($scope = $request->input('scope')){
            $paperQuery->{$scope}();
        }

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
        $topic = (new TopicWithData($paper))->toResponse(request())->getData()->data;

        return view('theme')->with([
            'topic' => $topic,
            'breadcrumbs' => [
                'Themen' => route('theme-overview'),
                $paper->name => route('theme', $paper->id),
            ]
        ]);
    }

    public function index(Request $request, Paper $paper)
    {
        return new TopicWithData($paper);
    }

    public function themen(Request $request)
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

        $topics = TopicWithData::collection(
            $paperQuery->sort()->paginate(100)
        )->toResponse(request())->getData();

        $new = TopicWithData::collection(
            $paperQuery->sort()->new()->paginate(3)
        )->toResponse(request())->getData();

        $finished = TopicWithData::collection(
            $paperQuery->sort()->finished()->paginate(3)
        )->toResponse(request())->getData();

        $prograss = TopicWithData::collection(
            $paperQuery->sort()->updated()->paginate(3)
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

        $topics = TopicWithData::collection($paperQuery->paginate(100))->toResponse(request())->getData();

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

        $topics = TopicWithData::collection($paperQuery->paginate(100))->toResponse(request())->getData();

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

        $topics = TopicWithData::collection($paperQuery->paginate(100))->toResponse(request())->getData();

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
