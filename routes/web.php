<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;

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