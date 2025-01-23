<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('dashboard/add', function () {
        return view('createQuestions');
    })->middleware(['auth', 'verified'])->name('dashboard.add');

// Activity Routes

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

// Organizer Routes

Route::get('dashboard/organiser', function () {
    return view('organizer');
    })->middleware(['auth', 'verified'])->name('dashboard.organiser');


Route::get('dashboard/organiser/add', function () {
        return view('pages.organizer.addOrganizer');
    })->middleware(['auth', 'verified'])->name('dashboard.organiser.add');

Route::get('dashboard/organiser/edit/{id}', function ($id) {
        return view('pages.organizer.editOrganizer', ['id' => $id]);
    })->middleware(['auth', 'verified'])->name('dashboard.organiser.edit');


// FC Admin

Route::get('dashboard/fc-admin', function () {
    return view('fcAdmin');
    })->middleware(['auth', 'verified'])->name('dashboard.fc-admin');


Route::get('dashboard/fc-admin/add', function (){
    return view('pages.fcAdmin.addFcAdmin');

})->middleware(['auth', 'verified'])
    ->name('dashboard.fc_admin.add');


Route::get('dashboard/fc-admin/edit/{id}', function ($id) {
        return view('pages.fcAdmin.editFcAdmin', ['id' => $id]);
    })->middleware(['auth', 'verified'])->name('dashboard.fc_admin.edit');


// Public Route

Route::get('dashboard/survey', function () {
        return view('servayWizard');
    })->middleware(['auth', 'verified'])->name('dashboard.survey');

require __DIR__.'/auth.php';
