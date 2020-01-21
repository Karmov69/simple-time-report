<?php

Auth::routes();


Route::middleware('auth')->group(function () {

    Route::get('/', 'HomeController@index');
    Route::resource('reports', 'ReportController');

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', 'UserController');
        Route::get('reports', [ 'as' => 'reports.all', 'uses' => 'ReportController@all']);
    });

    Route::middleware('role:user')->group(function () {
        Route::get('/my-reports', [ 'as' => 'reports.index', 'uses' => 'ReportController@index']);
        Route::get('/my-reports/{report}/edit', 'ReportController@edit');

    });
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
