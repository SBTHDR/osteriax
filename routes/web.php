<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ItemController;
use App\Http\Controllers\Backend\ReservationsController;
use App\Http\Controllers\Frontend\ReservationController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\HomepageController;

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

Route::get('/', [HomepageController::class, 'index'])->name('welcome');
Route::post('/reservation', [ReservationController::class, 'makeReservation'])->name('reservation.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
	Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('slider', SliderController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('item', ItemController::class);
    Route::get('reservation', [ReservationsController::class, 'index'])->name('reservation.index');
    Route::post('reservation/{id}', [ReservationsController::class, 'statusChange'])->name('reservation.status');
});





