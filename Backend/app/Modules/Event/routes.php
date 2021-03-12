<?php

/*----------------------------------------------------------
Events
----------------------------------------------------------*/
Route::group(['prefix' => '/events'] , function () {
    Route::get('/', 'EventControllers@index');
    Route::get('/add', 'EventControllers@add');
    Route::get('/arrange', 'EventControllers@arrange');
    Route::get('/charts', 'EventControllers@charts');
    Route::get('/edit/{id}', 'EventControllers@edit');
    Route::post('/update/{id}', 'EventControllers@update');
    Route::post('/fastEdit', 'EventControllers@fastEdit');
	Route::post('/create', 'EventControllers@create');
    Route::get('/delete/{id}', 'EventControllers@delete');
    Route::post('/arrange/sort', 'EventControllers@sort');

    /*----------------------------------------------------------
    Images
    ----------------------------------------------------------*/

    Route::post('/add/uploadImage', 'EventControllers@uploadImage');
    Route::post('/edit/{id}/editImage', 'EventControllers@uploadImage');
    Route::post('/edit/{id}/deleteImage', 'EventControllers@deleteImage');
});