<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventAdminController;
use App\Http\Controllers\AdminController;

Route::get('/event/{id}', [EventController::class, 'show'])->name('event.show')->middleware('auth');
Route::get('/allevents', [EventController::class, 'index'])->name('allevents');
Route::get('/login', [UserController::class, 'showCorrectHomepage'])->name('login');
Route::get('/', [UserController::class, "showCorrectHomepage"]);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/enroll/{id}', [EventController::class, 'enrollEvent'])->middleware('auth');
Route::post('/unenroll/{id}', [EventController::class, 'unenrollEvent'])->name('unenroll');
Route::get('/profile/{roll_no}', [ProfileController::class, 'show'])->name('profile');

// Event Admin Routes
Route::prefix('event-admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [EventAdminController::class, 'dashboard'])->name('event-admin.dashboard');
    Route::get('/event/{id}', [EventAdminController::class, 'manageEvent'])->name('event-admin.manage');
    Route::get('/event/{id}/edit', [EventAdminController::class, 'editEvent'])->name('event-admin.edit');
    Route::put('/event/{id}', [EventAdminController::class, 'updateEvent'])->name('event-admin.update');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/event/{id}/admins', [AdminController::class, 'manageEventAdmins'])->name('admin.event.admins');
    Route::post('/event/{id}/admins', [AdminController::class, 'assignEventAdmin'])->name('admin.event.admins.assign');
    Route::delete('/event/{eventId}/admins/{userId}', [AdminController::class, 'removeEventAdmin'])->name('admin.event.admins.remove');
    Route::post('/enrollments/{id}/approve', [AdminController::class, 'approveEnrollment'])->name('admin.enrollments.approve');
    Route::post('/enrollments/{id}/disapprove', [AdminController::class, 'disapproveEnrollment'])->name('admin.enrollments.disapprove');
});