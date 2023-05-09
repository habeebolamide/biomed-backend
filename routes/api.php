<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SpecialOrderController;
use App\Models\SpecialOrder;
use App\Modules\Address\Controllers\UserAddressController;
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Cart\Controllers\CartController;
use App\Modules\Category\Controllers\CategoryController;
use App\Modules\Coupon\Controllers\CouponController;
use App\Modules\Customers\Controllers\CustomersController;
use App\Modules\Invoice\Controllers\InvoiceController;
use App\Modules\NestedSubCategory\Controllers\NestedSubCategoryController;
use App\Modules\Order\Controllers\OrderController;
use App\Modules\Pictures\Controllers\PictureController;
use App\Modules\Product\Controllers\ProductController;
use App\Modules\Product\Controllers\ProductDiseaseController;
use App\Modules\SubCategory\Controllers\SubCategoryController;
use App\Modules\Transaction\Controllers\TransactionController;
use App\Modules\UserMessage\Controllers\UserMessageController;
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
Route::get('/user-details', [AuthController::class, 'userDetails'])->middleware('auth:sanctum');

Route::post('/contact', [ContactController::class, 'store']);
Route::post('/special-order', [SpecialOrderController::class, 'store']);


// ADMIN ROUTES
Route::prefix('category')->middleware('auth:sanctum')->group(function () {
    Route::post('/', [CategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/store', [CategoryController::class, 'store'])->withoutMiddleware('auth:sanctum');
    Route::get('/{category_id}', [CategoryController::class, 'show'])->withoutMiddleware('auth:sanctum');
    //
    Route::post('/detail', [CategoryController::class, 'categoryDetail'])->withoutMiddleware('auth:sanctum');
   //
    Route::patch('/{category_id}', [CategoryController::class, 'update']);
    Route::delete('/{category_id}', [CategoryController::class, 'destroy']);
    Route::prefix('admin')->middleware('auth:sanctum')->group(function () {

        Route::post('/category-pics/{category_id}', [PictureController::class, 'categoryPicture']);
        Route::delete('/remove-category-pics/{picture_id}', [PictureController::class, 'removePicture']);
    });
});

Route::prefix('nested-sub-category')->middleware('auth:sanctum')->group(function () {
    Route::post('/all', [NestedSubCategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [NestedSubCategoryController::class, 'store']);
    Route::get('/{nested_sub_category_id}', [NestedSubCategoryController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::post('/sub-category/{sub_category_id}', [NestedSubCategoryController::class, 'showSubCategory']);
    Route::patch('/{sub_category_id}', [NestedSubCategoryController::class, 'update']);
    Route::delete('/{sub_category_id}', [NestedSubCategoryController::class, 'destroy']);

    //technology
    Route::post('/technology', [NestedSubCategoryController::class,'get_nested_category_by_id_as_technology'])->withoutMiddleware('auth:sanctum');
    // end

});

Route::prefix('sub-category')->middleware('auth:sanctum')->group(function () {
    Route::post('/all', [SubCategoryController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [SubCategoryController::class, 'store']);
    Route::get('/{sub_category_id}', [SubCategoryController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::post('/category/{category_id}', [SubCategoryController::class, 'showSubCategory']);
    Route::patch('/{sub_category_id}', [SubCategoryController::class, 'update']);
    Route::delete('/{sub_category_id}', [SubCategoryController::class, 'destroy']);

    /// get sub category by id
    Route::post('/sub_category_by_id', [SubCategoryController::class, 'get_sub_category_by_cat_id'])->withoutMiddleware('auth:sanctum');
    /// end

});

Route::prefix('disease')->middleware('auth:sanctum')->group(function () {
    Route::post('/all', [ProductDiseaseController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [ProductDiseaseController::class, 'store']);
    Route::get('/{product_disease_id}', [ProductDiseaseController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{product_disease_id}', [ProductDiseaseController::class, 'update']);
    Route::delete('/{product_disease_id}', [ProductDiseaseController::class, 'destroy']);
});

Route::prefix('product')->middleware('auth:sanctum')->group(function () {
    Route::post('/all/all-products', [ProductController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{product_id}', [ProductController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::get('/product-search/{category_id?}/{sub_category_id?}/{inner_category_id?}', [ProductController::class, 'showProduct'])->withoutMiddleware('auth:sanctum');
    Route::post('/product-filter', [ProductController::class, 'filterProduct'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{product_id}', [ProductController::class, 'update']);
    Route::delete('/{product_id}', [ProductController::class, 'destroy']);
    Route::post('/{name}', [ProductController::class, 'showProductByName'])->withoutMiddleware('auth:sanctum');

    Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
        Route::post('/all', [ProductController::class, 'admin_index'])->withoutMiddleware('auth:sanctum');
        Route::post('/all-histories', [ProductController::class, 'admin_product_history'])->withoutMiddleware('auth:sanctum');

        Route::post('/product-pics/{product_id}', [PictureController::class, 'productPicture']);
        Route::delete('/remove-product-pics/{picture_id}', [PictureController::class, 'removeProductPicture']);
    });
    
    // Route::prefix('pictures')->middleware('auth:sanctum')->group(function(){
    //     Route::post('/product-pics/{product_id}', [PictureController::class, 'productPicture']);
    //     Route::post('/category-pics/{category_id}', [PictureController::class, 'categoryPicture']);
    // });

});

Route::prefix('dashboard')->middleware('auth:sanctum')->group(function () {

    Route::post('/chart_data', [ProductController::class, 'admin_sale_report'])->name("chart_data");
    Route::post('/chart_data1', [ProductController::class, 'admin_category_purchase_report'])->name("chart_data1");
    Route::post('/categories_by_name', [ProductController::class, 'categories_by_name'])->name("categories_by_name");
    Route::post('/income', [ProductController::class, 'income'])->name("income");
});


Route::prefix('customers')->middleware('auth:sanctum')->group(function () {
    Route::post('/all', [CustomersController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [CustomersController::class, 'store']);
    Route::post('/', [CustomersController::class, 'store']);
    Route::get('search-user/{id}', [CustomersController::class, 'search_user']);

    Route::patch('/{user_id}', [CustomersController::class, 'update']);
    Route::delete('/{user_id}', [CustomersController::class, 'destroy']);
    Route::prefix('message')->group(function () {

        Route::post('/', [UserMessageController::class, 'store']);
    });
});

// CLIENT ROUTES
Route::prefix('wish-list')->middleware('auth:sanctum')->group(function () {
    Route::match(['get', 'post'],'get/', [WishListController::class, 'index'])->withoutMiddleware('auth:sanctum');
    Route::get('/{wish_list_id}', [WishListController::class, 'show'])->withoutMiddleware('auth:sanctum');
    Route::patch('/{wish_list_id}', [WishListController::class, 'update'])->withoutMiddleware('auth:sanctum');
    Route::get('/remove/{wish_list_id}', [WishListController::class, 'remove'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [WishListController::class, 'store'])->withoutMiddleware('auth:sanctum');
});

Route::prefix('cart')->middleware('auth:sanctum')->group(function () {
    Route::match(['get', 'post'],'get/', [CartController::class, 'getCarts'])->withoutMiddleware('auth:sanctum');
    Route::get('/{cart_id}', [CartController::class, 'getSingleCart']);
    Route::patch('/{cart_id}', [CartController::class, 'updateCart']);
    Route::patch('/update-quantity/{cart_id}', [CartController::class, 'incrementQuantity'])->withoutMiddleware('auth:sanctum');
    Route::get('/remove/{cart_id}', [CartController::class, 'removeCart'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [CartController::class, 'addToCart'])->withoutMiddleware('auth:sanctum');
    Route::post('/generate_invoice', [CartController::class, 'generate_invoice']);
    Route::post('/clear-cart', [CartController::class, 'clearCart']);
});

Route::prefix('invoice')->middleware('auth:sanctum')->group(function () {

    Route::post('/generate_invoice', [InvoiceController::class, 'generate_invoice']);
    Route::get('/all_invoice/user_invoices', [InvoiceController::class, 'all_invoice']);
    Route::get('/all_invoice/user_unpaid_invoices', [InvoiceController::class, 'unpaid_invoice'])->withoutMiddleware('auth:sanctum');
    Route::get('/{invoice_id}', [InvoiceController::class, 'get_invoice']);
    Route::post('/discard_invoice', [InvoiceController::class, 'discard_invoice']);
    Route::post('/{invoice_id}/pay', [TransactionController::class, 'initializeTransaction']);
    Route::post('/check-status/{transaction_id}/{invoice_id}', [TransactionController::class, 'checkTransactionStatus']);
});

Route::prefix('user-address')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [UserAddressController::class, 'getUserAddress'])->withoutMiddleware('auth:sanctum');
    Route::get('/{user_address_id}', [UserAddressController::class, 'getSingleUserAddress']);
    Route::patch('/{user_address_id}', [UserAddressController::class, 'updateUserAddress']);
    Route::patch('/make-default/{user_address_id}', [UserAddressController::class, 'defaultAddress']);
    Route::get('/remove/{user_address_id}', [UserAddressController::class, 'removeUserAddress']);
    Route::post('/', [UserAddressController::class, 'addUserAddress']);
});

Route::prefix('order')->middleware('auth:sanctum')->group(function () {
    Route::get('/get-order/{order_no}', [OrderController::class, 'getOrder']);
    Route::get('/place-order', [OrderController::class, 'placeOrder']);
    Route::get('/get-user-order', [OrderController::class, 'getAllUserOrders']);
    Route::post('/', [UserAddressController::class, 'addUserAddress']);
    Route::post('/', [UserAddressController::class, 'addUserAddress']);


    Route::prefix('admin')->group(function () {
        Route::post('/get-all-order', [OrderController::class, 'getAllOrder']);
        Route::post('/change-status', [OrderController::class, 'change_status']);

        Route::prefix('invoice')->middleware('auth:sanctum')->group(function () {
            Route::post('/user_invoice', [InvoiceController::class, 'user_invoice']);
        });
    });
});

Route::prefix('coupon')->middleware('auth:sanctum')->group(function () {
    Route::get('/get-coupon/{coupon}', [CouponController::class, 'getCoupon']);
    Route::post('/all', [CouponController::class, 'getAllCoupon']);
    Route::post('/generate-Coupon', [CouponController::class, 'generateCoupon']);
    Route::post('/attach-coupon-to-user/{id}/{user_id}', [CouponController::class, 'attatchToUser']);
    Route::post('/user/{user_id}', [CouponController::class, 'userCoupon']);
});
