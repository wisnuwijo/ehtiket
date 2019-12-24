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

Route::get('/', function() {
    dd('landing page');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'role']], function() {

    Route::get('events', 'EventController@index');
    Route::get('events/add', 'EventController@add');
    Route::post('events/add', 'EventController@store');
    Route::get('events/create_ticket', 'EventController@create_ticket');
    Route::post('events/create_ticket', 'EventController@store_ticket');
    Route::get('events/edit/{event_id}', 'EventController@edit');
    Route::post('events/edit', 'EventController@update');
    Route::get('events/delete/{eventId}', 'EventController@delete');
    Route::get('events/detail/{eventId}', 'EventController@event_detail');
    Route::get('events/ticket/{trxId}','TicketController@index');

    Route::get('registrant', 'RegistrantController@index');
    Route::get('registrant/list/{eventId}', 'RegistrantController@registrant_list');
    Route::post('registrant/confirm_payment','RegistrantController@confirm_payment');
    Route::get('registrant/detail_transaction','RegistrantController@detail_transaction');

    Route::get('user','UserController@show_user');

});
