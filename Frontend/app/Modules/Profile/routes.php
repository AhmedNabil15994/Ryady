<?php

/*----------------------------------------------------------
Profile
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::get('/personalInfo', 'ProfileControllers@profile');
    Route::post('/update', 'ProfileControllers@update');
    Route::post('/addToWallet', 'ProfileControllers@addToWallet');

    Route::get('/', 'ProfileControllers@membership');
    Route::post('/addRequest', 'ProfileControllers@addRequest');
    
    Route::post('/uploadLogo', 'ProfileControllers@uploadLogo');
    Route::post('/upgrade', 'ProfileControllers@upgrade');

    Route::get('/addBlog', 'ProfileControllers@addBlog');
    Route::post('/addBlog', 'ProfileControllers@postBlog');

    Route::get('/download/{id}', 'ProfileControllers@download');

    Route::get('/newProject', 'ProfileControllers@newProject');
    Route::get('/projects', 'ProfileControllers@projects');

    Route::get('/addProject', 'ProfileControllers@addProject');
    Route::post('/addProject', 'ProfileControllers@postAddProject');

    Route::get('/editProject/{id}', 'ProfileControllers@editProject');
    Route::post('/updateProject/{id}', 'ProfileControllers@updateProject');

    Route::get('/newOrder', 'ProfileControllers@newOrder');
    Route::post('/postOrder', 'ProfileControllers@postOrder');

    Route::get('/messages', 'ProfileControllers@messages');
    Route::post('/newMessage', 'ProfileControllers@newMessage');
});
