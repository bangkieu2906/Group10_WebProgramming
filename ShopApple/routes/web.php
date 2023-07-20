<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

//FE
Route::get('','App\Http\Controllers\HomeController@index');
Route::get('/','App\Http\Controllers\HomeController@index');//
Route::get('/trangchu', 'App\Http\Controllers\HomeController@index');


//Category Home
Route::get('/show-category/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category');
Route::get('/show-brand/{brand_id}', 'App\Http\Controllers\BrandProduct@show_brand');

Route::get('/product-detail/{product_id}', 'App\Http\Controllers\ProductController@product_detail');
Route::get('/product-home', 'App\Http\Controllers\ProductController@product_home');

Route::get('/search','App\Http\Controllers\HomeController@search');


//BE
Route::get('/admin','App\Http\Controllers\AdminController@index');
Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');
Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');
Route::post('/logout','App\Http\Controllers\AdminController@logout');


//Category Product
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product','App\Http\Controllers\CategoryProduct@all_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_id}','App\Http\Controllers\CategoryProduct@update_category_product');

Route::get('/edit-category-product/{category_id}','App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_id}','App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/active-category-product/{category_id}','App\Http\Controllers\CategoryProduct@active_category_product');
Route::get('/inactive-category-product/{category_id}','App\Http\Controllers\CategoryProduct@inactive_category_product');



//Brand Product
Route::get('/add-brand-product','App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product','App\Http\Controllers\BrandProduct@all_brand_product');

Route::post('/save-brand-product','App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_id}','App\Http\Controllers\BrandProduct@update_brand_product');

Route::get('/edit-brand-product/{brand_id}','App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_id}','App\Http\Controllers\BrandProduct@delete_brand_product');

Route::get('/active-brand-product/{brand_id}','App\Http\Controllers\BrandProduct@active_brand_product');
Route::get('/inactive-brand-product/{brand_id}','App\Http\Controllers\BrandProduct@inactive_brand_product');


//Product
Route::get('/add-product','App\Http\Controllers\ProductController@add_product');
Route::get('/all-product','App\Http\Controllers\ProductController@all_product');

Route::post('/save-product','App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}','App\Http\Controllers\ProductController@update_product');

Route::get('/edit-product/{product_id}','App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\ProductController@delete_product');

Route::get('/active-product/{product_id}','App\Http\Controllers\ProductController@active_product');
Route::get('/inactive-product/{product_id}','App\Http\Controllers\ProductController@inactive_product');

Route::get('/sort_product_asc','App\Http\Controllers\ProductController@sort_asc');
Route::get('/sort_product_desc','App\Http\Controllers\ProductController@sort_desc');
Route::get('/search_sort_product_desc/{key}','App\Http\Controllers\HomeController@sort_desc');
Route::get('/search_sort_product_asc/{key}','App\Http\Controllers\HomeController@sort_asc');
//Cart
Route::post('/save-cart','App\Http\Controllers\CartController@save_cart');
// Route::get('/show-cart','App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','App\Http\Controllers\CartController@delete_to_cart');
Route::post('/update-cart', 'App\Http\Controllers\CartController@updateCart')->name('cart.update');

Route::post('/redirect-back', function () {
    return redirect()->back();
});
//Login
Route::get('/flogin','App\Http\Controllers\LoginController@flogin');
Route::get('/fregistor','App\Http\Controllers\LoginController@fregistor');
Route::get('/logout','App\Http\Controllers\LoginController@logout');

Route::post('/registor','App\Http\Controllers\LoginController@registor');
Route::post('/login','App\Http\Controllers\LoginController@login');

//User
Route::get('/customer/{id}','App\Http\Controllers\HomeController@information');
Route::post('/update-user/{id}','App\Http\Controllers\HomeController@update_user');


//Checkout
Route::get('/checkout','App\Http\Controllers\CheckoutController@checkout')->name('checkout');
Route::post('/order-place','App\Http\Controllers\CheckoutController@order_place');
Route::get('/order-history','App\Http\Controllers\OrderController@order_history');

//Manage Order
Route::get('/manage-order','App\Http\Controllers\OrderController@manage_order');
Route::get('/view-order/{orderId}','App\Http\Controllers\OrderController@view_order');
Route::get('/view-my-order/{orderId}','App\Http\Controllers\OrderController@view_my_order');
Route::get('/print-order/{order_id}','App\Http\Controllers\OrderController@print_order');
Route::post('/update-status/{id}', 'App\Http\Controllers\OrderController@updateStatus');
Route::get('/cancel-order/{order_id}','App\Http\Controllers\OrderController@cancel_order');

//send email
Route::get('/sendmail','App\Http\Controllers\HomeController@sendmail');

//Coupon
Route::get('/list-coupon','App\Http\Controllers\CouponController@list_coupon');
Route::get('/insert-coupon','App\Http\Controllers\CouponController@insert_coupon');
Route::post('/insert-coupon-code','App\Http\Controllers\CouponController@insert_coupon_code');
Route::get('/delete-coupon/{coupon_id}','App\Http\Controllers\CouponController@delete_coupon');

Route::post('/check-coupon','App\Http\Controllers\CheckoutController@check_coupon');
Route::get('/unset-coupon','App\Http\Controllers\CheckoutController@unset_coupon');


//payment
Route::post('/vnpay-payment','App\Http\Controllers\CheckoutController@vnpay_payment');
Route::post('/momo-payment','App\Http\Controllers\CheckoutController@momo_payment');

Route::get('/create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::get('/process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('/success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('/cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

//Test
Route::get('/custom-rule/show', 'App\Http\Controllers\ValidateRuleCustomController@show');

Route::post('/custom-rule/validate', 'App\Http\Controllers\ValidateRuleCustomController@validateCustom')
    ->name('custom');

Route::get('/search_suggestion', 'App\Http\Controllers\HomeController@searchSuggestion')->name('search_suggestion');
