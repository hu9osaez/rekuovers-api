<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1'], function ($api) {
    $api->get('artists', 'ArtistController@index');
    $api->get('artists/{id}', 'ArtistController@show');

    $api->get('songs', 'SongController@index');
    $api->get('songs/{id}', 'SongController@show');
});