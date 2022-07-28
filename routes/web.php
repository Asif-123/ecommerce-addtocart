<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\products\ProductController;
use App\Http\Controllers\PaymentController;
use App\Models\products\ProductModel;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/get-product/{id}', [ProductController::class, 'getproduct']);
Route::get('/product/list-product', [ProductController::class, 'listProduct']);
//Route::get('/payment/failed', [ProductController::class, 'failure']); 
Route::middleware(['auth'])->group(function(){
    Route::post('/add-to-cart', [ProductController::class, 'addToCart']);
    Route::get('/feature-product', [ProductController::class, 'featureProd']);
    Route::post('/products/add-products', [ProductController::class, 'AddProduct']);
    Route::get('/view-cart', [ProductController::class, 'ViewCart']);
    Route::post('/delete-cart-product', [ProductController::class, 'DeleteItem']);
    Route::get('/cart-count', [ProductController::class, 'CartCount']);
    Route::post('/cart-quantity', [CartController::class, 'increamentItem']);
    Route::post('/cart-quantity-decreament', [CartController::class, 'DecreamentItem']);
    Route::post('/payment', [PaymentController::class, 'pay']);
    Route::post('/payment/success', [PaymentController::class, 'success']);
    Route::post('/product-quantity-incr', [CartController::class, 'ProductQuantityIncreament']);
    Route::post('/product-quantity-decreament', [CartController::class, 'ProductQuantityDecreament']);
    Route::post('/product/item-quantity', [CartController::class, 'itemQuantity']);   
    Route::get('/category/index', [CategoryController::class, 'index']);   // this route created for view category
    Route::post('/category/add', [CategoryController::class, 'add']);   // this route created for add category
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
