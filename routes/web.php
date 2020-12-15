<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test/getCurrency', [App\Http\Controllers\CurrencyController::class, 'getCurrencies'])->name('currency.submit');

Route::post('/make/transaction', [App\Http\Controllers\CurrencyController::class, 'makeTransaction'])->name('make.transaction');


Route::get('/admin/login', [App\Http\Controllers\Admin\AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/main', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index'); 

Route::get('/transactions/convertations/all', [App\Http\Controllers\AllController::class, 'allRecords']);