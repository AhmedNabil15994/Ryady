<?php

/*----------------------------------------------------------
Home
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::get('/', 'HomeControllers@index');

    Route::get('/memberShip', 'HomeControllers@memberShip');
    Route::get('/requestMemberShip', 'HomeControllers@requestMemberShip');
    Route::get('/members', 'HomeControllers@members');
    Route::get('/addProject', 'HomeControllers@addProject');
    Route::get('/membersProjects', 'HomeControllers@membersProjects');
    Route::get('/project', 'HomeControllers@project');

    Route::get('/vip', 'HomeControllers@vip');
    Route::get('/packageFeatures', 'HomeControllers@packageFeatures');

    Route::get('/blogs', 'HomeControllers@blogs');
    Route::get('/blogDetails', 'HomeControllers@blogDetails');

    Route::get('/contactUs', 'HomeControllers@contactUs');

    Route::get('/order', 'HomeControllers@order');

    Route::get('/profile', 'HomeControllers@profile');

});
