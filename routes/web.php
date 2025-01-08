<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('dashboard/add', function () {
        return view('createQuestions');
    })->middleware(['auth', 'verified'])->name('dashboard.add'); 

Route::get('dashboard/activity', function () {
        return view('activity');
    })->middleware(['auth', 'verified'])->name('dashboard.activity');

Route::get('dashboard/activity/add', function () {
        return view('pages.activity.addActivity');
    })->middleware(['auth', 'verified'])->name('dashboard.activity.add');

Route::get('dashboard/survey', function () {
        return view('servayWizard');
    })->middleware(['auth', 'verified'])->name('dashboard.survey');

require __DIR__.'/auth.php';
