<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PostController@index')
    ->name('home');

Route::get('/spa', 'HomeController@spaHome')
    ->name('spaHome');

Route::get('/section', 'SectionController@index')
    ->name('section.index');

Route::get('/tag', 'TagController@index')
    ->name('tag.index');

Route::get('/section/{id}', 'SectionController@show')
    ->name('section.show');

Route::get('/tag/{id}', 'TagController@show')
    ->name('tag.show');

Route::get('/post/{id}', 'PostController@show')
    ->name('post.show');

Auth::routes();

Route::resource('section', 'SectionController', ['except' => ['index', 'show']]);
Route::resource('tag', 'TagController', ['except' => ['index', 'show']]);
Route::resource('post', 'PostController', ['except' => ['index', 'show']]);
