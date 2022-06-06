<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\LandingPageController;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\AdminDestinationController;
use App\Http\Controllers\Backend\AdminPlaceTypeController;
use App\Http\Controllers\Backend\AdminUsersController;

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

Route::get('/', [LandingPageController::class, 'homepage'])->name('home');
Route::get('/destination', [LandingPageController::class, 'destinationSearch'])->name('search');
Route::get('/destination/view/{id}', [LandingPageController::class, 'view'])->name('view.modal');
Route::post('/destination/addActivity/{id}', [LandingPageController::class, 'addActivity'])->name('add.activity');
Route::post('/destination/deleteActivity/{id}', [LandingPageController::class, 'deleteActivity'])->name('delete.activity');


Route::post('/actionLogin', [LoginController::class, 'actionLogin'])->name('actionLogin');
Route::get('/actionLogout', [LoginController::class, 'actionLogout'])->name('actionLogout');
Route::post('/actionRegister', [LoginController::class, 'actionRegister'])->name('actionRegister');

Route::get('/admin/', [AdminDashboardController::class, 'view'])->name('admin.dashboard');

Route::get('/admin/destination', [AdminDestinationController::class, 'view'])->name('admin.destination');
Route::get('/admin/destination/form', [AdminDestinationController::class, 'loadForm'])->name('admin.destination.form');
Route::get('/admin/destination/form/{id}', [AdminDestinationController::class, 'loadForm'])->name('admin.destination.form.edit');
Route::post('/admin/destination/update/{id}', [AdminDestinationController::class, 'update'])->name('admin.destination.form.update');
Route::post('/admin/destination/add', [AdminDestinationController::class, 'create'])->name('admin.destination.add');
Route::delete('/admin/destination/delete/{id}', [AdminDestinationController::class, 'delete'])->name('admin.destination.delete');

Route::get('/admin/type', [AdminPlaceTypeController::class, 'view'])->name('admin.destinationtype');
Route::get('/admin/type/form', [AdminPlaceTypeController::class, 'loadForm'])->name('admin.destinationtype.form');
Route::get('/admin/type/form/{id}', [AdminPlaceTypeController::class, 'loadForm'])->name('admin.destinationtype.form.edit');
Route::post('/admin/type/add', [AdminPlaceTypeController::class, 'create'])->name('admin.destinationtype.add');
Route::post('/admin/type/update/{id}', [AdminPlaceTypeController::class, 'update'])->name('admin.destinationtype.form.update');
Route::delete('/admin/type/delete/{id}', [AdminPlaceTypeController::class, 'delete'])->name('admin.destinationtype.delete');

Route::get('/admin/users', [AdminUsersController::class, 'view'])->name('admin.users');
Route::get('/admin/users', [AdminUsersController::class, 'view'])->name('admin.users');
