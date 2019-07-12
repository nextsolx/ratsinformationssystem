<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/styleguide', function () {
    return view('styleguide');
});

Route::get('/kalender', function () {
    return view('kalender');
});

Route::get('/api/meetings', 'MeetingController@all');
Route::get('/api/meeting/{id}', 'MeetingController@index');
Route::get('/api/topics', 'TopicController@index');

