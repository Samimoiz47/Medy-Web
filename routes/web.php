<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoveCalculatorController;

// Loading page - Default route
Route::get('/', function () {
    return view('loading');
})->name('loading');

// Welcome page
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/ai-video-chat', function () {
    return view('ai-video-chat');
});

Route::get('/ai-video-chat-neon', function () {
    return view('ai-video-chat-neon');
});

Route::get('/ai-video-chat-enhanced', function () {
    return view('ai-video-chat-enhanced');
});

Route::get('/game-store-hyper', function () {
    return view('game-store-hyper');
});

Route::get('/apps-store-neon-enhanced', function () {
    return view('apps-store-neon-enhanced');
});


Route::get('/game-store-3d', function () {
    return view('game-store-hyper');
})->name('game-store-3d');

Route::get('/arcade-store', function () {
    return view('arcade-store-enhanced');
})->name('arcade-store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/game-store-hyper', function () {
    return view('game-store-hyper');
})->name('game-store-hyper');

Route::get('/apps-store-neon', function () {
    return view('apps-store-neon-enhanced');
})->name('apps-store-neon');

Route::get('/ai-video-chat', function () {
    return view('ai-video-chat');
})->name('ai-video-chat');

Route::get('/ai-video-chat-neon', function () {
    return view('ai-video-chat-neon');
})->name('ai-video-chat-neon');

Route::get('/love-calculator', [LoveCalculatorController::class, 'index'])->name('love-calculator');
Route::post('/love-calculator/calculate', [LoveCalculatorController::class, 'calculate'])->name('love-calculator.calculate');
