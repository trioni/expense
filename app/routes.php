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

Route::get('/', function()
{
	return View::make('layouts.master');
});


Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::get('expenses/filter', 'ExpenseController@filter');
Route::get('expenses/delete/{id}', 'ExpenseController@delete');
Route::get('expenses/trash/{id}', 'ExpenseController@trash');
Route::get('expenses/restore/{id}', 'ExpenseController@restore');
Route::resource('sessions','SessionsController', ['only' => ['store','destroy','create']]);
Route::resource('expenses','ExpenseController');
Route::get('app','AppBootController@index');

Route::group(array('before' => 'auth'), function()
{
    Route::get('/', 'ExpenseController@index');
    Route::get('expenses/create', 'ExpenseController@create');
});


