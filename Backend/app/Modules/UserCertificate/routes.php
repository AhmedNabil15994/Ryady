<?php

/*----------------------------------------------------------
User Certificates
----------------------------------------------------------*/
Route::group(['prefix' => '/userCertificates'] , function () {
    Route::get('/', 'UserCertificatesControllers@index');
    Route::get('/download/{id}', 'UserCertificatesControllers@download');
});

