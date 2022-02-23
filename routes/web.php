<?php

use App\Http\Controllers\EventController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('events', [EventController::class, 'index'])->name('events.index');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::post('events/create', [EventController::class, 'store'])->name('events.store');
Route::get('events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('events/{id}/edit', [EventController::class, 'update'])->name('events.update');
Route::get('events/{id}/delete', [EventController::class, 'destroy'])->name('events.destroy');