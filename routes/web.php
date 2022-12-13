<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpanseCategoryController;
use App\Http\Controllers\ExpanseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
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
Route::get('change/password', [UserController::class,'changePasswordForm'])->name('password.change');
Route::post('change/password', [UserController::class,'changePassword'])->name('password.change');

// products
Route::resource('product', ProductController::class);
// products
Route::resource('order', OrderController::class)->except(['destroy', 'show', 'update']);
Route::post('order/details/update/{order?}', [OrderController::class, 'update'])->name('order.update');
Route::post('order/update/{order?}', [OrderController::class, 'updateOrder'])->name('order-update');
Route::get('download/order/invoice/{order}', [OrderController::class, 'downloadInvoice'])->name('order.download');
Route::get('print/order/invoice/{order}', [OrderController::class, 'printInvoice'])->name('order.print');
// cart
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
Route::post('cart/store', [CartController::class, 'store'])->name('cart.store');
// customers
Route::resource('customer', CustomerController::class);

Route::resource('expanse', ExpanseController::class)->except('show');

// expense category
Route::resource('category-expanse', ExpanseCategoryController::class);
// product category
Route::resource('category-product', ProductCategoryController::class);

//chart
Route::post('top/selling/product/chart', [chartController::class, 'topSell'])->name('chart.topsell');
Route::post('get/expanse/chart', [chartController::class, 'expanseChart'])->name('chart.expanse');
Route::post('busieness/progress', [chartController::class, 'progressChart'])->name('chart.progress');
Route::post('top/sales/man', [chartController::class, 'topSalesExecutiveChart'])->name('chart.salesman');
Route::post('perfomance/sales/man', [chartController::class, 'salesManPerfomance'])->name('chart.salesman_perfomance');
Route::post('self/perfomance', [chartController::class, 'selfPerfomanceSaLesMan'])->name('chart.selfPerfomance');
Route::post('amount/chart', [chartController::class, 'amountChart'])->name('chart.amount');


























// Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
// Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

// Route::get('/admin/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
// Route::post('/admin/register', [RegisterController::class, 'createAdmin'])->name('admin.register');

// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/admin/dashboard', function () {
//     return view('admin');
// })->middleware('auth:admin');
