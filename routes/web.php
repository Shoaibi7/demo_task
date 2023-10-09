<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['auth', 'CheckRoleMiddleware:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class,'index'])->name('admin.dashboard');
    Route::post('admin/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('admin.logout');
});
Route::get('admin/company/{company}/edit',[CompanyController::class,'edit']);
Route::post('admin/company/store',[CompanyController::class,'store']);
Route::put('admin/company/{company}/update',[CompanyController::class,'update']);
Route::delete('/admin/company/{company}/delete',[CompanyController::class,'destroy']);


Route::middleware(['auth', 'CheckRoleMiddleware:company'])->group(function () {
    Route::get('/company/dashboard', [CompanyController::class,'index'])->name('company.dashboard');
    Route::post('company/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('company.logout');
});
Route::get('products',[ProductController::class,'index']);
Route::get('company/product/{product}/edit',[ProductController::class,'edit']);
Route::post('company/product/store',[ProductController::class,'store']);
Route::put('company/product/{product}/update',[ProductController::class,'update']);
Route::delete('/company/product/{product}/delete',[ProductController::class,'destroy']);
// Route::get('/stripe',[ProductController::class,'stripe']);   
Route::post('/add-to-cart', [CartController::class,'addToCart'])->name('add-to-cart');
// Route::get('/cart', [CartController::class,'showCart'])->name('cart');
Route::get('/cart', [CartController::class,'index'])->name('cart');

Route::post('/checkout', [CartController::class,'checkout'])->name('checkout');
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
