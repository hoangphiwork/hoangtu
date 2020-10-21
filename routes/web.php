<?php

use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('danh-muc/{slug}', [App\Http\Controllers\Frontend\CategoryController::class, 'show'])->name('category.show');

Route::get('chi-tiet/{slug}', [App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product.show');
Route::get('/tat-ca-san-pham', [App\Http\Controllers\Frontend\ProductController::class, 'getAll'])->name('product.all');

Route::group(['prefix' => 'gio-hang'], function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/them/{id}', [CartController::class, 'create'])->name('cart.create');
    Route::get('/xoa/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/sua', [CartController::class, 'update'])->name('cart.update');
    Route::post('/store', [CartController::class, 'store'])->name('cart.store');
});
Route::get('complete/{id}/{name}.html', [CartController::class, 'complete'])->middleware('checkCart');


/**
 * Group rout for admin manager
 */

Route::get('admin/login', [LoginController::class, 'index'])->name('login.index');
Route::post('admin/login', [LoginController::class, 'auth'])->name('login.do_login');
Route::get('admin/register', [LoginController::class, 'create'])->name('register.create')->middleware('firstRegister');
Route::post('admin/register', [LoginController::class, 'store'])->name('register.do_register');
Route::get('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/404', [DashboardController::class, 'get404'])->name('admin.404');

    Route::get('/change-password', [DashboardController::class, 'getFormChangePass'])->name('admin.changePass');
    Route::post('/change-password', [DashboardController::class, 'changePass']);

    Route::resource('/category', CategoryController::class)->except('show');
    Route::resource('/product', ProductController::class)->except('show');

    Route::group(['prefix' => 'order'], function () {
        Route::get('/', [OrderController::class, 'getOrder'])->name('order.index');
        Route::get('/delivery', [OrderController::class, 'getDelivery'])->name('order.delivery');
        Route::get('/shipped', [OrderController::class, 'getShipped'])->name('order.shipped');

        Route::get('/detail/delivery/{id}', [OrderController::class, 'deliveryOrder'])->name('detail.delivery');
        Route::get('/detail/delivered/{id}', [OrderController::class, 'deliveredOrder'])->name('detail.delivered');
        Route::get('/detail/cancel/{id}', [OrderController::class, 'cancelOrder'])->name('detail.cancel');

        Route::get('/detail/{id}', [OrderController::class, 'getDetailOrder'])->name('detail.index');
    });

});

View::composer('*', function ($view) {
    $info = Auth::user();
    $view->with('userLogin', $info);
});

