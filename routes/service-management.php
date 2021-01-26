<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'service_category', 'as' => 'service_category.', 'namespace' => 'Service'], function () {

	Route::get('/', 'ServiceCategoryController@index')->name('index')->middleware('can:Service Category Index');
	Route::get('/create', 'ServiceCategoryController@create')->name('create')->middleware('can:Service Category Create');
	Route::post('/store', 'ServiceCategoryController@store')->name('store')->middleware('can:Service Category Create');
	Route::get('/{service_category}/edit', 'ServiceCategoryController@edit')->name('edit')->middleware('can:Service Category Edit');
	Route::put('/{service_category}/update', 'ServiceCategoryController@update')->name('update')->middleware('can:Service Category Edit');
	Route::delete('/{service_category}/delete', 'ServiceCategoryController@destroy')->name('destroy')->middleware('can:Service Category Delete');
	
	Route::post('/getDetail', 'ServiceCategoryController@getDetail')->name('getDetail');
	Route::post('/getSelectData', 'ServiceCategoryController@getSelectData')->name('getSelectData');
	Route::post('/storeServiceCategory', 'ServiceCategoryController@storeServiceCategory')->name('storeServiceCategory')->middleware('can:Service Category Create');
	Route::get('/import', 'ServiceCategoryController@import')->name('import')->middleware('can:Service Category Create');
	Route::post('/getServiceCategoriesDB2nd', 'ServiceCategoryController@getServiceCategoriesDB2nd')->name('getServiceCategoriesDB2nd')->middleware('can:Service Category Create');
	Route::post('/store_import', 'ServiceCategoryController@store_import')->name('store_import')->middleware('can:Service Category Create');

});


Route::group(['prefix' => 'service', 'as' => 'service.', 'namespace' => 'Service'], function () {

	Route::get('/', 'ServiceController@index')->name('index')->middleware('can:Service Index');
	Route::get('/create', 'ServiceController@create')->name('create')->middleware('can:Service Create');
	Route::post('/store', 'ServiceController@store')->name('store')->middleware('can:Service Create');
	Route::get('/{service}/edit', 'ServiceController@edit')->name('edit')->middleware('can:Service Edit');
	Route::put('/{service}/update', 'ServiceController@update')->name('update')->middleware('can:Service Edit');
	Route::get('/edit_order', 'ServiceController@edit_order')->name('edit_order')->middleware('can:Service Edit');
	Route::put('/update_order', 'ServiceController@update_order')->name('update_order')->middleware('can:Service Edit');
	Route::delete('/{service}/delete', 'ServiceController@destroy')->name('destroy')->middleware('can:Service Delete');

	Route::post('/getDetail', 'ServiceController@getDetail')->name('getDetail');
	Route::post('/getSelectData', 'ServiceController@getSelectData')->name('getSelectData');
	Route::post('/storeService', 'ServiceController@storeService')->name('storeService')->middleware('can:Service Create');
	Route::get('/import', 'ServiceController@import')->name('import')->middleware('can:Service Create');
	Route::post('/getServicesDB2nd', 'ServiceController@getServicesDB2nd')->name('getServicesDB2nd')->middleware('can:Service Create');
	Route::post('/store_import', 'ServiceController@store_import')->name('store_import')->middleware('can:Service Create');

});


