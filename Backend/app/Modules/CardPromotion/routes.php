<?php

/*----------------------------------------------------------
Card Promotions
----------------------------------------------------------*/
Route::group(['prefix' => '/cardPromotions'] , function () {
    Route::get('/', 'CardPromotionsControllers@index');
    Route::post('/fastEdit', 'CardPromotionsControllers@fastEdit');
    Route::post('/delete', 'CardPromotionsControllers@softDelete');
    Route::get('/delete/{id}', 'CardPromotionsControllers@delete');
    Route::get('/charts', 'CardPromotionsControllers@charts');
});

