<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->get('/bausteins/{any?}', function(){ return view('home'); })->where('any', '.*');
Route::middleware(['auth'])->get('/gruppes/{any?}', function(){ return view('home'); })->where('any', '.*');
Route::middleware(['auth'])->get('/dokuments/{any?}', function(){ return view('home'); })->where('any', '.*');
// Route::middleware(['auth'])->get('/users/{any?}', function(){ return view('home'); })->where('any', '.*');
