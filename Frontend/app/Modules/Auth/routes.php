<?php

/*----------------------------------------------------------
User Auth
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::post('/login', 'AuthControllers@doLogin')->name('doLogin');
    Route::get('/logout', 'AuthControllers@logout');
});