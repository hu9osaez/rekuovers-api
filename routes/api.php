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
    $api->post('auth/signin', 'AuthController@signin');
    $api->post('auth/signup', 'AuthController@signup');
    $api->get('auth/facebook', 'AuthController@authorizeFacebook');
    $api->get('auth/me', ['uses' => 'AuthController@showMe', 'middleware' => 'auth']);

    $api->get('artists', 'ArtistController@index');
    $api->get('artists/{id}', 'ArtistController@show');

    $api->get('original-songs', 'OriginalSongController@index');
    $api->get('original-songs/{id}', 'OriginalSongController@show');

    $api->get('songs', 'SongController@index');
    $api->get('songs/{id}', 'SongController@show');
    $api->get('songs/{id}/likes/exists', ['uses' => 'SongController@existsLike', 'middleware' => 'auth']);
    $api->post('songs/{id}/likes', ['uses' => 'SongController@storeLike', 'middleware' => 'auth']);

    $api->get('users/{username}', 'UserController@show');
});

// @TODO: Implement search in resources (Ex. $api->get('songs/search', 'SongController@search');)