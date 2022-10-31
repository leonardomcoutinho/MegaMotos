<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CardTariffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FpayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
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


    Route::get('/sell', [SellController::class, 'sell'])->name('sell');
    Route::post('/sell', [SellController::class, 'store'])->name('store_sell');
    Route::get('/sell/pdf', [SellController::class, 'pdf'])->name('pdf_sell');
    Route::get('/sell/excel', [SellController::class, 'excel'])->name('excel_sell');
    Route::get('/sell/edit/{id}', [SellController::class, 'edit'])->name('edit_sell');
    Route::post('/sell/edit/{id}', [SellController::class, 'updatestatus'])->name('updatestatus_sell');
    Route::get('/sell/reag/{id}', [SellController::class, 'reag'])->name('reag_sell');
    Route::post('/sell/reag/{id}', [SellController::class, 'updatereag'])->name('updatereag_sell');
    Route::get('/sell/parc/{id}', [SellController::class, 'parcial'])->name('parcial_sell');
    Route::post('/sell/parc/{id}', [SellController::class, 'updateparcial'])->name('updateparcial_sell');


    Route::get('/budget/read', [BudgetController::class, 'read'])->name('read_budget');
    Route::get('/budget', [BudgetController::class, 'budget'])->name('budget');
    Route::post('/budget', [BudgetController::class, 'store'])->name('store_budget');
    Route::get('/budget/pdf/{id}', [BudgetController::class, 'pdf'])->name('pdf_budget');
    Route::get('/budget/edit/{id}', [BudgetController::class, 'edit'])->name('edit_budget');
    Route::get('/budget/revert/{id}', [BudgetController::class, 'revert'])->name('revert_budget');
    Route::post('/budget/revert/{id}', [BudgetController::class, 'revertBudget'])->name('revertbudget');
    Route::post('/budget/cancel/{id}', [BudgetController::class, 'cancel'])->name('cancel_budget');
    Route::post('/budget/aproved/{id}', [BudgetController::class, 'aproved'])->name('aproved_budget');

    Route::get('/relatory/totalsell', [SellController::class, 'totalsell'])->name('totalsell');
    Route::get('/relatory/finalizadassell', [SellController::class, 'finalizadassell'])->name('finalizadassell');
    Route::get('/relatory/pendentessell', [SellController::class, 'pendentessell'])->name('pendentessell');
    Route::get('/relatory/recebidosell', [SellController::class, 'recebidosell'])->name('recebidosell');

    Route::get('/config/category', [CategoryController::class, 'categories'])->name('categories');
    Route::post('/config/category', [CategoryController::class, 'store'])->name('store_category');
    Route::post('/config/category/{id}', [CategoryController::class, 'destroy'])->name('destroy_category');


    Route::get('/config/fpay', [FpayController::class, 'fpay'])->name('fpay');
    Route::post('/config/fpay', [FpayController::class, 'store'])->name('store_fpay');
    Route::post('/config/fpay/{id}', [FpayController::class, 'destroy'])->name('destroy_fpay');


    Route::get('/config/tariff', [CardTariffController::class, 'tariff'])->name('tariff');
    Route::get('/config/edittariff/{id}', [CardTariffController::class, 'edit'])->name('edit_tariff');
    Route::put('/config/tariff/{id}', [CardTariffController::class, 'update'])->name('update_tariff');
});

