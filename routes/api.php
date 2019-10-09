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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/listt', 'UsersController@list');


Route::get('/APIlist', 'UsersController@list');
Route::post('/APInewuser', 'UsersController@create');
Route::post('/APIgetUser', 'UsersController@getUser');

Route::post('/APIgetParkingAll', 'ParkingsController@APIgetParkingAll');
Route::post('/APIgetParking', 'ParkingsController@APIgetParking');
Route::post('/APIgetNearParkings', 'ParkingsController@distanc');
Route::post('/APIgetNearParkingsbyLL', 'ParkingsController@APIgetNearParkingsbyLL');

Route::post('/APIaddCar', 'CarsController@APIaddCar');
Route::post('/APIgetUserCars', 'CarsController@APIgetUserCars'); 
Route::post('/APIeditCar', 'CarsController@APIeditCar'); 

Route::post('/APInewReserve', 'RentalsController@APInewReserve');
Route::post('/APIcheckIn', 'RentalsController@APIcheckIn');
Route::post('/APIcheckOut', 'RentalsController@APIcheckOut');
Route::post('/APIcurrentRent', 'RentalsController@APIcurrentRent');
Route::post('/APIcancelReserve', 'RentalsController@APIcancelReserve');
Route::post('/APIgetRentals', 'RentalsController@APIgetRentals');

Route::post('/pay', 'RentalsController@pay');

Route::post('/APIhasDebts', 'PaymentsController@index'); //verificar si el usuario debe dinero 
Route::post('/APIhasCreditcards', 'PaymentsController@APIhasCreditcards');
Route::post('/APIprocessPayment', 'PaymentsController@APIprocessPayment');
Route::post('/APIaddCreditcards', 'PaymentsController@APIaddCreditcards');
