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
    $api->post('auth/login', 'AuthController@login');
    $api->post('auth/signup', 'AuthController@signup');

    $api->get('auth/refresh_token', ['uses' => 'AuthController@token', 'middleware' => 'jwt.refresh']);

    $api->get('me', ['uses' => 'AuthController@showMe', 'middleware' => 'api.auth']);

    $api->get('artists', 'ArtistController@index');
    $api->get('artists/{id}', 'ArtistController@show');
    $api->get('artists/{id}/original-songs', 'ArtistController@showOriginalSongs');

    $api->get('songs', 'SongController@index');
    $api->get('songs/{id}', 'SongController@show');
    $api->get('songs/{id}/original-song', 'SongController@showOriginalSong');

    $api->get('original-songs', 'OriginalSongController@index');
    $api->get('original-songs/{id}', 'OriginalSongController@show');
    $api->get('original-songs/{id}/artist', 'OriginalSongController@showArtist');
});