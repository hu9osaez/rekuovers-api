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

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1', 'as' => 'api:'], function ($api) {
    $api->post('auth/signin', ['uses' => 'AuthController@signIn']);
    $api->post('auth/signup', 'AuthController@signUp');
    $api->get('auth/facebook', 'AuthController@authorizeFacebook');

    $api->post('auth/refresh', ['uses' => 'AuthController@refreshToken']);
    $api->get('auth/me', ['uses' => 'AuthController@showMe', 'middleware' => 'verify.jwt']);

    $api->get('artists', 'ArtistController@index');
    $api->get('artists/{id}', 'ArtistController@show')->name('artists:show');

    $api->get('original-songs', 'OriginalSongController@index');
    $api->get('original-songs/{id}', 'OriginalSongController@show');

    $api->get('songs', 'SongController@index');
    $api->get('songs/{id}', 'SongController@show');
    //$api->get('songs/{id}/likes/exists', ['uses' => 'SongController@existsLike', 'middleware' => 'auth']);
    //$api->post('songs/{id}/likes', ['uses' => 'SongController@storeLike', 'middleware' => 'auth']);

    $api->get('users/{username}', 'UserController@show');
});
