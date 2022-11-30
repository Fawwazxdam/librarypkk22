<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
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
    $data = Buku::all();
    return view('dashboard',compact('data'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    
    Route::resource('/kategori', KategoriController::class);
    Route::get('/delkat/{id}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('delkat');
    Route::resource('/user', UserController::class);
    Route::get('/delus/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delus');
});
Route::middleware(['auth'])->group(function () {
    
    Route::resource('/buku', BukuController::class);
    Route::get('/delbuk/{buku}', [App\Http\Controllers\BukuController::class, 'destroy'])->name('delbuk');
});