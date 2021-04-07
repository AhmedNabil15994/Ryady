<?php

/*----------------------------------------------------------
Memberships
----------------------------------------------------------*/
Route::group(['prefix' => '/memberships'] , function () {
    Route::get('/', 'MembershipControllers@index');
    Route::get('/requestMemberShip/{id}', 'MembershipControllers@requestMemberShip');
    Route::post('/requestMemberShip/{id}', 'MembershipControllers@postRequestMemberShip');

    Route::get('/activate', 'MembershipControllers@activate');

    Route::post('/pushInvoice/{id}/{type}','MembershipControllers@pushInvoice');
});
