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

Route::group(['namespace' => 'Api\v1', 'domain' => 'api.rekuovers.dev'], function () {
    Route::get('/', function (Request $request) {
        return response()->json(['api' => 'OK']);
    });
});

/*
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
 */