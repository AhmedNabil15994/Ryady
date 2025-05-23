<?php

/*----------------------------------------------------------
Home
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::get('/', 'HomeControllers@index');
    Route::get('/home', 'HomeControllers@home');
    Route::get('/getUserData/{id}', 'HomeControllers@getUserData');
    Route::get('/members', 'HomeControllers@members');
    Route::get('/vip', 'HomeControllers@vip');
    Route::get('/contactUs', 'HomeControllers@contactUs');
    Route::post('/contactUs', 'HomeControllers@postContactUs');
    Route::get('/order', 'HomeControllers@order');
    Route::post('/order', 'HomeControllers@postOrder');
    Route::get('/signin', 'HomeControllers@login');
    Route::get('/entrepreneur', 'HomeControllers@entrepreneur');
});
