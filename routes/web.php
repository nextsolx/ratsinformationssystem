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

Route::get('/kalender', function () {
    return view('calendar');
})->name('calendar');

Route::get('/themen-und-karte', function () {
    return view('themes-map');
})->name('themes-map');

Route::get('/gremien', function () {
    return view('committee');
})->name('committee');

Route::get('/merkliste', function () {
    return view('bookmarks');
})->name('bookmarks');

Route::get('/datenschutz', function () {
    return view('privacy-policy');
})->name('privacy-policy');

Route::get('/impressum', function () {
    return view('company');
})->name('company');


Route::get('/api/meetings', 'MeetingController@index');
Route::get('/api/topics', 'TopicController@index');
