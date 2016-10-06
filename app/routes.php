<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//App bindings for repositories
App::bind('StockItemInterface', 'StockItemRepository');
App::bind('StocktakeInterface', 'StocktakeRepository');
App::bind('TransactionInterface', 'TransactionRepository');
App::bind('LineItemInterface', 'LineItemRepository');

Route::get('login', array('uses' => 'AuthController@login'));
Route::post('login', function(){
	if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
	{
    	return Redirect::intended('/');
	}
	return Redirect::to('login')->with('message', 'Wrong password/email combo mofo!');
});
Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('login');
});	

Route::group(array('before' => 'auth'), function()
{
	//Home page route
	Route::get('/', array('uses' => 'Stock_itemsController@index'));

	//Global Search Routes
	Route::post('search', array('uses' => 'SearchController@show'));
	Route::get('search', array('uses' => 'SearchController@index'));

	//Transaction Routes
	Route::post('transaction/add', array('uses' => 'TransactionsController@store'));
	Route::get('transaction/{id}', array('uses' => 'TransactionsController@show', 'as' => 'transaction.show'));
	Route::get('transactions', array('uses' => 'TransactionsController@index', 'as' => 'transaction.index'));

	//Stocktake Routes
	Route::get('stocktake', array('uses' => 'StocktakeController@index', 'as' => 'stocktake.index'));
	Route::post('stocktake', array('uses' => 'StocktakeController@store'));
	Route::post('stocktake_update/{id}', array('uses' => 'StocktakeController@stocktake_update'));
	Route::get('stocktake/create', array('uses' => 'StocktakeController@create', 'as' => 'stocktake.create'));
	Route::get('stocktake/update/{id}', array('uses' => 'StocktakeController@update', 'as' => 'stocktake.update'));

	Route::get('stocktake/edit/{id}', array('uses' => 'StocktakeController@edit', 'as' => 'stocktake.edit'));
	Route::get('stocktake/report/{id}', array('uses' => 'StocktakeController@report', 'as' => 'stocktake.report'));
	Route::get('stocktake/reports', array('uses' => 'StocktakeController@allReports'));

	//Sales Routes
	Route::get('sales', array('as' =>'sales', 'uses' => 'SalesController@index'));
	Route::post('sales', array('uses' => 'SalesController@store'));
	Route::get('sales/delete', array('as' =>'sales.delete', 'uses' => 'SalesController@destroyAll'));
	Route::get('sales/delete/{id}', array('as' =>'sales.deleteitem', 'uses' => 'SalesController@delete'));
	Route::get('sales/reports', array('uses' => 'SalesController@reports', 'as' => 'sales.reports'));
	Route::post('sales/reports', array('uses' => 'SalesController@getReports'));

	Route::get('monthly/reports', array('uses' => 'SalesController@MonthlyReports'));
	Route::post('monthly/reports', array('uses' => 'SalesController@postMonthlyReports', 'as' => 'monthly.reports'));

	Route::resource('stock_items', 'Stock_itemsController');
	Route::post('stock_items/bulk-update', array('uses' => 'Stock_itemsController@bulkUpdate'));
	Route::get('stock_items/create-barcode/{id}', array(
		'as' => 'stock_items.barcode', 'uses' => 'Stock_itemsController@generateBarcode'));
	Route::get('stock_items/status/{status}', array('uses' => 'Stock_itemsController@getStatus'));
});
