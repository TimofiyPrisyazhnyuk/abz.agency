<?php

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

use Illuminate\Support\Facades\Route;



// test vue
Route::get('/vue', ['uses' => 'Welcome\WelcomeController@testVue'])->name('react');


Route::get('/', ['uses' => 'Welcome\WelcomeController@welcome'])->name('welcome');

Auth::routes();

Route::resource('staff_tree','Staff\StaffTreeController');
Route::resource('staff_list','Staff\StaffListController');

