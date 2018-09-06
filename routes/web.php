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


Route::get('/', ['uses' => 'Welcome\WelcomeController@welcome'])->name('welcome');

// Authentication system
Auth::routes();

// Users functionality
Route::resource('staff_tree', 'Staff\StaffTreeController')->only(['index','store', 'show']);
Route::resource('staff_list', 'Staff\StaffListController');
Route::post('staff_list/boss','Staff\StaffListController@getBoss')->name('staff_list.boss');
Route::post('staff_list/save/user','Staff\StaffListController@saveNewUser')->name('staff_list.save');

// Download image functionality
Route::resource('image', 'Image\ImageController')->only(['store', 'destroy']);

