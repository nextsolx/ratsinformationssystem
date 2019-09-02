<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DistrictController extends Controller
{
    public function all()
    {
        return json_encode(collect(config('districts'))->keys()->toArray());
    }

    public function district(Request $request)
    {
        $district = $request->district;

        return json_encode(Arr::get(config('districts'), $district));
    }

    public function subDistrict(Request $request)
    {
        $district = $request->district;
        $subDistrict = $request->subdistrict;
        
        return json_encode(Arr::get(Arr::get(config('districts'), $district), $subDistrict));
    }
}
