<?php

Route::auth();
Route::group(['middleware' => 'web'], function () {
    Route::get('reset-password', 'Auth\AuthController@reset_password');
    Route::post('reset', 'Auth\AuthController@reset');
    Route::get('new-password/{token}', 'Auth\AuthController@new_password');
    Route::post('save_password', 'Auth\AuthController@save_password');
});

Route::group(['middleware' => 'auth'], function () {
    Route::controller('cmd', 'CommandsController');
    Route::get('/', ['as' => '/', 'uses' => 'HomeController@index']);
   
    Route::resource('/clients', 'ClientsController');
    Route::post( 'clients/datatable', 'ClientsController@datatable');
    Route::get( 'change_status/{id}', 'ClientsController@change_status');
    Route::post('/clients/export', 'ClientsController@export')->name( 'clients.export');
   
    Route::resource( '/sms_history', 'SmsHistoryController');
    Route::post( 'sms_history/datatable', 'SmsHistoryController@datatable');
    Route::post( '/sms_history/export', 'SmsHistoryController@export')->name( 'sms_history.export');

});
