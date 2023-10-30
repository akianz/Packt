<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
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
    return view('welcome');
});

Auth::routes();

Auth::routes();

Route::get('/admin/login',[LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin',[LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/books-list', [App\Http\Controllers\HomeController::class, 'anydata'])->name('book_list');

Route::get('/admin/dashboard',function(){
    return view('admin_home');
})->middleware('auth:admin');


Route::resource('book', BookController::class)->middleware('auth:admin')->except(['anydata']);
Route::get('book-data',[BookController::class,'anydata'])->name('book.data');
