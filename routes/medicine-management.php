<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'medicine', 'as' => 'medicine.'], function () {

	Route::get('/', 'MedicineController@index')->name('index')->middleware('can:Medicine Index');
	Route::get('/create', 'MedicineController@create')->name('create')->middleware('can:Medicine Create');
	Route::post('/store', 'MedicineController@store')->name('store')->middleware('can:Medicine Create');
	Route::get('/{medicine}/edit', 'MedicineController@edit')->name('edit')->middleware('can:Medicine Edit');
	Route::put('/{medicine}/update', 'MedicineController@update')->name('update')->middleware('can:Medicine Edit');
	Route::get('/edit_order', 'MedicineController@edit_order')->name('edit_order')->middleware('can:Medicine Edit');
	Route::put('/update_order', 'MedicineController@update_order')->name('update_order')->middleware('can:Medicine Edit');
	Route::delete('/{medicine}/delete', 'MedicineController@destroy')->name('destroy')->middleware('can:Medicine Delete');

});


