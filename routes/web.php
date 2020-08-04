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

Route::resource('users', 'UserController');
Route::post('users/{id}', 'UserController@storeNote')->name('users.storeNote');
Route::delete('users/{user_id}/destroyNote/{note_id}', 'UserController@destroyNote')->name('users.destroyNote');


Route::resource('companies', 'CompanyController');
Route::get('companies/{uuid}', 'CompanyController@show');
Route::post('companies/{uuid}', 'CompanyController@storeNote')->name('companies.storeNote');
Route::delete('companies/{uuid}/destroyNote/{noteid}', 'CompanyController@destroyNote')->name('companies.destroyNote');
