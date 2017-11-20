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

Route::post('/auth',[
	'uses' => 'ApiAuthController@authenticate',
]);

Route::get( '/posts', [
    'uses'       => 'ApiPostController@index',
] );
Route::post( '/posts', [
    'uses'       => 'ApiPostController@create',
    'middleware' => 'api',
] );
Route::delete( '/posts/{id}', [
    'uses'       => 'ApiPostController@delete',
] );
Route::put( '/posts/{id}', [
    'uses'       => 'ApiPostController@update',
] );
