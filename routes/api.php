<?php

use Illuminate\Support\Facades\Route;

Route::get('ping', 'Api\PingController@index');


Route::post('register', 'Api\Auth\RegisterController@store');
Route::post('passwords/reset', 'Api\Auth\PasswordsController@store');
Route::put('passwords/reset', 'Api\Auth\PasswordsController@update');
Route::get('permissions', 'Api\Users\PermissionsController@index');
Route::get('url-short', 'Api\Users\UrlShortController@short');
Route::put('url/{url}', 'Api\Users\UrlShortController@update');
Route::delete('url/{url}', 'Api\Users\UrlShortController@destroy');
Route::get('{shortUrl}', 'Api\Users\UrlShortController@redirect');

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'Api\Users\UsersController@index');
        Route::post('/', 'Api\Users\UsersController@store');
        Route::get('/{uuid}', 'Api\Users\UsersController@show');
        Route::put('/{uuid}', 'Api\Users\UsersController@update');
        Route::patch('/{uuid}', 'Api\Users\UsersController@update');
        Route::delete('/{uuid}', 'Api\Users\UsersController@destroy');
    });

    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', 'Api\Users\RolesController@index');
        Route::post('/', 'Api\Users\RolesController@store');
        Route::get('/{uuid}', 'Api\Users\RolesController@show');
        Route::put('/{uuid}', 'Api\Users\RolesController@update');
        Route::patch('/{uuid}', 'Api\Users\RolesController@update');
        Route::delete('/{uuid}', 'Api\Users\RolesController@destroy');
    });



    Route::group(['prefix' => 'me'], function () {
        Route::get('/', 'Api\Users\ProfileController@index');
        Route::get('/urls', 'Api\Users\ProfileController@indexUrls');
        Route::put('/', 'Api\Users\ProfileController@update');
        Route::patch('/', 'Api\Users\ProfileController@update');
        Route::put('/password', 'Api\Users\ProfileController@updatePassword');
    });


});
