<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DashboardController@indexAction');
Route::get('/customers', 'CustomersController@indexAction');
Route::match(
        ['get', 'post'],
        '/customers/new',
        'CustomersController@newOrEditAction'
        );
Route::match(
        ['get', 'post'],
        '/customers/edit/{id}',
        'CustomersController@newOrEditAction'
        );
Route::get('/orders', 'OrdersController@indexAction');
Route::match(['get', 'post'], '/orders/new', 'OrdersController@newAction');
Route::get('/orders/view/{id}', 'OrdersController@viewAction');
Route::get('/invoices', 'InvoicesController@indexAction');
Route::get('/invoices/view/{id}', 'InvoicesController@viewAction');
Route::get('/invoices/new', 'InvoicesController@newAction');
Route::post('/invoices/generate', 'InvoicesController@generateAction');