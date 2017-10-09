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

Route::group(['namespace' => 'Api\V1'], function () {

    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/signup', 'AuthController@signUp');

    Route::post('oauth/facebook', 'OAuthController@facebook');

    Route::get('me', 'AuthController@me')->middleware('auth:api');

    Route::get('artists/search', 'ArtistController@search')->name('artists.search');
    Route::get('artists/{uuid}', 'ArtistController@show')->name('artists.show');

    Route::get('songs/search', 'SongController@search')->name('songs.search');
    Route::get('songs/{uuid}', 'SongController@show')->name('songs.show');

    Route::get('covers/newest', 'CoverController@newest')->name('covers.newest');
    Route::get('covers/popular', 'CoverController@popular')->name('covers.popular');
    Route::get('covers/search', 'CoverController@search')->name('covers.search');
    Route::get('covers/{uuid}', 'CoverController@show')->name('covers.show');

    Route::get('covers/{uuid}/likes/exists', 'LikeController@exists')->middleware('auth:api');
    Route::post('covers/{uuid}/likes', 'LikeController@store')->middleware('auth:api');
});
