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
// Route::post('test-image','HomeCotroller@testimage')->name('test.image');
// Route::post('image','HomeCotroller@image')->name('image');

Route::get('/', 'HomeCotroller@index')->name('home');
Route::get('get-form-update/{id}','HomeCotroller@GetFormUpdate')->name('get.form.update');
Route::get('get-search','HomeCotroller@getsearch')->name('get.search');
Route::get('add-form-product','HomeCotroller@getAddNew')->name('get.form.new');
Route::post('save-update','HomeCotroller@saveupdate')->name('save.update');
Route::get('delete-product','HomeCotroller@deleteproduct')->name('delete.product');
Route::post('add-product','HomeCotroller@test')->name('save.product');
Route::post('add-new','HomeCotroller@savesize')->name('save.size');
Route::get('get-size-all','HomeCotroller@getSizeAll')->name('get.size.all');
Route::get('get-size','HomeCotroller@getsize')->name('get.size');
Route::get('delete-image','HomeCotroller@deleteImage')->name('delete.image');