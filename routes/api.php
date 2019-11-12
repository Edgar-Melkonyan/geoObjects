<?php

use Illuminate\Http\Request;

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

Route::resource('geo_objects', 'Api\GeoObjectController')->except('edit');
Route::get('geo_objects/{id}/geometries', 'Api\GeoObjectController@getGeoObjectGeometries');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
