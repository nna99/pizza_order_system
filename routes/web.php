<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// direct page
Route::middleware('admin_auth')->group(function() {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});


Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');


    Route::middleware('admin_auth')->group(function () {

         // direct list page
        Route::prefix('category')->group(function () {
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/page/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
            Route::post('update',[CategoryController::class,'update'])->name('category#update');
        });

        // admin
        // password
        Route::prefix('admin')->group(function () {
            Route::get('password/changePage',[AdminController::class,'passwordChangePage'])->name('admin#passwordChangePage');
            Route::post('change',[AdminController::class,'passwordChange'])->name('admin#passwordChange');

            // account info
            Route::get('details',[AdminController::class,'details'])->name('admin#account');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            // admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/{id}',[AdminController::class,'change'])->name('admin#change');
            // ajax
            Route::get('ajax/changeRole',[AdminController::class,'ajaxChangeRole'])->name('ajax#changeRole');
            // user list
            Route::get('user/list',[AdminController::class,'userList'])->name('admin#userList');
            Route::get('user/change/role',[AdminController::class,'userChangeRole'])->name('ajax#userChangeRole');
            Route::get('user/delete/{id}',[AdminController::class,'userDelete'])->name('admin#userDelete');

        });

        // product
        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            Route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('product#update');
        });

        // order
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'list'])->name('order#list');
            Route::get('orderStatus',[OrderController::class,'orderStatus'])->name('order#orderStatus');
            // orderInfo
            Route::get('orderList/{orderCode}',[OrderController::class,'orderList'])->name('order#orderList');
            // ajax
            Route::get('ajax/change/status',[OrderController::class,'changeStatus'])->name('ajax#changeStatus');
        });

        // contact
        Route::get('contact/page',[ContactController::class,'contactPage'])->name('admin#contactPage');

    });





    //user
    Route::group(['prefix' => 'user','middleware' => 'user_auth'],function(){

            Route::get('homePage',[UserController::class,'home'])->name('user#home');
            Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
            Route::get('home/rating',[RatingController::class,'rating'])->name('user#rating');
            Route::get('home/rating/show',[RatingController::class,'ratingShow'])->name('user#ratingShow');
            Route::get('ajax/rating/show',[RatingController::class,'ajaxRatingShow'])->name('ajax#ratingShow');

        Route::prefix('pizza')->group(function(){
            Route::get('list/{id}',[UserController::class,'pizzaList'])->name('user#pizzaList');

        });

        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            Route::get('history',[UserController::class,'history'])->name('user#cartHistory');

        });

        Route::prefix('account')->group(function () {
            // password change
            Route::get('changePasswordPage',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'change'])->name('user#changePassword');
            // account profile update
            Route::get('profile',[UserController::class,'profile'])->name('user#profile');
            Route::post('edit/profile/{id}',[UserController::class,'edit'])->name('user#edit');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('delete',[AjaxController::class,'deleteCart'])->name('ajax#deleteCart');
            Route::get('view/count',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
        });

        Route::prefix('contact')->group(function () {
            Route::get('page',[UserController::class,'contactPage'])->name('user#contactPage');
            Route::post('message',[ContactController::class,'sendMessage'])->name('user#contactMessage');
        });

    });


});


