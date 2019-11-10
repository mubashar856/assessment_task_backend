<?php


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

Route::get('tournaments', 'TournamentController@getTournaments');
Route::get('match-stats', 'MatchController@getMatchHistory');
Route::get('teams', 'TeamController@getTeams');
Route::post('matches/schedule', 'MatchController@scheduleMatches');
