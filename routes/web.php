<?php

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
    return view('/index');
});
/*Route::get('logintwt', function () {
    return view('user.login_twt');
});
Route::get('user', function () {
    return view('user.index');
});*/
Route::middleware('auth')->get('webpanel', function () {
    return view('webpanel.layout');
});
Route::get('about', function () {
   // return view('staticspages.about');
   return view('/index');
});
/*Route::get('info', function () {
    return view('staticspages.info');
});*/


Auth::routes();
Route::get('register2', 'UserController@create');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('user', 'UsersController@index');
Route::post('user', 'UsersController@create');
Route::get('user/{id}', 'UsersController@show');
Route::get('user/{id}/edit', 'UsersController@edit')->name('user.edit');
Route::get('user/{id}/documentos', 'UsersController@documentos')->name('user.documentos');
Route::patch('user/{id}/documentos', 'UsersController@documentos_upload')->name('user.documentos_upload');
Route::patch('user/{id}', 'UsersController@update')->name('user.update');

Route::get('/panel', 'PanelwebController@index');

Route::resource('parkings', 'ParkingsController');  
//Route::post('parkings/{id}', 'ParkingsController@deleteParking')->name('parkings.deleteParking');
Route::delete('parkings/{id}',array('uses' => 'ParkingsController@destroy', 'as' => 'parkings.deleteParking'));
Route::get('/parkings/pdfqrcode/{parking}','ParkingsController@pdfqrcode');

Route::resource('parking_schedule','ParkingScheduleController');

//Route::get('parkingschedule', 'ParkingScheduleController@index')->name('parkinshedule.index');
//Route::get('parkingschedule/{parkingsSchedule}', 'ParkingScheduleController@show');

Route::get('parking_schedule/{parkingSchedule}/{day}/editar','ParkingScheduleController@editar');

Route::get('car/{car}', 'CarsController@show');
Route::get('car', 'CarsController@list')->name('car.list');

Route::get('/rentas', 'RentalsController@index');


Route::post('pago', 'PaymentsController@payment')->name('conekta.doPayment');
Route::post('token', 'PaymentsController@token')->name('conekta.token');
Route::get('client', 'PaymentsController@addClient')->name('conekta.addClient');

Route::get('/addclient', function () {
    return view('payments/form');
});
