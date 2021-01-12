<?php

/*----------------------------------------------------------
Blogs
----------------------------------------------------------*/
Route::group(['prefix' => '/blogs'] , function () {
    Route::get('/', 'BlogControllers@index');
    Route::get('/add', 'BlogControllers@add');
    Route::get('/arrange', 'BlogControllers@arrange');
    Route::get('/charts', 'BlogControllers@charts');
    Route::get('/edit/{id}', 'BlogControllers@edit');
    Route::post('/update/{id}', 'BlogControllers@update');
    Route::post('/fastEdit', 'BlogControllers@fastEdit');
	Route::post('/create', 'BlogControllers@create');
    Route::get('/delete/{id}', 'BlogControllers@delete');
    Route::post('/arrange/sort', 'BlogControllers@sort');

    /*----------------------------------------------------------
    Images
    ----------------------------------------------------------*/

    Route::post('/add/uploadImage', 'BlogControllers@uploadImage');
    Route::post('/edit/{id}/editImage', 'BlogControllers@uploadImage');
    Route::post('/edit/{id}/deleteImage', 'BlogControllers@deleteImage');
});