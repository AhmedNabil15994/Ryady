<?php

/*----------------------------------------------------------
Order Category
----------------------------------------------------------*/
Route::group(['prefix' => '/orderCategories'] , function () {
    Route::get('/', 'OrderCategoryControllers@index');
    Route::get('/add', 'OrderCategoryControllers@add');
    Route::get('/arrange', 'OrderCategoryControllers@arrange');
    Route::get('/charts', 'OrderCategoryControllers@charts');
    Route::get('/edit/{id}', 'OrderCategoryControllers@edit');
    Route::post('/update/{id}', 'OrderCategoryControllers@update');
    Route::post('/fastEdit', 'OrderCategoryControllers@fastEdit');
	Route::post('/create', 'OrderCategoryControllers@create');
    Route::get('/delete/{id}', 'OrderCategoryControllers@delete');
    Route::post('/arrange/sort', 'OrderCategoryControllers@sort');
});