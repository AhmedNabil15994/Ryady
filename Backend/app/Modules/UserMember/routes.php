<?php

/*----------------------------------------------------------
User Members
----------------------------------------------------------*/
Route::group(['prefix' => '/userMembers'] , function () {
    Route::get('/', 'UserMemberControllers@index');
    Route::get('/add', 'UserMemberControllers@add');
    Route::get('/arrange', 'UserMemberControllers@arrange');
    Route::get('/charts', 'UserMemberControllers@charts');
    Route::get('/edit/{id}', 'UserMemberControllers@edit');
    Route::post('/update/{id}', 'UserMemberControllers@update');
    Route::post('/fastEdit', 'UserMemberControllers@fastEdit');
	Route::post('/create', 'UserMemberControllers@create');
    Route::get('/delete/{id}', 'UserMemberControllers@delete');
    Route::post('/arrange/sort', 'UserMemberControllers@sort');
});