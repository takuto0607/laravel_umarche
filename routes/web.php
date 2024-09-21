<?php

use App\Http\Controllers\Top\TopPageController;
use App\Http\Controllers\Top\TopItemController;
use App\Http\Controllers\Top\TopShopController;
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
  Route::get('index', [TopItemController::class, 'index'])->name('items.index');

  Route::get('show/{item}', [TopItemController::class, 'show'])->name('items.show');
});

Route::prefix('shops')->group(function () {
  Route::get('index', [TopShopController::class, 'index'])->name('shops.index');

  Route::get('show/{shop}', [TopShopController::class, 'show'])->name('shops.show');
});