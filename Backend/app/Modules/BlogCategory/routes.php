<?php

/*----------------------------------------------------------
Blog Category
----------------------------------------------------------*/
Route::group(['prefix' => '/blogCategories'] , function () {
    Route::get('/', 'BlogCategoryControllers@index');
    Route::get('/add', 'BlogCategoryControllers@add');
    Route::get('/arrange', 'BlogCategoryControllers@arrange');
    Route::get('/charts', 'BlogCategoryControllers@charts');
    Route::get('/edit/{id}', 'BlogCategoryControllers@edit');
    Route::post('/update/{id}', 'BlogCategoryControllers@update');
    Route::post('/fastEdit', 'BlogCategoryControllers@fastEdit');
	Route::post('/create', 'BlogCategoryControllers@create');
    Route::get('/delete/{id}', 'BlogCategoryControllers@delete');
    Route::post('/arrange/sort', 'BlogCategoryControllers@sort');
});