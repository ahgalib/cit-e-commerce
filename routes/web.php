<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;


Auth::routes();

Route::get('/',function(){
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user',[userController::class,'index'])->name('user');
