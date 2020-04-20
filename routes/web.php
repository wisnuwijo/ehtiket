<?php
Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/sendEmailTest', 'HomeController@sendEmailTest');
Route::get('/eventlist','HomeController@eventlist')->name('eventlist');
Route::get('/event/{slug}','HomeController@event_detail');
Route::post('/event/register','HomeController@register');

Route::post('user/register_new_user','UserController@register_new_user');
Route::post('user/register_or_login','UserController@register_or_login');

Route::get('register/{eventSlug}', 'EventController@register');
Route::get('join/{eventSlug}', 'EventController@join');

Route::group(['middleware' => ['auth', 'role']], function() {

    Route::get('/home', 'HomeController@home')->name('home');

    Route::get('events', 'EventController@index')->name('events');
    Route::get('events/add', 'EventController@add');
    Route::post('events/add', 'EventController@store');
    Route::get('events/create_ticket', 'EventController@create_ticket');
    Route::post('events/create_ticket', 'EventController@store_ticket');
    Route::get('events/edit/{event_id}', 'EventController@edit');
    Route::post('events/edit', 'EventController@update');
    Route::get('events/delete/{eventId}', 'EventController@delete');
    Route::get('events/detail/{eventId}', 'EventController@event_detail');
    Route::get('events/ticket/{trxId}','TicketController@index');
    Route::get('events/setting/{eventId}','EventController@setting');
    Route::post('events/setting/save','EventController@save_setting');

    Route::get('registrant', 'RegistrantController@index')->name('registrant');
    Route::get('registrant/list/{eventId}', 'RegistrantController@registrant_list');
    Route::post('registrant/confirm_payment','RegistrantController@confirm_payment');
    Route::get('registrant/detail_transaction','RegistrantController@detail_transaction');

    Route::get('user','UserController@show_user')->name('user');
    Route::get('user/add', 'UserController@add_user');
    Route::get('user/check_email','UserController@check_email');
    Route::post('user/save','UserController@save');
    Route::patch('user/save','UserController@update_user');
    Route::get('user/delete/{id}','UserController@delete');
    Route::get('user/edit/{id}', 'UserController@edit');

});
