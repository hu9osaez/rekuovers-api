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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1', 'as' => 'api::'], function ($api) {
    $api->post('auth/signin', ['uses' => 'AuthController@signin']);

    $api->get('artists', 'ArtistController@index')->name('artists');
});

/*
    $api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1'], function ($api) {

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
 */