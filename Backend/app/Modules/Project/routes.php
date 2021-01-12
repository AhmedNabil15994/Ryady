<?php

/*----------------------------------------------------------
Projects
----------------------------------------------------------*/
Route::group(['prefix' => '/projects'] , function () {
    Route::get('/', 'ProjectControllers@index');
    Route::get('/add', 'ProjectControllers@add');
    Route::get('/arrange', 'ProjectControllers@arrange');
    Route::get('/charts', 'ProjectControllers@charts');
    Route::get('/edit/{id}', 'ProjectControllers@edit');
    Route::post('/update/{id}', 'ProjectControllers@update');
    Route::post('/fastEdit', 'ProjectControllers@fastEdit');
	Route::post('/create', 'ProjectControllers@create');
    Route::get('/delete/{id}', 'ProjectControllers@delete');
    Route::post('/arrange/sort', 'ProjectControllers@sort');

    /*----------------------------------------------------------
    Images
    ----------------------------------------------------------*/

    Route::post('/add/uploadImage', 'ProjectControllers@uploadImage');
    Route::post('/edit/{id}/editImage', 'ProjectControllers@uploadImage');
    Route::post('/edit/{id}/deleteImage', 'ProjectControllers@deleteImage');
    Route::post('/edit/{id}/deleteImages', 'ProjectControllers@deleteImages');
});