<?php

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
Route::get('/download-pdf',[TableController::class,'download_pdf']);
