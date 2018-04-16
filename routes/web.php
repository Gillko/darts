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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('groups', 'GroupsController');
Route::resource('players', 'PlayersController');
Route::resource('games', 'GamesController');
Route::resource('scores', 'ScoreController');
/*Route::get('/groups', 'GroupsController@index')->name('groups');
Route::get('/groups/create', 'GroupsController@create')->name('groups.create');*/
