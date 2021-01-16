<?php

/*----------------------------------------------------------
Memberships
----------------------------------------------------------*/
Route::group(['prefix' => '/memberships'] , function () {
    Route::get('/', 'MembershipControllers@index');
    Route::get('/requestMemberShip/{id}', 'MembershipControllers@requestMemberShip');
    Route::get('/features', 'MembershipControllers@features');

});
