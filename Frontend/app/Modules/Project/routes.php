<?php

/*----------------------------------------------------------
Projects
----------------------------------------------------------*/
Route::group(['prefix' => '/projects'] , function () {
    Route::get('/', 'ProjectControllers@index');
    Route::get('/{id}', 'ProjectControllers@project');
});
