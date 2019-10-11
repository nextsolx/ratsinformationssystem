<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetDistrictsRequest;
use Illuminate\Support\Arr;

class DistrictController extends Controller
{
    public function all(GetDistrictsRequest $request)
    {
        $district = $request->input('district');
        $subDistrict = $request->input('subDistrict');

        if($district && $subDistrict){
            return json_encode(Arr::get(Arr::get(config('districts'), $district), $subDistrict));
        }

        if($district) {
            return json_encode(Arr::get(config('districts'), $district));
        }

        return json_encode(collect(config('districts'))->keys()->toArray());
    }

}
