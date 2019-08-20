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


Route::resource('clubs','ClubController');
Route::resource('users','UserController');
Route::resource('seasons','SeasonController');
Route::resource('players','PlayerController');
Route::resource('club.players','ClubPlayerController',['only'=>['index']]);
Route::resource('player.club','PlayerClubController',['only'=>['index']]);

Route::post('oauth/ token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken ');
