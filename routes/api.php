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

Route::post('/auth', [
    'uses' => 'ApiAuthController@authenticate',
]);

Route::get('/posts', [
    'uses' => 'ApiPostController@index',
]);

Route::get('/posts/{id}', [
    'uses' => 'ApiPostController@show',
]);

Route::post('/posts', [
    'uses' => 'ApiPostController@create',
]);

Route::put('/posts/{id}', [
    'uses' => 'ApiPostController@update',
]);

Route::delete('/posts/{id}', [
    'uses' => 'ApiPostController@destroy',
]);

Route::get('/section', [
    'uses' => 'ApiSectionController@index',
]);


//Route::middleware( [ 'jwt.auth' ] )->group( function () {

//} );


