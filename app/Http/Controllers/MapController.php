<?php

namespace App\Http\Controllers;

use App\Paper;
use Illuminate\Http\Request;
use App\Http\Resources\TopicWithData;
use Illuminate\Database\Eloquent\Builder;

class MapController extends CachedController
{
    public function view(Request $request)
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

        return view('map')->with([
            'topics' => $topics->data,
            'district_list' => [
                'Chorweiler', 'Ehrenfeld', 'Innenstadt', 'Kalk',
                'Lindenthal', 'Mülheim', 'Nippes', 'Porz', 'Rodenkirchen'
            ],
            'links' => $topics->links,
            'breadcrumbs' => [
                'Karte' => route('map')
            ]
        ]);
    }

}
