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

Route::get('/', 'HomeCotroller@index');
Route::post('addnew','HomeCotroller@test')->name('up.i');
Route::post('add-new','HomeCotroller@savesize')->name('save.size');
Route::get('get-size','HomeCotroller@getsize')->name('get.size');
