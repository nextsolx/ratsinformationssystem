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
})->name('welcome');

Route::get('/styleguide', function () {
    return view('styleguide');
});

Route::get('/kalender', 'MeetingController@calendar')
    ->name('calendar');

Route::get('/themen', function () {
    return view('themes');
})->name('themes');

Route::get('/karte', function () {
    return view('map');
})->name('map');

Route::get('/gremien', function () {
    return view('committee');
})->name('committee');

Route::get('/personen', function () {
    return view('people');
})->name('people');

Route::get('/merkliste', function () {
    return view('bookmarks');
})->name('bookmarks');

Route::get('/datenschutz', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/impressum', function () {
    return view('company');
})->name('company');


Route::get('/api/meetings', 'MeetingController@all');
Route::get('/api/meeting/{id}', 'MeetingController@index');
Route::get('/api/topics', 'TopicController@index');
