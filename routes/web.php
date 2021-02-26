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
Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome-login');

Route::group(['namespace' => 'profile', 'middleware' => 'auth', 'prefix' => 'profile'], function () {

    // Dashboard
    Route::get('/dashboard', 'MainController@index')->name('dashboard');

    // Search
    Route::get('/search', 'MainController@search')->name('search');

    // Lists
    Route::get('/lists', 'ListController@index')->name('lists');
    Route::get('/list/{id}', 'ListController@list')->name('list');
    Route::post('/list/create', 'ListController@create');
    Route::post('/list/remove', 'ListController@remove');

    // Tasks
    Route::post('/task/create', 'TaskController@create');
    Route::post('/task/done', 'TaskController@done');
    Route::post('/task/remove', 'TaskController@remove');
});