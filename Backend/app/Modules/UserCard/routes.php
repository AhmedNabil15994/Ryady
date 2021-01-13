<?php

/*----------------------------------------------------------
User Card
----------------------------------------------------------*/
Route::group(['prefix' => '/userCards'] , function () {
    Route::get('/', 'UserCardControllers@index');
    Route::get('/add', 'UserCardControllers@add');
    Route::get('/arrange', 'UserCardControllers@arrange');
    Route::get('/charts', 'UserCardControllers@charts');
    Route::get('/edit/{id}', 'UserCardControllers@edit');
    Route::post('/update/{id}', 'UserCardControllers@update');
    Route::post('/fastEdit', 'UserCardControllers@fastEdit');
	Route::post('/create', 'UserCardControllers@create');
    Route::get('/delete/{id}', 'UserCardControllers@delete');
    Route::post('/arrange/sort', 'UserCardControllers@sort');
});