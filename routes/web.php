<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SalesController;

Auth::routes();

Route::get('/', [PagesController::class, 'mainPage'])->name("main");
Route::get('/create-sale', [PagesController::class, 'createSalePage'])->name("create-sale");
    Route::post('/create', [SalesController::class, 'createSale'])->name('create');

Route::get('/one-sale/{id}', [PagesController::class, 'oneSalePage'])->name("one-sale");
Route::get('/my-sales', [PagesController::class, 'mySalesPage'])->name("my-sales");
    Route::post('/public/{id}', [SalesController::class, 'publicSale'])->name('public');
    Route::post('/remove/{id}', [SalesController::class, 'removeSale'])->name('remove');

Route::get('/update-sale/{id}', [PagesController::class, 'updateSalePage'])->name("update-sale");
    Route::post('/update/{id}', [SalesController::class, 'updateSale'])->name("update");

Route::get('/search', [PagesController::class, 'search'])->name("search");