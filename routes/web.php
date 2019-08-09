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

Route::get('/', 'MainPageController@welcome')->name('welcome');

Route::get('/styleguide', function () {
    return view('styleguide');
});

Route::get('/kalender', 'MeetingController@calendar')
    ->name('calendar-list');

Route::get('/themen-overview', 'TopicController@themen')
    ->name('theme-overview');

Route::get('/neue-themen', 'TopicController@newThemes')
    ->name('new-themes');

Route::get('/aktualisiert-themen', 'TopicController@progressThemes')
    ->name('progress-themes');

Route::get('/abgeschlossen-themen', 'TopicController@finishedThemes')
    ->name('finished-themes');

Route::get('/thema/{paper}', 'TopicController@topic')
    ->name('theme-detail');

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
Route::get('/api/topics', 'TopicController@all');
Route::get('/api/topic/{paper}', 'TopicController@index');
Route::get('/api/districts',function () {
    return response(json_encode([
        'data' => [
            'districts' => [
                'Innenstadt', 'Rodenkirchen', 'Lindenthal', 'Ehrenfeld',
                'Nippes',  'Chorweiler', 'Porz',  'Kalk',  'Mülheim'
            ]
        ]
    ]));
});
