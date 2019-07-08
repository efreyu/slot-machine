<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::post('/play', 'HomeController@play')->name('play');
Route::post('/convert', 'HomeController@convertBonuses')->name('convert');
