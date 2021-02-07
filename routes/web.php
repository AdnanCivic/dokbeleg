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

// Route::post('/getBausteine', 'DokumentationController@getBausteine')->name('getBausteine');

// Route::get('/create', 'PdfController@createPdf')->name('create');
// Route::get('/auswahl', 'PdfController@auswahl')->name('auswahl');
// Route::post('/auswahl', 'PdfController@postauswahl')->name('postauswahl');
// Route::post('/createtext', 'PdfController@createText')->name('createtext');

// Route::get('/pdf', function () { return view('formulare.fieldset'); })->name('pdf');
