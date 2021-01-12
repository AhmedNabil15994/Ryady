<?php

/*----------------------------------------------------------
Target Group
----------------------------------------------------------*/
Route::group(['prefix' => '/targets'] , function () {
    Route::get('/', 'TargetGroupControllers@index');
    Route::get('/add', 'TargetGroupControllers@add');
    Route::get('/arrange', 'TargetGroupControllers@arrange');
    Route::get('/charts', 'TargetGroupControllers@charts');
    Route::get('/edit/{id}', 'TargetGroupControllers@edit');
    Route::post('/update/{id}', 'TargetGroupControllers@update');
    Route::post('/fastEdit', 'TargetGroupControllers@fastEdit');
	Route::post('/create', 'TargetGroupControllers@create');
    Route::get('/delete/{id}', 'TargetGroupControllers@delete');
    Route::post('/arrange/sort', 'TargetGroupControllers@sort');
});