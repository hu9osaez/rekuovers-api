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

Route::group(['namespace' => 'Api\v1'], function () {

    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/signup', 'AuthController@signUp');
    Route::post('auth/refresh', 'AuthController@refreshToken');

    Route::post('oauth/facebook', 'OAuthController@facebook');

    Route::get('artists/search', 'ArtistController@search')->name('artists.search');
    Route::get('artists/{uuid}', 'ArtistController@show')->name('artists.show');

    Route::get('songs/search', 'SongController@search')->name('songs.search');
    Route::get('songs/{uuid}', 'SongController@show')->name('songs.show');

    Route::get('covers/newest', 'CoverController@newest')->name('covers.newest');
    Route::get('covers/popular', 'CoverController@popular')->name('covers.popular');
    Route::get('covers/search', 'CoverController@search')->name('covers.search');
    Route::get('covers/{uuid}', 'CoverController@show')->name('covers.show');
});

/*
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\v1', 'as' => 'api:'], function ($api) {

    $api->post('auth/refresh', ['uses' => 'AuthController@refreshToken']);
    $api->get('auth/me', ['uses' => 'AuthController@showMe', 'middleware' => 'verify.jwt']);

    //$api->get('songs/{id}/likes/exists', ['uses' => 'CoverController@existsLike', 'middleware' => 'auth']);
    //$api->post('songs/{id}/likes', ['uses' => 'CoverController@storeLike', 'middleware' => 'auth']);

    $api->get('users/{username}', 'UserController@show');
});
*/
