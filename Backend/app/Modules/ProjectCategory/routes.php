<?php

/*----------------------------------------------------------
Project Category
----------------------------------------------------------*/
Route::group(['prefix' => '/projectCategories'] , function () {
    Route::get('/', 'ProjectCategoryControllers@index');
    Route::get('/add', 'ProjectCategoryControllers@add');
    Route::get('/arrange', 'ProjectCategoryControllers@arrange');
    Route::get('/charts', 'ProjectCategoryControllers@charts');
    Route::get('/edit/{id}', 'ProjectCategoryControllers@edit');
    Route::post('/update/{id}', 'ProjectCategoryControllers@update');
    Route::post('/fastEdit', 'ProjectCategoryControllers@fastEdit');
	Route::post('/create', 'ProjectCategoryControllers@create');
    Route::get('/delete/{id}', 'ProjectCategoryControllers@delete');
    Route::post('/arrange/sort', 'ProjectCategoryControllers@sort');
});