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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/expense-categories', 'ExpenseCategoryController');
Route::apiResource('/expenses', 'ExpenseCategoryController');
Route::get('/item-categories/rawmaterials', 'ItemCategoryController@rawmaterials');
Route::get('/item-categories/products', 'ItemCategoryController@products');
Route::apiResource('/item-categories', 'ItemCategoryController');
Route::get('/items/code/{code}', 'ItemController@getWithCode');
Route::apiResource('/items', 'ItemController');
Route::apiResource('/brands', 'BrandController');
Route::apiResource('/expenses', 'ExpenseController');
Route::apiResource('/purchases', 'PurchaseController');
Route::apiResource('/sells', 'SellController');
Route::get('/suppliers/by-name/{name}', 'SupplierController@getSupplierByName');
Route::apiResource('/suppliers', 'SupplierController');
Route::post('/upload-files', 'FileUploadController@store');
