<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->get('/bausteins/{any?}', function(){ return view('home'); })->where('any', '.*');
Route::middleware(['auth'])->get('/gruppes/{any?}', function(){ return view('home'); })->where('any', '.*');
Route::middleware(['auth'])->get('/dokuments/{any?}', function(){ return view('home'); })->where('any', '.*');