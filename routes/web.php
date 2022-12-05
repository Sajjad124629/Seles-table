<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/table',[TableController::class,'index']);

Route::get('/genarate-pdf',[TableController::class,'generate_pdf']);





//purchase Route


Route::get('/purchase-report',[PurchaseController::class,'purchase_view']);

//export excel file

Route::get('/excel-export',[PurchaseController::class,'excel_export']);

//export csv file

Route::get('/csv-export',[PurchaseController::class,'csv_export']);



//payment route

Route::get('/payment-insert', [PurchaseController::class, 'payment_field']);


//expense and Salary

Route::get('/expense', [PurchaseController::class, 'expense']);





//store section

Route::get('/store-list', [StoreController::class, 'store_list']);
Route::get('/add-store', [StoreController::class, 'add_store']);


Route::post('/insert-store', [StoreController::class, 'insert_store']);

Route::get('/edit-store/{id}', [StoreController::class, 'edit_store']);

Route::put('/update-store/{id}', [StoreController::class, 'update_store']);




//Expense section

Route::get('/expense-category-list', [ExpenseCategoryController::class, 'expense_category_list']);

Route::get('/add-expense-category', [ExpenseCategoryController::class, 'add_expense_category']);

Route::post('/insert-expense-category', [ExpenseCategoryController::class, 'insert_expense_category']);

Route::get('/edit-expense-category/{id}', [ExpenseCategoryController::class, 'edit_expense_category']);

Route::put('/update-expense-category/{id}', [ExpenseCategoryController::class, 'update_expense_category']);



//Bank Section

Route::get('/bank-list', [BankController::class, 'bank_list']);
Route::get('/add-bank', [BankController::class, 'add_bank']);
Route::post('/insert-bank', [BankController::class, 'insert_bank']);
Route::get('/edit-bank/{id}', [BankController::class, 'edit_bank']);
Route::put('/update-bank/{id}', [BankController::class, 'update_bank']);
