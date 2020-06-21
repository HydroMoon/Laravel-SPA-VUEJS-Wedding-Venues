<?php

use App\Http\Resources\VenueResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('venues', 'VenueController@index');
Route::get('venues/{id}', 'VenueController@show');
Route::post('venues', 'VenueController@store');

Route::delete('venues/{id}', 'VenueController@destroy');
Route::patch('venues/{id}', 'VenueController@update');


//Others
Route::get('vcount', 'VenueController@getCount');

//states getStates
Route::get('states', 'VenueController@getStates');
Route::get('cities/{id}', 'VenueController@getCities');

Route::get('address', 'VenueController@getAddress');
