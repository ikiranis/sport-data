<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::patch('match', 'AdminMatchesController@updateScore');
Route::get('championships/{sport_id}', 'AdminChampionshipsController@getChampionships');
Route::get('seasons/{championship_id}', 'AdminSeasonsController@getSeasons');
