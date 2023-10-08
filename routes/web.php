<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
