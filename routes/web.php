<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpanseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Auth::routes(['register' => false]);
// user
Route::resource('user', UserController::class);

// products
Route::resource('product', ProductController::class);
// products
Route::resource('order', OrderController::class);
// customers
Route::resource('customer', CustomerController::class);
// expense
Route::resource('expanse', ExpanseController::class);
























// Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
// Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

// Route::get('/admin/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
// Route::post('/admin/register', [RegisterController::class, 'createAdmin'])->name('admin.register');

// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/admin/dashboard', function () {
//     return view('admin');
// })->middleware('auth:admin');
