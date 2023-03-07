<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\FrontEnd\FrontProductController;
use App\Http\Controllers\FrontEnd\SearchController;
use App\Http\Controllers\FrontEnd\LoginController;
use App\Http\Controllers\FrontEnd\RegisterController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\CheckoutController;
use App\Http\Controllers\FrontEnd\CustomerController;
use App\Http\Controllers\FrontEnd\WishlistController;
use App\Http\Controllers\SslCommerzPaymentController;



Auth::routes();

Route::get('/',function(){
    return view('.front_end.index');
});
Route::get('/details',function(){
    return view('.front_end.details');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//User Route
Route::get('/user',[userController::class,'index'])->name('user');
Route::get('/user/delete/{id}',[userController::class,'delete'])->name('user.delete');

//Category Route
Route::get('/category',[CategoryController::class,'index'])->name('category');
Route::post('/category/create',[CategoryController::class,'create'])->name('category.create');
Route::get('/category/delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
Route::get('/category/trash',[CategoryController::class,'trash'])->name('trash');
Route::get('/category/restore/{id}',[CategoryController::class,'restore'])->name('category.restore');
Route::get('/category/force/delete/{id}',[CategoryController::class,'force_delete'])->name('category.force_delete');

//sub-category route
Route::get('/subCategory',[SubCategoryController::class,'index'])->name('subCategory');
Route::post('/subCategory/create',[SubCategoryController::class,'create'])->name('subCategory.create');
Route::post('/ajaxSubCategory',[SubCategoryController::class,'ajaxSubCategory']);

//show product
Route::get('/product',[ProductController::class,'index'])->name('product');

Route::get('add/product',[ProductController::class,'addProduct'])->name('product.add');
Route::post('/ajax/subCategory',[ProductController::class,'getSubCategoryAjax']);
Route::post('/product/store',[ProductController::class,'productStore'])->name('product.store');
Route::get('/product/veriant',[ProductController::class,'productVeriant'])->name('product.veriant');
Route::post('/product/color/store',[ProductController::class,'productColorStore'])->name('product.color.store');
Route::post('/product/size/store',[ProductController::class,'productSizeStore'])->name('product.size.store');
Route::get('/product/add/inventory/{id}/hfysdhkj/8878r7e878re',[ProductController::class,'addInventory'])->name('product.add.inventory');
Route::post('/product/create/inventory',[ProductController::class,'inventoryStore'])->name('product.create.inventory');
Route::get('/product/delete/{id}',[ProductController::class,'deleteProduct'])->name('product.delete');

//product edit er kaj pore kora hobe
Route::get('/product/edit/{slug}',[ProductController::class,'edit'])->name('product.edit');
Route::post('/product/update/{slug}',[ProductController::class,'update'])->name('product.update');

//coupon
Route::get('/coupon',[CouponController::class,'index'])->name('coupon');
Route::post('/coupon/create',[CouponController::class,'create'])->name('coupon.create');
//order route
Route::get('admin/order/list',[OrderController::class,'index'])->name('order');
Route::post('order/status',[OrderController::class,'orderStatus'])->name('order.status');




//Front End Route
Route::get('/',[FrontProductController::class,'index'])->name('shop.home');
Route::get('/product/details/{slug}',[FrontProductController::class,'productDetails'])->name('product.details');
Route::post('/ajax/product/veriant',[FrontProductController::class,'ajaxProductVeriant']);
//search route
Route::get('/search',[SearchController::class,'search'])->name('search');
//review route
Route::post('/product/review/store',[FrontProductController::class,'productReviewStore'])->name('review.store');
Route::get('/customer/login/register',[RegisterController::class,'customerLoginRegister'])->name('customer.login.register');
Route::post('/customer/register',[RegisterController::class,'customerRegister'])->name('customer.register');
//customer email verify route
Route::get('/customer/email/verify/{token}',[RegisterController::class,'emailVerify']);
Route::post('/customer/login',[LoginController::class,'customer_login'])->name('customer.login');
Route::get('/customer/logout',[LoginController::class,'customerLogout'])->name('customer.logout');

//cart route
Route::get('product/cart/43433534',[CartController::class,'index'])->name('cart');
Route::post('product/cart/43433534/store',[CartController::class,'storeCart'])->name('cart.store');
Route::get('product/cart/delete/{id}',[CartController::class,'deleteCart'])->name('cart.delete');
Route::post('product/cart/update',[CartController::class,'updateCart'])->name('cart.update');
//wishtlist route
Route::get('product/wishlist/43433534',[WishlistController::class,'index'])->name('wishlist');

//checkout route
Route::get('shop/checkout/47833534',[CheckoutController::class,'index'])->name('checkout');
Route::post('/ajax/getCities',[CheckoutController::class,'getCities']);
Route::post('checkout/4343/store/confirm',[CheckoutController::class,'checkoutStore'])->name('checkout.store');
Route::get('shop/checkout/complete/ere47833534',[CheckoutController::class,'orderComplete'])->name('order.complete');

//customer profile route
Route::get('shop/customer/profile/4783',[CustomerController::class,'index'])->name('customer');
Route::get('invoice/download/{order_id}',[CustomerController::class,'invoiceDownload'])->name('invoice.download');

//password reset route
Route::get('customer/reset/password',[CustomerController::class,'customer_reset_password'])->name('customer.reset.password');
Route::post('customer/reset/password/send',[CustomerController::class,'customer_reset_password_send'])->name('customer.reset.password.send');
Route::get('customer/reset/password/form/{token}',[CustomerController::class,'customer_reset_password_form'])->name('customer.reset.password.form');
Route::post('customer/update/forget/password/form',[CustomerController::class,'customer_update_forget_password_form'])->name('update.forget.password');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

