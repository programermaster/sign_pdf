<?php

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

Route::get('/', [App\Http\Controllers\PDFController::class, 'index'])->name("index");
Route::get('/list', [App\Http\Controllers\PDFController::class, 'list'])->name("list");
Route::get('/edit', [App\Http\Controllers\PDFController::class, 'edit'])->name("edit");
Route::post('/store', [App\Http\Controllers\PDFController::class, 'store'])->name("store");
