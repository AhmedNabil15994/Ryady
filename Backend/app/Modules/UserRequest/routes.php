<?php

/*----------------------------------------------------------
User Requests
----------------------------------------------------------*/
Route::group(['prefix' => '/userRequests'] , function () {
    Route::get('/', 'UserRequestsControllers@index');
    Route::post('/fastEdit', 'UserRequestsControllers@fastEdit');
    Route::post('/delete', 'UserRequestsControllers@softDelete');
    Route::get('/delete/{id}', 'UserRequestsControllers@delete');
    Route::get('/charts', 'UserRequestsControllers@charts');
});

