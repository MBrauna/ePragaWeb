<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LoginController@index')->name('index');

Route::post('/login', 'LoginController@login')->name('login');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/logout', 'LoginController@logout')->name('logout');

/**
 * Rotas protegidas para usuário autenticado
 */
Route::group(['middleware' => 'CheckUserLogin'], function(){

    Route::prefix('/dashboard')
          ->name('dashboard.')
          ->group(function () {
               Route::get('/', 'DashboardAdminController@index')->name('index');
          });

    Route::prefix('/user')
         ->name('user.')
         ->namespace('User')
         ->group(function () {
             Route::get('/', 'UserController@index')->name('index');
    });

    Route::prefix('/company')
         ->name('company.')
         ->namespace('Companies')
         ->group(function () {
             Route::get('/', 'CompaniesController@index')->name('index');
             Route::get('/create', 'CompaniesController@viewCreate')->name('create');
             Route::post('/create', 'CompaniesController@create')->name('create');
             Route::get('/update', 'CompaniesController@viewUpdate')->name('update');
             Route::post('/update', 'CompaniesController@update')->name('update');
             Route::get('/destroy/{id}', 'CompaniesController@destroy')->name('destroy');
         });

});
