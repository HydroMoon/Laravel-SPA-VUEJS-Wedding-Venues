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

Route::get('{any}', function () {
    return view('main');
})->where('any', '.*');

// Route::get('/single', function () {
//     return view('welcome');
// });

// Route::get('/myhome', function () {
//     return view('myhome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::post('uploadImage', 'HomeController@storeImage')->name('imageUpload');
