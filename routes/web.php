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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('/user/')->group(function () {
        Route::get('gallaries/create', 'GallaryController@gallaryCreate')->name('gallaryCreate');
        Route::post('gallaries/store', 'GallaryController@gallaryStore')->name('gallaryStore');
        Route::get('gallaries/show/{id}', 'GallaryController@gallaryShow')->name('gallaryShow');
        Route::get('gallaries/edit/{id}', 'GallaryController@gallaryEdit')->name('gallaryEdit');
        Route::post('gallaries/update/{id}', 'GallaryController@gallaryUpdate')->name('gallaryUpdate');
        Route::get('gallaries/delete/{id}', 'GallaryController@gallaryDelete');

        // Photo Create
        Route::get('gallaries/photos/create/{id}', 'GallaryController@photoCreate')->name('photoCreate');
        Route::post('gallaries/photos/store', 'GallaryController@photoStore')->name('photoStore');
        Route::get('gallaries/photos/show/{id}', 'GallaryController@photoShow')->name('photoShow');
        Route::get('gallaries/photos/edit/{id}', 'GallaryController@photoEdit')->name('photoEdit');
        Route::post('gallaries/photos/update/{id}', 'GallaryController@photoUpdate')->name('photoUpdate');
        Route::get('gallaries/photos/delete/{id}', 'GallaryController@photoDelete');
        // Route::get('gallaries/photos/delete/{id}', 'GallaryController@photoDelete')->name('photoDelete');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
