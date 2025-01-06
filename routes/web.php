<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('dashboard/add', function () {
        return view('createQuestions');
    })->middleware(['auth', 'verified'])->name('dashboard.add'); 

Route::get('dashboard/servay', function () {
        return view('servayWizard');
    })->middleware(['auth', 'verified'])->name('dashboard.servay'); 

require __DIR__.'/auth.php';
