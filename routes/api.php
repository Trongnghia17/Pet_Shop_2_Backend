<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\AlbumController;
use App\Http\Controllers\API\SubscriberController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//dang ky
Route::post('register', [AuthController::class, 'register']);
// dang nhap
Route::post('login', [AuthController::class, 'login']);

Route::controller(CategoryController::class)->group(function () {
    Route::get('get-all-category', 'getAllCategory');
});
// Album
Route::controller(AlbumController::class)->group(function () {
    Route::get('getAlbumPet', 'index');
    Route::post('store-albumPet', 'store');
});
// subscribers
Route::controller(SubscriberController::class)->group(function () {
    Route::post('subscribers', 'store');
});
// Cart
Route::controller(CartController::class)->group(function () {
    Route::post('add-to-cart', 'addToCart');
    Route::get('cart', 'viewCart');
    Route::put('cart-updateQuantity/{cart_id}/{scope}', 'updateQuantity');
    Route::delete('delete-cartItem/{cart_id}', 'deleteCartItem');
});

Route::middleware('auth:sanctum', 'isAPIAdmin')->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('view-dashboard', 'index');
    });
    Route::get('/checkingAuthenticated', function () {
        return response()->json(['message' => 'Bạn đã đăng nhập', 'status' => 200], 200);
    });
    // group controller
    // Route::controller(Controlldername::class)->group(function () {
    //     Route::post('store-entity', 'store');
    // });
    // Orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('admin/orders', 'index');
        Route::get('admin/view-order/{id}', 'viewOrder');
    });
    // Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('view-category', 'index');
        Route::post('store-category', 'store');
        Route::get('edit-category/{id}', 'edit');
        Route::put('update-category/{id}', 'update');
        Route::delete('delete-category/{id}', 'destroy');
        Route::get('all-category', 'allcategory');
    });
    // Product
    Route::controller(ProductController::class)->group(function () {
        Route::post('store-product', 'store');
        Route::get('view-product', 'index');
        Route::get('edit-product/{id}', 'edit');
        Route::put('update-product/{id}', 'update');
        Route::delete('delete-product/{id}', 'destroy');
    });
    // View Comment in Admin
    Route::controller(CommentController::class)->group(function () {
        Route::get('view-comment', 'index');
        Route::delete('delete-comment/{id}', 'destroy');
    });
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('logout', [AuthController::class, 'logout']);
});

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
 });
