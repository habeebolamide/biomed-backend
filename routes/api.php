<?php

use App\Modules\Address\Controllers\UserAddressController;
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Cart\Controllers\CartController;
use App\Modules\Category\Controllers\CategoryController;
use App\Modules\NestedSubCategory\Controllers\NestedSubCategoryController;
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


Route::prefix('category')->middleware('auth:sanctum')->group(function(){
    Route::post('/all', [CategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [CategoryController::class, 'store']);
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
    Route::post('/{name}', [ProductController::class, 'showProductByName'])->withoutMiddleware('auth:sanctum');
    Route::get('/{product_id}', [ProductController::class, 'show'])->withoutMiddleware('auth:sanctum');    
    Route::get('/product-search/{category_id?}/{sub_category_id?}/{inner_category_id?}', [ProductController::class, 'showProduct'])->withoutMiddleware('auth:sanctum');    
    Route::patch('/{product_id}', [ProductController::class, 'update']);
    Route::delete('/{product_id}', [ProductController::class, 'destroy']);
});

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
    Route::get('/remove/{user_address_id}', [UserAddressController::class, 'removeUserAddress']);
    Route::post('/', [UserAddressController::class, 'addUserAddress'])->withoutMiddleware('auth:sanctum');
});