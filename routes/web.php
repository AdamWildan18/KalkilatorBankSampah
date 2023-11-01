<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;

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


Route::get('/', [HomeController::class, 'index']);
Route::get('/stor', [HomeController::class, 'create']);
Route::get('/get-data', [HomeController::class, 'getdata']);
Route::get('/setor/{name}', [HomeController::class, 'setor'])->name('setor.create');
Route::post('/setor/store', [HomeController::class, 'store'])->name('setor.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/kelola-sampah', [DashboardController::class, 'sampah'])->middleware('auth');
Route::get('/tambah-data', [DashboardController::class, 'create'])->middleware('auth');
Route::post('/store-data', [DashboardController::class, 'store'])->middleware('auth');
Route::get('/edit-data/{id}', [DashboardController::class, 'edit'])->middleware('auth');
Route::post('/update-data/{id}', [DashboardController::class, 'update'])->middleware('auth');
Route::delete('/hapus-data/{id}', [DashboardController::class, 'destroy'])->middleware('auth');

Route::get('/login', [SessionController::class, 'index'])->name('login');
Route::post('/actionlogin', [SessionController::class, 'login'])->name('actionlogin');
Route::post('/actionlogout', [SessionController::class, 'logout'])->name('actionlogout');
