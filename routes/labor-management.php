<?php

use Illuminate\Support\Facades\Route;


// Route::group(['prefix' => 'service', 'as' => 'service.'], function () {

// 	Route::get('/', 'ServiceController@index')->name('index')->middleware('can:Service Index');
// 	Route::get('/create', 'ServiceController@create')->name('create')->middleware('can:Service Create');
// 	Route::post('/store', 'ServiceController@store')->name('store')->middleware('can:Service Create');
// 	Route::get('/{service}/edit', 'ServiceController@edit')->name('edit')->middleware('can:Service Edit');
// 	Route::put('/{service}/update', 'ServiceController@update')->name('update')->middleware('can:Service Edit');
// 	Route::delete('/{service}/delete', 'ServiceController@destroy')->name('destroy')->middleware('can:Service Delete');

// 	Route::post('/getDetail', 'ServiceController@getDetail')->name('getDetail');
// 	Route::post('/createService', 'ServiceController@createService')->name('createService');
// 	Route::post('/reloadSelectService', 'ServiceController@reloadSelectService')->name('reloadSelectService');

// });

Route::group(['prefix' => 'labor', 'as' => 'labor.', 'namespace' => 'Labor'], function () {

	Route::get('/', 'LaborController@index')->name('index')->middleware('can:Labor Index');
	Route::get('/create', 'LaborController@create')->name('create')->middleware('can:Labor Create');
	Route::post('/store', 'LaborController@store')->name('store')->middleware('can:Labor Create');
	Route::get('/{labor}/edit', 'LaborController@edit')->name('edit')->middleware('can:Labor Edit');
	Route::put('/{labor}/update', 'LaborController@update')->name('update')->middleware('can:Labor Edit');
	Route::delete('/{labor}/delete', 'LaborController@destroy')->name('destroy')->middleware('can:Labor Delete');
	Route::get('/{labor}/print', 'LaborController@print')->name('print');
	Route::post('/status', 'LaborController@status')->name('status');
	
	
	Route::put('/{labor}/save_order', 'LaborController@save_order')->name('save_order');
	Route::post('/getDatatable', 'LaborController@getDatatable')->name('getDatatable');
	Route::post('/getLaborPreview', 'LaborController@getLaborPreview')->name('getLaborPreview');
	Route::post('/getDetail', 'LaborController@getDetail')->name('getDetail');
	Route::post('/getLaborSelect', 'LaborController@getLaborSelect')->name('getLaborSelect');
	
	Route::group(['prefix' => 'labor_detail', 'as' => 'labor_detail.'], function () {
		Route::post('/store', 'LaborController@laborDetailStore')->name('store');
		Route::post('/update', 'LaborController@laborDetailUpdate')->name('update');
		Route::delete('/{labor_detail}/delete', 'LaborController@labor_detail_destroy')->name('destroy');
		Route::PUT('/{labor}/save_order', 'LaborController@save_order')->name('save_order');
		Route::post('/getItemDetail', 'LaborController@getItemDetail')->name('getDetail');
		Route::post('/deleteLaborDetail', 'LaborController@deleteLaborDetail')->name('deleteLaborDetail');
	});

});





