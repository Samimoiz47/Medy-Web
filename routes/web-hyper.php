<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\LoveCalculatorController;

// Welcome page (root)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Love Calculator routes
Route::get('/love-calculator', [LoveCalculatorController::class, 'index'])->name('love-calculator');
Route::post('/love-calculator/calculate', [LoveCalculatorController::class, 'calculate'])->name('love-calculator.calculate');

// Apps routes
Route::get('/apps', [AppController::class, 'index'])->name('apps.index');
Route::get('/apps/{id}', [AppController::class, 'show'])->name('apps.show');
Route::post('/apps/{id}/download', [AppController::class, 'download'])->name('apps.download');

// Arcade Gaming Hub
Route::get('/arcade', function () {
    return view('arcade-store-enhanced');
})->name('arcade');

// Game Store Routes - Consolidated to use hyper-realistic version
Route::get('/game-store', function () {
    return view('game-store-hyper');
})->name('game-store');

Route::get('/game-store-3d', function () {
    return view('game-store-hyper');
})->name('game-store-3d');

// Hyper-Realistic Game Store
Route::get('/game-store-hyper', function () {
    return view('game-store-hyper');
})->name('game-store-hyper');

// AI Video Chat Routes
Route::get('/ai-video-chat', function () {
    return view('ai-video-chat');
})->name('ai-video-chat');

Route::get('/ai-video-chat-neon', function () {
    return view('ai-video-chat-neon');
})->name('ai-video-chat-neon');

Route::get('/arcade-store', function () {
    return view('arcade-store-enhanced');
})->name('arcade-store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
