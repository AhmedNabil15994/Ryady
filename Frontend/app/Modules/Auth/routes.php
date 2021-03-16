<?php

/*----------------------------------------------------------
User Auth
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    Route::post('/login', 'AuthControllers@doLogin')->name('doLogin');
    Route::get('/logout', 'AuthControllers@logout');
    Route::post('/sendResetCode', 'AuthControllers@sendResetCode');
    Route::post('/checkCode', 'AuthControllers@checkCode');
    Route::post('/resetPassword', 'AuthControllers@resetPassword');
});