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
// Route::get('/', function(){
// 	return view('testForm');
// });
Route::get('/', 'HomeCotroller@index')->name('home');
Route::get('get-form-update/{id}','HomeCotroller@GetFormUpdate')->name('get.form.update');
Route::get('add-form-product','HomeCotroller@getAddNew')->name('get.form.new');
Route::post('save-update','HomeCotroller@saveupdate')->name('save.update');
Route::post('add-product','HomeCotroller@test')->name('save.product');
Route::post('add-new','HomeCotroller@savesize')->name('save.size');
Route::get('get-size','HomeCotroller@getsize')->name('get.size');
Route::get('delete-image','HomeCotroller@deleteImage')->name('delete.image');