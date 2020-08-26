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

Route::get('/dashboard', 'DashboardAdminController@index')->name('dashboard');


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

});