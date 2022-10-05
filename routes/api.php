<?php

use App\Modules\Address\Controllers\UserAddressController;
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Cart\Controllers\CartController;
use App\Modules\Category\Controllers\CategoryController;
use App\Modules\Coupon\Controllers\CouponController;
use App\Modules\Customers\Controllers\CustomersController;
use App\Modules\NestedSubCategory\Controllers\NestedSubCategoryController;
use App\Modules\Order\Controllers\OrderController;
use App\Modules\Pictures\Controllers\PictureController;
use App\Modules\Product\Controllers\ProductController;
use App\Modules\Product\Controllers\ProductDiseaseController;
use App\Modules\SubCategory\Controllers\SubCategoryController;
use App\Modules\WishList\Controllers\WishListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
Route::get('/auth/user_type', [AuthController::class, 'user_type'])->middleware('auth:sanctum');
Route::get('/auth/logout', [AuthController::class, 'logout']);

// ADMIN ROUTES
Route::prefix('category')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [CategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [CategoryController::class, 'store'])->withoutMiddleware('auth:sanctum');
    Route::get('/{category_id}', [CategoryController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{category_id}', [CategoryController::class, 'update']);
    Route::delete('/{category_id}', [CategoryController::class, 'destroy']);
});

Route::prefix('nested-sub-category')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [NestedSubCategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [NestedSubCategoryController::class, 'store']);
    Route::get('/{nested_sub_category_id}', [NestedSubCategoryController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::post('/sub-category/{sub_category_id}', [NestedSubCategoryController::class, 'showSubCategory']);
    Route::patch('/{sub_category_id}', [NestedSubCategoryController::class, 'update']);
    Route::delete('/{sub_category_id}', [NestedSubCategoryController::class, 'destroy']);
});

Route::prefix('sub-category')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [SubCategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [SubCategoryController::class, 'store']);
    Route::get('/{sub_category_id}', [SubCategoryController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::post('/category/{category_id}', [SubCategoryController::class, 'showSubCategory']);
    Route::patch('/{sub_category_id}', [SubCategoryController::class, 'update']);
    Route::delete('/{sub_category_id}', [SubCategoryController::class, 'destroy']);
});

Route::prefix('disease')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [ProductDiseaseController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [ProductDiseaseController::class, 'store']);
    Route::get('/{product_disease_id}', [ProductDiseaseController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{product_disease_id}', [ProductDiseaseController::class, 'update']);
    Route::delete('/{product_disease_id}', [ProductDiseaseController::class, 'destroy']);
});

Route::prefix('product')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [ProductController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{product_id}', [ProductController::class, 'show'])->withoutMiddleware('auth:sanctum');    
    Route::get('/product-search/{category_id?}/{sub_category_id?}/{inner_category_id?}', [ProductController::class, 'showProduct'])->withoutMiddleware('auth:sanctum');
    Route::post('/product-filter', [ProductController::class, 'filterProduct'])->withoutMiddleware('auth:sanctum');    
    Route::patch('/{product_id}', [ProductController::class, 'update']);
    Route::delete('/{product_id}', [ProductController::class, 'destroy']);
    Route::post('/{name}', [ProductController::class, 'showProductByName'])->withoutMiddleware('auth:sanctum');

    Route::prefix('pictures')->middleware('auth:sanctum')->group(function(){
        Route::post('/product-pics/{product_id}', [PictureController::class, 'productPicture']);
        Route::post('/category-pics/{category_id}', [PictureController::class, 'categoryPicture']);
    });
});
Route::prefix('customers')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [CustomersController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [CustomersController::class, 'store']);
      
    Route::patch('/{user_id}', [CustomersController::class, 'update']);
    Route::delete('/{user_id}', [CustomersController::class, 'destroy']);
});

// CLIENT ROUTES
Route::prefix('wish-list')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [WishListController::class, 'index']);
    Route::get('/{wish_list_id}', [WishListController::class, 'show']);
    Route::patch('/{wish_list_id}', [WishListController::class, 'update']);
    Route::get('/remove/{wish_list_id}', [WishListController::class, 'remove']);
    Route::post('/', [WishListController::class, 'store']);
});

Route::prefix('cart')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [CartController::class, 'getCarts']);
    Route::get('/{cart_id}', [CartController::class, 'getSingleCart']);
    Route::patch('/{cart_id}', [CartController::class, 'updateCart']);
    Route::patch('/update-quantity/{cart_id}', [CartController::class, 'incrementQuantity']);
    Route::get('/remove/{cart_id}', [CartController::class, 'removeCart']);
    Route::post('/', [CartController::class, 'addToCart']);
    Route::post('/clear-cart', [CartController::class, 'clearCart']);
});

Route::prefix('user-address')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [UserAddressController::class, 'getUserAddress']);
    Route::get('/{user_address_id}', [UserAddressController::class, 'getSingleUserAddress']);
    Route::patch('/{user_address_id}', [UserAddressController::class, 'updateUserAddress']);
    Route::patch('/make-default/{user_address_id}', [UserAddressController::class, 'defaultAddress']);
    Route::get('/remove/{user_address_id}', [UserAddressController::class, 'removeUserAddress']);
    Route::post('/', [UserAddressController::class, 'addUserAddress']);
});

Route::prefix('order')->middleware('auth:sanctum')->group(function(){
    Route::get('/get-order/{order_no}', [OrderController::class, 'getOrder']);
    Route::get('/place-order', [OrderController::class, 'placeOrder']);
    Route::get('/get-user-order', [OrderController::class, 'getAllUserOrders']);
    Route::post('/', [UserAddressController::class, 'addUserAddress']);
    Route::post('/', [UserAddressController::class, 'addUserAddress']);


    Route::prefix('admin')->group(function(){
        Route::post('/get-all-order', [OrderController::class, 'getAllOrder']);
        Route::post('/change-status', [OrderController::class, 'change_status']);
        
    });
});

Route::prefix('coupon')->middleware('auth:sanctum')->group(function(){
    Route::get('/get-coupon/{coupon}', [CouponController::class, 'getCoupon']);
    Route::post('/all', [CouponController::class, 'getAllCoupon']);
    Route::post('/generate-Coupon', [CouponController::class, 'generateCoupon']);
    Route::get('/attach-coupon-to-user/{id}/{user_id}', [CouponController::class, 'attatchToUser']);
    Route::get('/get-user-order', [OrderController::class, 'getAllUserOrders']);


   
});