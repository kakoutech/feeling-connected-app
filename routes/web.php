<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('dashboard/add', function () {
        return view('createQuestions');
    })->middleware(['auth', 'verified'])->name('dashboard.add'); 

// Activvity Routes

Route::get('dashboard/activity', function () {
        return view('activity');
    })->middleware(['auth', 'verified'])->name('dashboard.activity');

Route::get('dashboard/activity/add', function () {
        return view('pages.activity.addActivity');
    })->middleware(['auth', 'verified'])->name('dashboard.activity.add');

Route::get('dashboard/activity/edit/{id}', function ($id) {
        return view('pages.activity.editActivity', ['id' => $id]);
    })->middleware(['auth', 'verified'])->name('dashboard.activity.edit');

// Venues Routes

Route::get('dashboard/venue', function () {
    return view('venue');
    })->middleware(['auth', 'verified'])->name('dashboard.venue');

Route::get('dashboard/venue/add', function () {
        return view('pages.venue.addVenue');
    })->middleware(['auth', 'verified'])->name('dashboard.venue.add');

Route::get('dashboard/venue/edit/{id}', function ($id) {
        return view('pages.venue.editVenue', ['id' => $id]);
    })->middleware(['auth', 'verified'])->name('dashboard.venue.edit');

Route::get('dashboard/survey', function () {
        return view('servayWizard');
    })->middleware(['auth', 'verified'])->name('dashboard.survey');

require __DIR__.'/auth.php';
