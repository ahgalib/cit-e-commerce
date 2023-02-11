<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;



Auth::routes();

Route::get('/',function(){
    return view('welcome');
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
Route::get('/product',[ProductController::class,'index'])->name('product');
Route::get('/product/store',[ProductController::class,'store'])->name('product.store');
Route::post('/ajax/product/store',[ProductController::class,'storeAjax']);
