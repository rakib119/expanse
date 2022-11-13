<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        // return OrderDetail:: where('product_id',1)->count();
     $orders = OrderDetail:: join('products','products.id','order_details.product_id')
                ->select('products.name',DB::raw('count(order_details.product_id) as total'))->groupBy('products.name');
              $product_name =  $orders->pluck('products.name')->toArray();
                // implode(' ', $product_name);
              $total_sell =  $orders->pluck('total')->toArray();
        return view('common.dashboard',compact('product_name','total_sell'));
    });
});

Auth::routes(['register' => false]);


Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin', [LoginController::class, 'adminLogin'])->name('admin.login');

Route::get('/admin/register', [RegisterController::class, 'showAdminRegisterForm'])->name('admin.register-view');
Route::post('/admin/register', [RegisterController::class, 'createAdmin'])->name('admin.register');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware('auth:admin');

// user
Route::resource('user',UserController ::class);
