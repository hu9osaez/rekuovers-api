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

    Route::post('auth/facebook', 'SocialAuthController@facebook');

    Route::post('auth/signup', 'AuthController@signUp');
    Route::post('auth/login', 'AuthController@login');
    Route::get('auth/refresh', 'AuthController@refresh')->middleware('custom.jwt.refresh');

    Route::get('auth/logout', 'AuthController@logout')->middleware('auth:api');

    Route::get('me', 'MeController@me')->middleware('auth:api');
    Route::get('me/liked-covers', 'MeController@likedCoversIds')->middleware('auth:api');

    Route::get('covers', 'CoverController@index')->name('covers.index');
    Route::get('covers/newest', 'CoverController@newest')->name('covers.newest');
    Route::get('covers/popular', 'CoverController@popular')->name('covers.popular');
    Route::get('covers/{uuid}', 'CoverController@show')->name('covers.show');

    Route::post('covers/{uuid}/likes', 'LikeController@store')->middleware('auth:api');
    Route::delete('covers/{uuid}/likes', 'LikeController@delete')->middleware('auth:api');
});
