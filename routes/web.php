<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

// Главная страница → метод dashboard в GameController
Route::get('/', [GameController::class, 'dashboard'])->name('dashboard');

// Страница боя → метод battle в GameController
Route::get('/battle', [GameController::class, 'battle'])->name('battle');

// Обработка атаки → метод attack в GameController
Route::post('/attack', [GameController::class, 'attack'])->name('attack');