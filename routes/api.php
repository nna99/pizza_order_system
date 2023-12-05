<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'categoryList']);
Route::get('order/list',[RouteController::class,'orderList']);

// Post
Route::post('create/category',[RouteController::class,'createCategory']);
Route::post('create/contact',[RouteController::class,'createContact']);
// delete
Route::post('delete/category',[RouteController::class,'deleteCategory']);
Route::get('delete/category/{id}',[RouteController::class,'deleteCategoryByGet']);
// detail
Route::post('category/detail',[RouteController::class,'categoryDetail']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);
