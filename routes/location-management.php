<?php

use Illuminate\Support\Facades\Route;





Route::group(['prefix' => 'province', 'as' => 'province.', 'namespace' => 'Location'], function () {

	Route::get('/', 'ProvinceController@index')->name('index')->middleware('can:Province Index');
	Route::get('/create', 'ProvinceController@create')->name('create')->middleware('can:Province Create');
	Route::post('/store', 'ProvinceController@store')->name('store')->middleware('can:Province Create');
	Route::get('/{province}/edit', 'ProvinceController@edit')->name('edit')->middleware('can:Province Edit');
	Route::put('/{province}/update', 'ProvinceController@update')->name('update')->middleware('can:Province Edit');
	Route::delete('/{province}/delete', 'ProvinceController@destroy')->name('destroy')->middleware('can:Province Delete');
	
	Route::post('/getSelectDistrict', 'ProvinceController@getSelectDistrict')->name('getSelectDistrict');
});




Route::group(['prefix' => 'district', 'as' => 'district.', 'namespace' => 'Location'], function () {

	Route::get('/', 'DistrictController@index')->name('index')->middleware('can:District Index');
	Route::get('/create', 'DistrictController@create')->name('create')->middleware('can:District Create');
	Route::post('/store', 'DistrictController@store')->name('store')->middleware('can:District Create');
	Route::get('/{district}/edit', 'DistrictController@edit')->name('edit')->middleware('can:District Edit');
	Route::put('/{district}/update', 'DistrictController@update')->name('update')->middleware('can:District Edit');
	Route::delete('/{district}/delete', 'DistrictController@destroy')->name('destroy')->middleware('can:District Delete');

});


