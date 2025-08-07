<?php

use App\Http\Controllers\Auth\DiscordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/login/discord', [DiscordController::class, 'redirect'])
    ->name('login.discord');

Route::get('/login/discord/callback', [DiscordController::class, 'callback'])
    ->name('login.discord.callback');
