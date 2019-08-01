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

        $paperQuery = \App\Paper::with(['location']);

        if ($postalCode) {
            $paperQuery->whereHas('location', function (Builder $query) use ($postalCode){
                $query->where('postal_code', '=', $postalCode);
            });
        }

        if ($district) {
            $paperQuery->whereHas('location', function (Builder $query) use ($district){
                $query->where('sub_locality', '=', $district);
            });
        }
        return Topic::collection($paperQuery->paginate(100));
    }

    public function index(Request $request, Paper $paper)
    {
        return new Topic($paper);
    }

    public function themen(Request $request)
    {
        $paperQuery = \App\Paper::with(['location']);

        $topics = Topic::collection($paperQuery->paginate(100))->toResponse(request())->getData();

        return view('themes')->with([
            'topics' => $topics->data,
            'links' => $topics->links,
        ]);
    }
}
