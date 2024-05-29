<?php
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\SanPhamController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\CategoryController;
// use App\Http\Controllers\backend\ProductController;


Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('san-pham', [SanPhamController::class, 'index'])->name('site.product');
Route::get('chi-tiet-san-pham/{slug}', [SanPhamController::class, 'product_detail'])->name('site.product.detail');
Route::get('lien-he', [ContactController::class, 'index'])->name('site.contact');


//Trang quản lý
Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('bashboard');

    //Quản lý danh mục sản phẩm
    Route::prefix('category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('trash', [CategoryController::class, 'trash'])->name('category.trash');
        Route::get('insert', [CategoryController::class, 'insert'])->name('category.insert');
        Route::get('update', [CategoryController::class, 'update'])->name('category.update');
    });

    // // Quản lý sản phẩm
    // Route::prefix('product')->group(function(){
    //     Route::get('/', [ProductController::class, 'index'])->name('product.index');
    //     Route::get('trash', [ProductController::class, 'trash'])->name('product.trash');
    //     Route::get('insert', [ProductController::class, 'insert'])->name('product.insert');
    //     Route::get('update', [ProductController::class, 'update'])->name('product.update');
    // });
});
