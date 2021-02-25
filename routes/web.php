<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth'])->get('/bausteins/{any?}', function(){ return view('bausteine.index'); })->where('any', '.*')->name('bausteine.index');
Route::middleware(['auth'])->get('/gruppes/{any?}', function(){ return view('gruppen.index'); })->where('any', '.*')->name('gruppen.index');
Route::middleware(['auth'])->get('/dokuments/{any?}', function(){ return view('dokumente.index'); })->where('any', '.*')->name('dokumente.index');

// Route::resources([
//     'user' => 'UserController'
// ]);