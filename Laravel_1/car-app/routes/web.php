<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Главная страница с формой
Route::get('/', [CarController::class, 'index'])->name('cars.index');

// Сохранение автомобиля
Route::post('/cars/store', [CarController::class, 'store'])->name('cars.store');

// Поиск автомобилей
Route::post('/cars/search', [CarController::class, 'search'])->name('cars.search');

// Просмотр всех автомобилей (GET запрос)
Route::get('/cars/search', [CarController::class, 'search'])->name('cars.search.get');
