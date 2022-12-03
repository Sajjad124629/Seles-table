<?php

use App\Http\Controllers\PurchaseController;
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
