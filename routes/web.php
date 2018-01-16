<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','HomeController@index');
Route::resource('expense','ExpenseController',['only'=>['index','store','update','edit']]);
	Route::get('expense/delete/{id}','ExpenseController@destroy');

Route::get('reporte/expense/{id}','ExpenseController@pdf');
Route::resource('detail-expense/{id}','DetailExpenseController',['only'=>['index', 'store']]);
	Route::get('detail-expense/{expense_id}/{id}','DetailExpenseController@edit');
	Route::put('detail-expense/{expense_id}/{id}','DetailExpenseController@update');
	Route::get('detail-expense/delete/{expense_id}/{id}','DetailExpenseController@destroy');

Route::get('business',function(){
	return view('page.empresa.index');
});

Route::get('policies',function(){
	return view('page.policies.index');
});