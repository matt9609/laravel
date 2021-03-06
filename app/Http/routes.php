<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

    Route::get('/login', 'Auth\AuthController@getLogin');
    Route::post('/login', 'Auth\AuthController@postLogin');
    Route::get('/logout', 'Auth\AuthController@getLogout');

    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');

    Route::get('/Solicitudes/index/{id?}', 'Solicitudes@index');
    Route::post('/Solicitudes', 'Solicitudes@store');
    Route::post('/Solicitudes/{id}', 'Solicitudes@update');
    Route::delete('/Solicitudes/{id}', 'Solicitudes@destroy');
    Route::get('Solicitudes/{id}', 'Solicitudes@sendEmail');


    Route::get('/Detalle/{id?}', 'Detalles@index');
    Route::post('/Detalle', 'Detalles@store');
    Route::post('/Detalle/{id}', 'Detalles@update');
    Route::delete('/Detalle/{id}', 'Detalles@destroy');

    Route::get('/Elementos', 'Elementos@index');

    Route::get('/Tipos', 'Tipos@index');
    Route::get('/Tipos/{id}', 'Tipos@filtering');


    /* Authenticated users */
    Route::group(['middleware' => 'auth'], function()
    {
        Route::get('/', array('as'=>'dashboard', function()
        {
            return View('new-request');
        }));

        Route::get('mis-solicitudes', 'Solicitudes@misSolicitudes');

    });





