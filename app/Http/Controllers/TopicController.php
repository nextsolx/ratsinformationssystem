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
        $search = $request->input('q');

        $paperQuery = Paper::with(Paper::$basicScope)->sort();

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

        if ($search) {
            $paperQuery->where('name', 'like', "%$search%");
        }

        return Topic::collection($paperQuery->paginate(15));
    }

    // @todo --- progress() --- need to check and refactor
    /**
     * Get the in progress theme list
     * Using for sorting by progress, via API
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function progress(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = Paper::with(Paper::$basicScope);

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

        return TopicWithData::collection($paperQuery->sort()->updated()->paginate(100));
    }

    // @todo --- new() --- need to check and refactor
    /**
     * Get the new theme list
     * Using for sorting by date, via API
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function new(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');

        $paperQuery = Paper::with(Paper::$basicScope);

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

        return TopicWithData::collection($paperQuery->sort()->new()->paginate(100));
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

    public function themenOverview(Request $request)
    {
        $postalCode = $request->input('postalCode');
        $district = $request->input('district');
        $topicTitle = '';

        $paperQuery = Paper::with(Paper::$basicScope);

        if ($postalCode) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($postalCode) {
                $query->where('postal_code', '=', $postalCode);
            });
            $topicTitle = $postalCode;
        }

        if ($district) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($district) {
                $query->where('sub_locality', '=', $district);
            });
            $topicTitle = $district;
        }

        $topics = TopicWithData::collection(
           Paper::with(Paper::$basicScope)->sort()->paginate(10)
        )->toResponse(request())->getData();

        $new = TopicWithData::collection(
            Paper::with(Paper::$basicScope)->sort()->new()->paginate(3)
        )->toResponse(request())->getData();

        $finished = TopicWithData::collection(
            Paper::with(Paper::$basicScope)->sort()->finished()->paginate(3)
        )->toResponse(request())->getData();

        $progress = TopicWithData::collection(
            Paper::with(Paper::$basicScope)->sort()->updated()->paginate(3)
        )->toResponse(request())->getData();

        return view('theme-overview')->with([
            'topics_top' => $topics->data,
            'topics_new' => $new->data,
            'topics_progress' => $progress->data,
            'topics_finished' => $finished->data,
            'topic_title' => $topicTitle,
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

    public function themen(Request $request)
    {
        $postalCode = $request->input('postalCode');

        $district = $request->input('district');

        $section=$request->input('section');

        if($section === 'updated'){
            $paperQuery = Paper::with(Paper::$basicScope)->sort()->updated();
            $breadcrumbs = ['Aktualisierte Themen' => route('themes', 'section=updated')];
            $topicTitle = 'Kürzlich aktualisiert';
        } elseif ($section === 'finished'){
            $paperQuery = Paper::with(Paper::$basicScope)->sort()->finished();
            $breadcrumbs = ['Abgeschlossene Themen' => route('themes', 'section=finished')];
            $topicTitle = 'Kürzlich abgeschlossen';
        } else {
            // the 'new' topic type by default if section type not exist or pass by direct link
            $paperQuery = Paper::with(Paper::$basicScope)->sort()->new();
            $breadcrumbs = ['Neue Themen' => route('themes', 'section=new')];
            $topicTitle = 'Neue Themen';
        }

        if ($postalCode) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($postalCode) {
                $query->where('postal_code', '=', $postalCode);
            });
            $topicTitle .= ' für die ' . $postalCode;
        }

        if ($district) {
            $paperQuery->whereHas('locations', function (Builder $query) use ($district) {
                $query->where('sub_locality', '=', $district);
            });
            $topicTitle .= ' für die ' . $district;
        }

        $topics = TopicWithData::collection($paperQuery->paginate(15))->toResponse(request())->getData();

        return view('theme-list')->with([
            'theme_list' => $topics->data,
            'theme_type' => $section,
            'topic_title' => $topicTitle,
            'district_list' => [
                'Innenstadt', 'Rodenkirchen', 'Lindenthal', 'Ehrenfeld',
                'Nippes',  'Chorweiler', 'Porz',  'Kalk',  'Mülheim'
            ],
            'links' => $topics->links,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
