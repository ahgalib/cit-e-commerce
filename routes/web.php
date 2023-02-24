<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;

use App\Http\Controllers\FrontEnd\FrontProductController;
use App\Http\Controllers\FrontEnd\LoginController;
use App\Http\Controllers\FrontEnd\RegisterController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\FrontEnd\CheckoutController;

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


//product route

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


//Front End Route
Route::get('/',[FrontProductController::class,'index'])->name('shop.home');
Route::get('/product/details/{slug}',[FrontProductController::class,'productDetails'])->name('product.details');
Route::post('/ajax/product/veriant',[FrontProductController::class,'ajaxProductVeriant']);
Route::get('/customer/login/register',[RegisterController::class,'customerLoginRegister'])->name('customer.login.register');
Route::post('/customer/register',[RegisterController::class,'customerRegister'])->name('customer.register');
Route::post('/customer/login',[LoginController::class,'customer_login'])->name('customer.login');
Route::get('/customer/logout',[LoginController::class,'customerLogout'])->name('customer.logout');

//cart route
Route::get('product/cart/43433534',[CartController::class,'index'])->name('cart');
Route::post('product/cart/43433534/stoere',[CartController::class,'storeCart'])->name('cart.store');
Route::get('product/cart/delete/{id}',[CartController::class,'deleteCart'])->name('cart.delete');
Route::post('product/cart/update',[CartController::class,'updateCart'])->name('cart.update');

//checkout route
Route::get('shop/checkout/47833534',[CheckoutController::class,'index'])->name('checkout');
Route::post('/ajax/getCities',[CheckoutController::class,'getCities']);
Route::post('checkout/4343/store/confirm',[CheckoutController::class,'checkoutStore'])->name('checkout.store');
Route::get('shop/checkout/complete/ere47833534',[CheckoutController::class,'orderComplete'])->name('order.complete');


