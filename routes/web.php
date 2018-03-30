<?php

Route::get('/', 'DefaultController@index');
Route::get('stylesheet','DefaultController@stylesheet');
Route::post('update','DefaultController@update');
Route::get('update','DefaultController@update');


