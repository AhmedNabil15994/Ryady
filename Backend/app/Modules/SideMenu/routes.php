<?php

/*----------------------------------------------------------
Side Menu
----------------------------------------------------------*/
Route::group(['prefix' => '/sideMenu'] , function () {
    Route::get('/', 'SideMenuControllers@index');
    Route::get('/add', 'SideMenuControllers@add');
    Route::get('/arrange', 'SideMenuControllers@arrange');
    Route::get('/charts', 'SideMenuControllers@charts');
    Route::get('/edit/{id}', 'SideMenuControllers@edit');
    Route::post('/update/{id}', 'SideMenuControllers@update');
    Route::post('/fastEdit', 'SideMenuControllers@fastEdit');
	Route::post('/create', 'SideMenuControllers@create');
    Route::get('/delete/{id}', 'SideMenuControllers@delete');
    Route::post('/arrange/sort', 'SideMenuControllers@sort');
});