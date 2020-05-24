<?php

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

Route::get('/create', 'PdfController@createPdf')->name('create');

Route::get('/auswahl', 'PdfController@auswahl')->name('auswahl');
Route::post('/auswahl', 'PdfController@postauswahl')->name('postauswahl');

Route::post('/createtext', 'PdfController@createText')->name('createtext');


// Route::get('/pdf', function () { return view('formulare.fieldset'); })->name('pdf');

