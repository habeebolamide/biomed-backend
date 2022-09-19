<?php

use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Category\Controllers\CategoryController;
use App\Modules\NestedSubCategory\Controllers\NestedSubCategoryController;
use App\Modules\Product\Controllers\ProductController;
use App\Modules\Product\Controllers\ProductDiseaseController;
use App\Modules\SubCategory\Controllers\SubCategoryController;
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
    Route::post('/', [ProductDiseaseController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [ProductDiseaseController::class, 'store']);
    Route::get('/{product_disease_id}', [ProductDiseaseController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{product_disease_id}', [ProductDiseaseController::class, 'update']);
    Route::delete('/{product_disease_id}', [ProductDiseaseController::class, 'destroy']);
});

Route::prefix('product')->middleware('auth:sanctum')->group(function(){
    Route::get('/', [ProductController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [ProductController::class, 'store']);
    Route::post('/name', [ProductController::class, 'showProductByName'])->withoutMiddleware('auth:sanctum');
    Route::get('/{product_id}', [ProductController::class, 'show'])->withoutMiddleware('auth:sanctum');    
    Route::get('/product-search/{category_id?}/{sub_category_id?}/{inner_category_id?}', [ProductController::class, 'showProduct'])->withoutMiddleware('auth:sanctum');    
    Route::patch('/{product_id}', [ProductController::class, 'update']);
    Route::delete('/{product_id}', [ProductController::class, 'destroy']);
});

// Route::prefix('picture')->middleware('auth:sanctum')->group(function(){
//     Route::get('/', [ProductController::class, 'index'])->withoutMiddleware('auth:sanctum');
//     Route::post('/', [ProductController::class, 'store']);
//     Route::get('/{product_id}', [ProductController::class, 'show'])->withoutMiddleware('auth:sanctum');    
//     Route::patch('/{product_id}', [ProductController::class, 'update']);
//     Route::delete('/{product_id}', [ProductController::class, 'destroy']);
// });