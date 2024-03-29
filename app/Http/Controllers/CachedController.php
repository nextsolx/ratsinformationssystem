<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class CachedController extends Controller
{
    public function __construct()
    {
        $this->middleware('cacheResponse');
    }
}
