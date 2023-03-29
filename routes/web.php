<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\FormOfficerController;
use App\Http\Controllers\UserController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('auth')->group(function () {
    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
    Route::get('/users', [HomeController::class, 'index'])->name('home');
    Route::get('/setting', [UserController::class, 'index'])->name('setting');
    Route::put('/setting-action', [UserController::class, 'updateProfile'])->name('profile.action');
});

Route::prefix('officer')->group(function () {
    Route::get('/officer', [OfficerController::class, 'index'])->name('officer');
    Route::post('/store-officer', [OfficerController::class, 'store'])->name('store-officer');
    Route::get('/destroy/officer/{id}', [OfficerController::class, 'destroy'])->name('destroy-officer');
});

Route::prefix('form')->group(function () {
    Route::get('/form-officer', [FormOfficerController::class, 'index'])->name('form-officer');
    Route::post('/form-store', [FormOfficerController::class, 'store'])->name('store');
    Route::get('/form-show', [FormOfficerController::class, 'show'])->name('show-officer'); 
    Route::get('/form-delete/{id}',[FormOfficerController::class, 'destroy'])->name('delete.form');
    Route::get('/form-edit/{id}',[FormOfficerController::class, 'edit'])->name('edit.form');   
    Route::put('/form-edit/{id}',[FormOfficerController::class, 'update'])->name('update.form');
    Route::get('export', [FormOfficerController::class,'export_excel'])->name('export');
});





// Route::get('admin/home', 'HomeController@adminHome')->name('admin.home');
// Route::get('/home', 'HomeController@index')->name('home');
