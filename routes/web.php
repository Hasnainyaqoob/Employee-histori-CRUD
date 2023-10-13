<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get_employe_hostory/{id}', [App\Http\Controllers\HomeController::class, 'get_history'])->name('get_history');
Route::post('/post_employe_hostory', [App\Http\Controllers\HomeController::class, 'post_history'])->name('post_history');
Route::get('/delete_employe_hostory/{id}', [App\Http\Controllers\HomeController::class, 'delete_history'])->name('delete_history');
Route::get('/edit_employe_hostory/{id}', [App\Http\Controllers\HomeController::class, 'edit_history'])->name('edit_history');
Route::post('/update_employe_hostory/{id}', [App\Http\Controllers\HomeController::class, 'update_history'])->name('update_history');
