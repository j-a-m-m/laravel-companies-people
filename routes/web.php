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

// I believe there is a better way of protecting this using gates?
// Plus it makes the resource statement above slightly redundant
Route::get('/users/create', 'UserController@create')->middleware('auth')->name('users.create');
Route::get('/users/edit', 'UserController@edit')->middleware('auth');

Route::post('users/{id}', 'UserController@storeNote')->name('users.storeNote');
Route::delete('users/{user_id}/destroyNote/{note_id}', 'UserController@destroyNote')->name('users.destroyNote')->middleware('auth');


Route::resource('companies', 'CompanyController');

// I believe there is a better way of protecting this using gates?
// Plus it makes the resource statement above slightly redundant
Route::get('/companies/create', 'CompanyController@create')->middleware('auth')->name('companies.create');
Route::get('/companies/edit', 'CompanyController@store')->middleware('auth');

Route::get('companies/{uuid}', 'CompanyController@show');
Route::post('companies/{uuid}', 'CompanyController@storeNote')->name('companies.storeNote');
Route::delete('companies/{uuid}/destroyNote/{noteid}', 'CompanyController@destroyNote')->name('companies.destroyNote')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
