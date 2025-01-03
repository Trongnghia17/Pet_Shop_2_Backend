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
use App\Http\Controllers\API\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FrontendController;

//dang ky
Route::post('register', [AuthController::class, 'register']);
// dang nhap
Route::post('login', [AuthController::class, 'login']);
Route::post('get-qr-code', [AuthController::class, 'getQrCode']);

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
    Route::put('cart-updateQuantity/{cart_id}', 'updateQuantity');
    Route::delete('delete-cartItem/{cart_id}', 'deleteCartItem');
});
// checkout
Route::controller(CheckoutController::class)->group(function () {
    Route::post('place-order', 'placeOrder');
    Route::post('validate-order', 'validateOrder');
});
// Frontend
Route::controller(FrontendController::class)->group(function () {
    Route::get('viewHomePage', 'index');
    Route::get('getCategory', 'category');
    Route::get('fetchproducts/{slug}', 'product');
    Route::get('viewproductdetail/{category_slug}/{product_slug}', 'viewproduct');
});
// Comment
Route::controller(CommentController::class)->group(function () {
    Route::post('comments/{slug}', 'store'); // Add comment
    Route::get('comments', 'index'); // View all comments
    Route::delete('comments/{id}', 'destroy'); // Delete comment
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
