<?php

use Illuminate\Support\Facades\Route;


// Language switch Route
Route::get('locale/{locale}','LanguageController@swap')->name('locale');


Auth::routes();

Route::get('/no-approval', 'HomeController@approval')->name('approval')->middleware('auth');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    require __DIR__.'/user-management.php';

    require __DIR__.'/patient-management.php';
    
    require __DIR__.'/service-management.php';
    
    require __DIR__.'/location-management.php';

});


