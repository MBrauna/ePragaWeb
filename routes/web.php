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

    /**Companias */
    Route::prefix('/company')
         ->name('company.')
         ->namespace('Companies')
         ->group(function () {
             Route::get('/', 'CompaniesController@index')->name('index');
             Route::get('/create', 'CompaniesController@viewCreate')->name('create');
             Route::post('/create', 'CompaniesController@create')->name('create');
             Route::get('/update/{id}', 'CompaniesController@viewUpdate')->name('view-update');
             Route::post('/update', 'CompaniesController@update')->name('update');
             Route::get('/destroy/{id}', 'CompaniesController@destroy')->name('destroy');
         });

    /**Pragas */
    Route::prefix('/prague')
         ->name('prague.')
         ->namespace('Prague')
         ->group(function () {
             Route::get('/', 'PragueController@index')->name('index');
             Route::get('/create', 'PragueController@viewCreate')->name('create');
             Route::post('/create', 'PragueController@create')->name('create');
             Route::get('/update/{id}', 'PragueController@viewUpdate')->name('view-update');
             Route::post('/update', 'PragueController@update')->name('update');
             Route::get('/destroy/{id}', 'PragueController@destroy')->name('destroy');
         });

    /**Tratamento Pragas */
    Route::prefix('/treatment')
         ->name('treatment.')
         ->namespace('Prague')
         ->group(function () {
             Route::get('/', 'TreatmentController@index')->name('index');
             Route::get('/create', 'TreatmentController@viewCreate')->name('create');
             Route::post('/create', 'TreatmentController@create')->name('create');
             Route::get('/update/{id}', 'TreatmentController@viewUpdate')->name('view-update');
             Route::post('/update', 'TreatmentController@update')->name('update');
             Route::get('/destroy/{id}', 'TreatmentController@destroy')->name('destroy');
         });

    /**Subsidiárias */
    Route::prefix('/subsidiary')
         ->name('subsidiary.')
         ->namespace('Subsidiary')
         ->group(function () {
             Route::get('/', 'SubsidiaryController@index')->name('index');
             Route::get('/create', 'SubsidiaryController@viewCreate')->name('create');
             Route::post('/create', 'SubsidiaryController@create')->name('create');
             Route::get('/update/{id}', 'SubsidiaryController@viewUpdate')->name('view-update');
             Route::post('/update', 'SubsidiaryController@update')->name('update');
             Route::get('/destroy/{id}', 'SubsidiaryController@destroy')->name('destroy');
         });

});
