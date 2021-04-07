<?php

/*----------------------------------------------------------
Home
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::get('/', 'HomeControllers@index');
    Route::get('/getUserData/{id}', 'HomeControllers@getUserData');
    Route::get('/members', 'HomeControllers@members');
    Route::get('/vip', 'HomeControllers@vip');
    Route::get('/contactUs', 'HomeControllers@contactUs');
    Route::post('/contactUs', 'HomeControllers@postContactUs');
    Route::get('/order', 'HomeControllers@order');
    Route::post('/order', 'HomeControllers@postOrder');
    Route::get('/joinUs', 'HomeControllers@joinUs');
    Route::get('/whoUs', 'HomeControllers@whoUs');
    Route::get('/events', 'HomeControllers@events');
    Route::get('/events/{id}', 'HomeControllers@getOneEvent');
    Route::post('/events/{id}', 'HomeControllers@postNewEventUser');
    Route::get('/events/{id}/joinEvent', 'HomeControllers@joinEvent');

});
