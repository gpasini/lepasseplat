<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\ChangeWeekController;
use App\Http\Controllers\HorairesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ServicesController;
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

Route::get('/', AccueilController::class)->name('accueil');
Route::get('/horaires', HorairesController::class)->name('horaires');
Route::get('/services', ServicesController::class)->name('services');
Route::post('/book', [BookingController::class, 'book'])->name('book');
Route::post('/book/quantity', [BookingController::class, 'setQuantity'])->name('setQuantity');
Route::match(['get', 'post'], '/unbook', [BookingController::class, 'unbook'])->name('unbook');

Route::get('/change-week', ChangeWeekController::class)->name('changeWeek');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/commander', CommanderController::class)->name('commander');
    Route::get('/commander', CommanderController::class)->name('commander');
});
