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

Route::get('/', 'IndexController@index')->name('index');
Route::get('/lga-polls', 'IndexController@lga_polls')->name('lga_polls');
Route::get('/new-result', 'IndexController@new_result')->name('new_result');
Route::post('/save-new-result', 'IndexController@save_new_result')->name('save_new_result');
Route::post('/find-lga', 'IndexController@find_lga')->name('find_lga');
Route::post('/find-ward', 'IndexController@find_ward')->name('find_ward');
Route::post('/find-polling_unit', 'IndexController@find_polling_unit')->name('find_polling_unit');
Route::get('/polling_unit_results/{id}', 'IndexController@polling_unit_results')->name('polling_unit_results');
Route::get('/edit/{book_id}', 'IndexController@edit')->name('edit');
