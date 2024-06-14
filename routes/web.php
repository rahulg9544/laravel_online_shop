<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ShopController;
use App\Http\Controllers\admin\ShopsController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\AdminLoginController;


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
    return view('welcome');
});


Route::get('/customer/login', function () {
    return view('login');
});

Route::get('/customer/registration', function () {
    return view('registration');
});

Route::post('/customer', [CustomerController::class,'store'])->name('customer.store');

Route::get('/customer/login', [CustomerController::class,'cust_list'])->name('customer.login');

Route::group(['prefix' => 'admin'], function() {

    Route::group(['middleware' => 'admin.guest'], function() {

        

        Route::get('/login', [AdminLoginController::class,'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class,'authenticate'])->name('admin.authenticate');

    });

    Route::group(['middleware' => 'admin.auth'], function() {

        Route::get('/shop_dashboard', [ShopsController::class,'index'])->name('admin.shopdashboard');

        Route::get('/dashboards', [CustomerController::class,'index'])->name('admin.custdashboard');

        Route::get('/dashboard', [HomeController::class,'index'])->name('admin.dashboard');

        Route::get('/logout', [HomeController::class,'logout'])->name('admin.logout');

        // Shop Routes

        Route::get('/shops', [ShopController::class,'index'])->name('shops.index');
        Route::get('/shops/create', [ShopController::class,'create'])->name('shops.create');
        Route::post('/shops', [ShopController::class,'store'])->name('shops.store');
        Route::get('/shops/{shop}/edit', [ShopController::class,'edit'])->name('shops.edit');
        Route::put('/shops/{shop}', [ShopController::class,'update'])->name('shops.update');
        Route::delete('/shops/{shop}', [ShopController::class,'destroy'])->name('shops.delete');

        // Product Routes

        Route::get('/products', [ProductController::class,'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
        Route::post('/products', [ProductController::class,'store'])->name('products.store');
        Route::get('/products/{shop}/edit', [ProductController::class,'edit'])->name('products.edit');
        Route::put('/products/{shop}', [ProductController::class,'update'])->name('products.update');
        Route::delete('/products/{shop}', [ProductController::class,'destroy'])->name('products.delete');


        // Customer Routes

        Route::get('/customers', [CustomerController::class,'index'])->name('customers.index');

         
    });
});