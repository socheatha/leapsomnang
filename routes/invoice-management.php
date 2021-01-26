<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'exchange_rate', 'as' => 'exchange_rate.', 'namespace' => 'Invoice'], function () {

	Route::get('/', 'ExchangeRateController@index')->name('index')->middleware('can:Exchange Rate Index');
	Route::get('/{month}/month', 'ExchangeRateController@month')->name('month')->middleware('can:Exchange Rate Index');
	Route::get('/{month}/create', 'ExchangeRateController@create')->name('create')->middleware('can:Exchange Rate Create');
	Route::post('/{month}/store', 'ExchangeRateController@store')->name('store')->middleware('can:Exchange Rate Create');
	Route::get('/{month}/{exchange_rate}/edit', 'ExchangeRateController@edit')->name('edit')->middleware('can:Exchange Rate Edit');
	Route::put('/{month}/{exchange_rate}/update', 'ExchangeRateController@update')->name('update')->middleware('can:Exchange Rate Edit');
	Route::delete('/{month}/{exchange_rate}/delete', 'ExchangeRateController@destroy')->name('destroy')->middleware('can:Exchange Rate Delete');

	Route::get('/{month}/import', 'ExchangeRateController@import')->name('import')->middleware('can:Exchange Rate Create');
	Route::post('/{month}/getExchangeRatesDB2nd', 'ExchangeRateController@getExchangeRatesDB2nd')->name('getExchangeRatesDB2nd')->middleware('can:Exchange Rate Create');
	Route::post('/{month}/store_import', 'ExchangeRateController@store_import')->name('store_import')->middleware('can:Exchange Rate Create');

	Route::post('/getMonthlyExchangeRate', 'ExchangeRateController@getMonthlyExchangeRate')->name('getMonthlyExchangeRate');
	Route::post('/getDailyExchangeRate', 'ExchangeRateController@getDailyExchangeRate')->name('getDailyExchangeRate');

});


Route::group(['prefix' => 'invoice', 'as' => 'invoice.', 'namespace' => 'Invoice'], function () {

	Route::get('/', 'InvoiceController@index')->name('index')->middleware('can:Invoice Index');
	Route::get('/create', 'InvoiceController@create')->name('create')->middleware('can:Invoice Create');
	Route::post('/store', 'InvoiceController@store')->name('store')->middleware('can:Invoice Create');
	Route::get('/{invoice}/edit', 'InvoiceController@edit')->name('edit')->middleware('can:Invoice Edit');
	Route::put('/{invoice}/update', 'InvoiceController@update')->name('update')->middleware('can:Invoice Edit');
	Route::delete('/{invoice}/delete', 'InvoiceController@destroy')->name('destroy')->middleware('can:Invoice Delete');
	Route::get('/{invoice}/print', 'InvoiceController@print')->name('print');
	Route::post('/{invoice}/status', 'InvoiceController@status')->name('status');
	Route::get('/import', 'InvoiceController@import')->name('import')->middleware('can:Invoice Create');
	Route::post('/getInvoicesDB2nd', 'InvoiceController@getInvoicesDB2nd')->name('getInvoicesDB2nd')->middleware('can:Invoice Create');
	Route::post('/store_import', 'InvoiceController@store_import')->name('store_import')->middleware('can:Invoice Create');
	
	Route::put('/{invoice}/save_order', 'InvoiceController@save_order')->name('save_order');
	Route::post('/getDatatable', 'InvoiceController@getDatatable')->name('getDatatable');
	Route::post('/getInvoicePreview', 'InvoiceController@getInvoicePreview')->name('getInvoicePreview');
	Route::post('/getDetail', 'InvoiceController@getDetail')->name('getDetail');
	Route::post('/getInvoiceSelect', 'InvoiceController@getInvoiceSelect')->name('getInvoiceSelect');
	
	Route::group(['prefix' => 'invoice_detail', 'as' => 'invoice_detail.'], function () {
		Route::post('/store', 'InvoiceController@invoiceDetailStore')->name('store');
		Route::post('/update', 'InvoiceController@invoiceDetailUpdate')->name('update');
		Route::delete('/{invoice_detail}/delete', 'InvoiceController@invoice_detail_destroy')->name('destroy');
		Route::PUT('/{invoice}/save_order', 'InvoiceController@save_order')->name('save_order');
		Route::post('/getItemDetail', 'InvoiceController@getItemDetail')->name('getDetail');
	});

});


Route::group(['prefix' => 'receive_voucher', 'as' => 'receive_voucher.', 'namespace' => 'Invoice'], function () {

	Route::get('/', 'ReceiveVoucherController@index')->name('index')->middleware('can:Receive Voucher Index');
	Route::get('/{month}/month', 'ReceiveVoucherController@month')->name('month')->middleware('can:Receive Voucher Index');
	Route::get('/{month}/create', 'ReceiveVoucherController@create')->name('create')->middleware('can:Receive Voucher Create');
	Route::post('/{month}/store', 'ReceiveVoucherController@store')->name('store')->middleware('can:Receive Voucher Create');
	Route::get('/{month}/{receive_voucher}/edit', 'ReceiveVoucherController@edit')->name('edit')->middleware('can:Receive Voucher Edit');
	Route::put('/{month}/{receive_voucher}/update', 'ReceiveVoucherController@update')->name('update')->middleware('can:Receive Voucher Edit');
	Route::delete('/{month}/{receive_voucher}/delete', 'ReceiveVoucherController@destroy')->name('destroy')->middleware('can:Receive Voucher Delete');
	Route::get('/{month}/{receive_voucher}/print', 'ReceiveVoucherController@print')->name('print');
	Route::get('/{month}/print_all', 'ReceiveVoucherController@print_all')->name('print_all');
	
	Route::post('/getDatatable', 'ReceiveVoucherController@getDatatable')->name('getDatatable');
	Route::post('/getPreview', 'ReceiveVoucherController@getPreview')->name('getPreview');
	Route::post('/getPreviewAll', 'ReceiveVoucherController@getPreviewAll')->name('getPreviewAll');
	Route::post('/getAmountInWord', 'ReceiveVoucherController@getAmountInWord')->name('getAmountInWord');

});


Route::group(['prefix' => 'cash_book', 'as' => 'cash_book.', 'namespace' => 'CashBook'], function () {

	Route::get('/', 'CashBookController@index')->name('index')->middleware('can:Cash Book Index');
	Route::get('/print', 'CashBookController@print')->name('print');
	Route::post('/getDataInMonth', 'CashBookController@getDataInMonth')->name('getDataInMonth');

});






