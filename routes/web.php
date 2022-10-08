<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('home');



Auth::routes();



Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'index'])->name('admin');
    Route::get('/admin/products', [ProductController::class, 'products'])->name('products');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('store_products');

    Route::get('/admin/categories', [CategoryController::class, 'categories'])->name('categories');
    
    Route::get('/admin/inventory', [InventoryController::class, 'inventory'])->name('inventory');
    Route::post('/admin/inventory', [InventoryController::class, 'store'])->name('store_inventory');
});

