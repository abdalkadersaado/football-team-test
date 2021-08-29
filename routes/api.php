<?php

use App\Http\Controllers\TeamsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// new route for football teams

//######## Routes Crud Games
Route::post('create','GamesController@create');
Route::get('getgames','GamesController@getgames');
Route::delete('deletegame/{postid}','GamesController@destroy');

//####### for binding team to game
Route::get('teams1','TeamsController@teams1');
Route::get('teams2','TeamsController@teams2');

//####### Routess Crud Team
Route::post('createteam','TeamsController@create');
Route::get('getteams','TeamsController@getteams');
Route::delete('deleteteam/{teamid}','TeamsController@destroy');

// ####### Route Final table
Route::get('/table', 'TableController@index');
Route::get('/allgames', 'AllGamesController@index');
