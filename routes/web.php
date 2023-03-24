<?php

use App\Http\Controllers\ChangePasswordsController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('employees', \App\Http\Controllers\EmployeesController::class);
    Route::resource('customer_types', \App\Http\Controllers\CustomerTypeController::class);
    Route::resource('product_categories', \App\Http\Controllers\ProductCategoriesController::class);
    Route::resource('customers', \App\Http\Controllers\CustomersController::class);

    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('suppliers', \App\Http\Controllers\SuppliersController::class);

    Route::resource('change_passwords', ChangePasswordsController::class)->only('create', 'store');
    Route::resource('loans', \App\Http\Controllers\LoanController::class);

    Route::resource('create_pdf', \App\Http\Controllers\CreatePdfController::class);
});

require __DIR__ . '/auth.php';
