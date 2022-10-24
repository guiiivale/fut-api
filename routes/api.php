<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'before'], function () {
    Route::prefix('players')->group(function () {
        Route::get('/', 'App\Http\Controllers\PlayersController@getPlayers');
        Route::post('/create', 'App\Http\Controllers\PlayersController@store');
        Route::put('/edit', 'App\Http\Controllers\PlayersController@update');
        Route::delete('/delete', 'App\Http\Controllers\PlayersController@destroy');
    });
    Route::prefix('teams')->group(function () {
        Route::get('/', 'App\Http\Controllers\TeamsController@getTeams');
        Route::post('/create', 'App\Http\Controllers\TeamsController@store');
        Route::put('/edit', 'App\Http\Controllers\TeamsController@update');
        Route::delete('/delete', 'App\Http\Controllers\TeamsController@destroy');
    });
    Route::prefix('matches')->group(function () {
        Route::get('/', 'App\Http\Controllers\MatchesController@getMatches');
        Route::post('/create', 'App\Http\Controllers\MatchesController@store');
        Route::put('/edit', 'App\Http\Controllers\MatchesController@update');
        Route::delete('/delete', 'App\Http\Controllers\MatchesController@destroy');
    });
    Route::prefix('cards')->group(function () {
        Route::get('/', 'App\Http\Controllers\CardsController@getCards');
        Route::post('/create', 'App\Http\Controllers\CardsController@store');
        Route::put('/edit', 'App\Http\Controllers\CardsController@update');
    });
});
