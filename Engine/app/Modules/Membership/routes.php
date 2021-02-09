<?php

/*----------------------------------------------------------
Memberships
----------------------------------------------------------*/
Route::group(['prefix' => '/memberships'] , function () {
    Route::get('/', 'MembershipControllers@index');
    Route::get('/requestMemberShip/{id}', 'MembershipControllers@requestMemberShip');
    Route::post('/requestMemberShip/{id}', 'MembershipControllers@postRequestMemberShip');
    Route::get('/features/{id}', 'MembershipControllers@features');
    Route::get('/payment', 'MembershipControllers@payment');
    Route::post('/payment', 'MembershipControllers@postPayment');
    Route::get('/delayedPayment/{id}', 'MembershipControllers@delayedPayment');
    Route::get('/activate/{id}', 'MembershipControllers@activate');

});
