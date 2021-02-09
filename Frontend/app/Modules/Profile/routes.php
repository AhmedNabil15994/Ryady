<?php

/*----------------------------------------------------------
Profile
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::get('/', 'ProfileControllers@profile');
    Route::post('/update', 'ProfileControllers@update');

    Route::get('/membership', 'ProfileControllers@membership');
    Route::post('/addRequest', 'ProfileControllers@addRequest');

    Route::post('/uploadLogo', 'ProfileControllers@uploadLogo');
    Route::post('/upgrade', 'ProfileControllers@upgrade');

    Route::get('/addBlog', 'ProfileControllers@addBlog');
    Route::post('/addBlog', 'ProfileControllers@postBlog');

    Route::get('/download/{id}', 'ProfileControllers@download');

    Route::get('/newProject', 'ProfileControllers@newProject');
    Route::get('/addProject', 'ProfileControllers@addProject');
    Route::post('/addProject', 'ProfileControllers@postAddProject');

    Route::get('/newOrder', 'ProfileControllers@newOrder');
    Route::post('/postOrder', 'ProfileControllers@postOrder');

    Route::get('/payment', 'ProfileControllers@payment');
    Route::post('/payment', 'ProfileControllers@postPayment');
});
