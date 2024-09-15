<?php

use App\Http\Controllers\Top\TopPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TopPageController::class, 'index'])
->name('index');

Route::prefix('items')->group(function () {
  Route::get('index', [TopPageController::class, 'itemsIndex'])->name('items.index');
});