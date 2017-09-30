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

Route::namespace('Api\v1')->group(function () {

    Route::get('/', function () {
        return response()->json(['status' => 'API']);
    });

    Route::post('auth/signin', 'AuthController@signIn');
    Route::post('auth/signup', 'AuthController@signUp');

    Route::get('artists', 'ArtistController@index');
    Route::get('artists/{uuid}', 'ArtistController@show');

    Route::get('songs', 'SongController@index');
    Route::get('songs/{uuid}', 'SongController@show');

    Route::get('covers', 'CoverController@index');
    Route::get('covers/{uuid}', 'CoverController@show');
});

/*
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1', 'as' => 'api:'], function ($api) {
    $api->get('auth/facebook', 'AuthController@authorizeFacebook');

    $api->post('auth/refresh', ['uses' => 'AuthController@refreshToken']);
    $api->get('auth/me', ['uses' => 'AuthController@showMe', 'middleware' => 'verify.jwt']);

    //$api->get('songs/{id}/likes/exists', ['uses' => 'CoverController@existsLike', 'middleware' => 'auth']);
    //$api->post('songs/{id}/likes', ['uses' => 'CoverController@storeLike', 'middleware' => 'auth']);

    $api->get('users/{username}', 'UserController@show');
});
*/