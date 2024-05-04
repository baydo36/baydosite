<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authmanager;

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
})->middleware(['auth', 'verified'])->name('home');;
Route::get('/login', [authmanager::class ,'login'])->name('login');
Route::post('/login', [authmanager::class , 'loginpost'])->name('login.post');
Route::get('/register', [authmanager::class , 'register'])->name('register');
Route::post('/register', [authmanager::class , 'registerpost'])->name('register.post');
Route::get('/logout', [authmanager::class , 'logout'])->name('logout');
Route::get('/adminpage', [authmanager::class , 'adminpage'])->middleware(['auth', 'admin']);


