<?php

use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index']);

Route::get('/add-post', [PostController::class, 'create'])->name('add-post');
Route::get('/post/update/{post}', [PostController::class, 'edit'])->name('edit-post');
Route::get('/post/{post}', [PostController::class, 'show'])->name('show-post');
Route::put('/update/{post}', [PostController::class, 'update'])->name('update-post');
Route::get('/post/delete/{post}', [PostController::class, 'destroy'])->name('destroy-post');


Route::post('/store', [PostController::class, 'store'])->name('store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
