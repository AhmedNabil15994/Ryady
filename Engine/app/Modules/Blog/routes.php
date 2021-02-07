<?php

/*----------------------------------------------------------
Blogs
----------------------------------------------------------*/
Route::group(['prefix' => '/blogs'] , function () {
    Route::get('/', 'BlogControllers@index');
    Route::get('/{id}', 'BlogControllers@blogDetails');
    Route::get('/{id}/shareBlog/{service}', 'BlogControllers@shareBlog');
});
