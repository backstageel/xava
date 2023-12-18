<?php

use App\Http\Controllers\ChangePasswordsController;
use App\Mail\saleMail;
use App\Models\Competition;
use App\Models\Sale;
use App\Models\SaleStatus;
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
    Route::resource('competitions', \App\Http\Controllers\CompetitionController::class);
    Route::resource('create_pdf', \App\Http\Controllers\CreatePdfController::class);
    Route::resource('sales', \App\Http\Controllers\SaleController::class);
    Route::resource('contacts', \App\Http\Controllers\ContactController::class);
    Route::resource('product_sub_categories', \App\Http\Controllers\ProductSubCategoryController::class);
    Route::resource('sale_items', \App\Http\Controllers\SaleItemsController::class);

    Route::get('competition/export', [\App\Http\Controllers\CompetitionController::class, 'export'])->name('competitions.export');
    Route::get('sale/export', [\App\Http\Controllers\SaleController::class, 'export'])->name('sales.export');
    Route::resource('expense_requests',\App\Http\Controllers\ExpenseRequestController::class);
    Route::post('/expense_requests/{expenseRequest}/approve', [\App\Http\Controllers\ExpenseRequestController::class, 'approve'])->name('expense_requests.approve');
    Route::post('/expense_requests/{expenseRequest}/reject', [\App\Http\Controllers\ExpenseRequestController::class, 'reject'])->name('expense_requests.reject');
    Route::get('/expense_request/myRequest', [\App\Http\Controllers\ExpenseRequestController::class, 'myRequest'])->name('expense_request.myRequest');
    Route::post('/expense_requests/{expenseRequest}/accountingStatus', [\App\Http\Controllers\ExpenseRequestController::class, 'accountingStatus'])->name('expense_requests.accountingStatus');
    Route::post('/expense_requests/{expenseRequest}/confirm', [\App\Http\Controllers\ExpenseRequestController::class, 'confirm'])->name('expense_requests.confirm');
    Route::resource('card_loads',\App\Http\Controllers\CardLoadController::class);
    Route::get('/view-document/{filename}/{path}', [\App\Http\Controllers\DocumentController::class, 'viewDocument'])->name('documents.view');
    Route::post('/documents/upload', [\App\Http\Controllers\DocumentController::class, 'uploadDocument'])->name('documents.upload');
    Route::get('/documents/index/{path}', [\App\Http\Controllers\DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/create/{path}', [\App\Http\Controllers\DocumentController::class, 'create'])->name('documents.create');
    Route::resource('vacations', \App\Http\Controllers\VacationController::class);
    Route::get('/vacation/myVacation', [\App\Http\Controllers\VacationController::class, 'myVacation'])->name('vacation.myVacation');
    Route::post('/vacations/{vacation}/approve', [\App\Http\Controllers\VacationController::class, 'approve'])->name('vacations.approve');
    Route::post('/vacations/{vacation}/reject', [\App\Http\Controllers\VacationController::class, 'reject'])->name('vacations.reject');
    Route::post('/vacations/{vacation}/cancel', [\App\Http\Controllers\VacationController::class, 'cancel'])->name('vacations.cancel');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/destroy', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/show', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::delete('/documents/destroy/{filename}/{path}', [\App\Http\Controllers\DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/vacation/vacationsMap', [\App\Http\Controllers\VacationController::class, 'vacationsMap'])->name('vacation.vacationsMap');
    Route::resource('vacation_collectives', \App\Http\Controllers\VacationCollectiveController::class);
    Route::get('/documents/edit/{document}/{path}', [\App\Http\Controllers\DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('/documents/update/{document}', [\App\Http\Controllers\DocumentController::class, 'update'])->name('documents.update');
    Route::post('/vacations/{vacation}/concluded', [\App\Http\Controllers\VacationController::class, 'concluded'])->name('vacations.concluded');
    Route::resource('holidays', \App\Http\Controllers\HolidaysController::class);
    Route::post('loans/simulate', [\App\Http\Controllers\LoanController::class, 'simulate'])->name('loans.simulate');
    Route::post('loans/{loan}/submit', [\App\Http\Controllers\LoanController::class, 'submit'])->name('loans.submit');
    Route::get('/loan/myLoans', [\App\Http\Controllers\LoanController::class, 'myLoans'])->name('loan.myLoans');
    Route::post('loans/{loan}/approve', [\App\Http\Controllers\LoanController::class, 'approve'])->name('loans.approve');
    Route::post('loans/{loan}/reject', [\App\Http\Controllers\LoanController::class, 'reject'])->name('loans.reject');
    Route::post('loans/{loan}/cancel', [\App\Http\Controllers\LoanController::class, 'cancel'])->name('loans.cancel');
    Route::put('/payments/store', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
    Route::get('/payments/{loan}/create', [\App\Http\Controllers\PaymentController::class, 'create'])->name('payments.create');
    Route::resource('expense_request_types', \App\Http\Controllers\ExpenseRequestTypeController::class);
    Route::get('/expense_request/create_box_request',[\App\Http\Controllers\ExpenseRequestController::class, 'create_box_request'])->name('expense_request.create_box_request');
    Route::post('/expense_request/store_box_request',[\App\Http\Controllers\ExpenseRequestController::class, 'store_box_request'])->name('expense_request.store_box_request');
    Route::get('/expense_request/index_box_request',[\App\Http\Controllers\ExpenseRequestController::class, 'index_box_request'])->name('expense_request.index_box_request');
    Route::get('/expense_request/{expenseRequest}/show_details',[\App\Http\Controllers\ExpenseRequestController::class, 'show_details'])->name('expense_request.show_details');
    Route::get('product/export', [\App\Http\Controllers\ProductController::class, 'export'])->name('products.export');


});

require __DIR__ . '/auth.php';
