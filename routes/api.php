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
Route::apiResource('/item-categories', 'ItemCategoryController');
Route::apiResource('/items', 'ItemController');
Route::apiResource('/brands', 'BrandController');
Route::apiResource('/expenses', 'ExpenseController');
Route::apiResource('/purchases', 'PurchaseController');
Route::apiResource('/sells', 'SellController');
