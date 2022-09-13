<?php

use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Category\Controllers\CategoryController;
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

Route::middleware('auth:sanctum')->group(function() {

    Route::prefix('category')->middleware('auth:sanctum')->group(function(){
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{category_id}', [CategoryController::class, 'show']);
        Route::patch('/{category_id}', [CategoryController::class, 'update']);
        Route::delete('/{category_id}', [CategoryController::class, 'destroy']);
    });
    
    Route::prefix('sub-category')->middleware('auth:sanctum')->group(function(){
        Route::get('/', [SubCategoryController::class, 'index']);
        Route::post('/', [SubCategoryController::class, 'store']);
        Route::get('/{sub_category_id}', [SubCategoryController::class, 'show']);
        Route::get('/category/{category_id}', [SubCategoryController::class, 'showSubCategory']);
        Route::patch('/{sub_category_id}', [SubCategoryController::class, 'update']);
        Route::delete('/{sub_category_id}', [SubCategoryController::class, 'destroy']);
    });
    Route::prefix('sub-category')->middleware('auth:sanctum')->group(function(){
        
    });
});

