<?php

/*----------------------------------------------------------
Profile
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::get('/', 'ProfileControllers@profile');
    Route::get('/addProject', 'ProfileControllers@addProject');

});
