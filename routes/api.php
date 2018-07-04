<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('signup', 'AuthController@signup');
    Route::post('user', 'AuthController@user');

});
// Employee
Route::get('/employees/{text}', 'EmployeeController@employByNameOrCode');
Route::get('/employees', 'EmployeeController@index');
// Expense Invoice
Route::get('/expenses/invoices/{id}', 'ExpenseInvoiceController@show');
Route::get('/expenses/invoices', 'ExpenseInvoiceController@index');
Route::post('/expenses/invoices', 'ExpenseInvoiceController@store');
// Expense routes
Route::apiResource('/expense-categories', 'ExpenseCategoryController');
Route::apiResource('/expenses', 'ExpenseCategoryController');
Route::apiResource('/expenses', 'ExpenseController');
// Item Routes
Route::get('/item-categories/rawmaterials', 'ItemCategoryController@rawmaterials');
Route::get('/item-categories/products', 'ItemCategoryController@products');
Route::apiResource('/item-categories', 'ItemCategoryController');
Route::get('/items/code/{code}', 'ItemController@getWithCode');
Route::apiResource('/items', 'ItemController');
// Brand routes
Route::apiResource('/brands', 'BrandController');
// Purchase routes
Route::get('/purchases/invoice/{id}', 'PurchaseInvoiceController@show');
Route::post('/purchases/invoice', 'PurchaseInvoiceController@store');
Route::get('/purchases/invoice', 'PurchaseInvoiceController@index');
Route::apiResource('/purchases', 'PurchaseController');
// Sell Invoice routes
Route::get('/sells/invoices/{id}', 'SellInvoiceController@show');
Route::get('/sells/invoices', 'SellInvoiceController@index');
Route::post('/sells/invoices', 'SellInvoiceController@store');
// Sell routes
Route::apiResource('/sells', 'SellController');
// Supplier Routes
Route::get('/suppliers/by-name/{name}', 'SupplierController@getSupplierByName');
Route::apiResource('/suppliers', 'SupplierController');
// File routes
Route::post('/upload-files', 'FileUploadController@store');
Route::delete('/delete-files/{id}/{table}', 'FileUploadController@delete');

// Customer routes
ROute::get('/customers/contact/{contact}', 'CustomerController@customerByContact');
