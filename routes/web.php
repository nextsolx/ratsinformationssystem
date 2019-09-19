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

Route::group(['middleware' => 'under-construction'], function () {
    Route::get('/', 'MainPageController@welcome')->name('welcome');

    Route::get('/styleguide', function () {
        return view('styleguide');
    });

    Route::get('/kalender', 'MeetingController@calendar')
        ->name('calendar-list');

    Route::get('/meeting/{id}', 'MeetingController@getMeeting')
        ->name('meeting');

    Route::get('/themen-overview', 'TopicController@themen')
        ->name('theme-overview');

    Route::get('/neue-themen', 'TopicController@newThemes')
        ->name('new-themes');

    Route::get('/aktualisiert-themen', 'TopicController@progressThemes')
        ->name('progress-themes');

    Route::get('/abgeschlossen-themen', 'TopicController@finishedThemes')
        ->name('finished-themes');

    Route::get('/thema/{paper}', 'TopicController@topic')
        ->name('theme');

    Route::get('/karte', 'MapController@view')->name('map');

    Route::get('/gremien-liste', 'GremienController@list')->name('committee-list');

    Route::get('/gremien/{organization}', 'GremienController@view')->name('committee');

    Route::get('/personen/{person}', 'PersonenController@personDetail')->name('person');

    Route::get('/personen-liste', 'PersonenController@view')->name('people-list');

    Route::get('/merkliste', function () {
        return view('bookmarks');
    })->name('bookmarks');

    Route::get('/datenschutz', function () {
        return view('privacy-policy');
    })->name('privacy-policy');

    Route::get('/impressum', function () {
        return view('company');
    })->name('company');


    Route::get('/api/people-list', 'PersonenController@getPeople');
    Route::get('/api/meetings', 'MeetingController@all');
    Route::get('/api/meeting/{id}', 'MeetingController@index');
    Route::get('/api/topics', 'TopicController@all');
    Route::get('/api/topics/new', 'TopicController@new');
    Route::get('/api/topics/progress', 'TopicController@progress');
    Route::get('/api/topic/{paper}', 'TopicController@index');
    Route::get('/api/districts', 'DistrictController@all');
    Route::get('/api/districts/{district}', 'DistrictController@district');
    Route::get('/api/districts/{district}/{subdistrict}', 'DistrictController@subDistrict');
});
