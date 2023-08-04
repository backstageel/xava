<?php

use App\Http\Controllers\ChangePasswordsController;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\competitionMail;
use App\Notifications\SomeModel;
use App\Notifications\SendSMSNotification;
use Illuminate\Support\Facades\Notification;

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
    Route::resource('loans_simulator', \App\Http\Controllers\LoanController::class)->only('create', 'store');
    Route::resource('payments', \App\Http\Controllers\PaymentController::class);
    Route::resource('competitions', \App\Http\Controllers\CompetitionController::class);
    Route::resource('create_pdf', \App\Http\Controllers\CreatePdfController::class);
    Route::resource('sales', \App\Http\Controllers\SaleController::class);
    Route::resource('contacts', \App\Http\Controllers\ContactController::class);
    Route::resource('product_sub_categories', \App\Http\Controllers\ProductSubCategoryController::class);
    Route::resource('sale_items', \App\Http\Controllers\SaleItemsController::class);

    Route::get('competition/export', [\App\Http\Controllers\CompetitionController::class, 'export'])->name('competitions.export');
    Route::get('sale/export', [\App\Http\Controllers\SaleController::class, 'export'])->name('sales.export');



});

require __DIR__ . '/auth.php';
