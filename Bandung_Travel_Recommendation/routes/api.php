<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth
Route::post('/auth/login', "AuthController@login");
Route::post('/auth/register', "AuthController@register");
Route::delete('/auth/logout', "AuthController@logout")->middleware('auth:sanctum');

// Hotel
Route::get('/place/get-hotels', "PlaceController@getHotels");

// Destinastion
Route::get('/place/get-destinations', "PlaceController@getDestinations");
Route::get('/place/get-destination-types', "PlaceController@getDestinationTypes");


Route::group(['middleware' => ['auth:sanctum']], function () {
    // User
    Route::post('/user/edit', "UserController@edit");
    Route::get('/user/get-information', "UserController@getInformation");
    Route::post('/user/favorite-place/add', "UserController@addFavoritePlace");
    Route::delete('/user/favorite-place/delete/{id}', "UserController@deleteFavoritePlace");
    Route::get('/user/favorite-place/get-all', "UserController@getFavoritePlaces");
    Route::get('/user/touch-place/{id}', "UserController@touchPlace");

    // General Place
    Route::post('/place/type/add', "PlaceController@addPlaceType")->middleware('role');
    Route::post('/place/type/edit/{id}', "PlaceController@editPlaceType")->middleware('role');
    Route::delete('/place/type/delete/{id}', "PlaceController@deletePlaceType")->middleware('role');
    Route::get('/place/type/get-all', "PlaceController@getPlaceTypes")->middleware('role');
    Route::get('/place/type/{id}', "PlaceController@getPlaceTypeById")->middleware('role');

    Route::post('/place/add', "PlaceController@addPlace")->middleware('role');
    Route::post('/place/edit/{id}', "PlaceController@editPlace")->middleware('role');
    Route::delete('/place/delete/{id}', "PlaceController@deletePlace")->middleware('role');
    Route::get('/place/get-all', "PlaceController@getPlaces")->middleware('role');
    Route::get('/place/{id}', "PlaceController@getPlaceById");

});
