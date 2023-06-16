<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatierController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Common Resource Routes:
// index - Show all Matiers
// show - Show single Matier
// create - Show form to create new Matier
// store - Store new Matier
// edit - Show form to edit Matier
// update - Update Matier
// destroy - Delete Matier


Route::get('/', [HomeController::class, 'index']);



// All Matiers
Route::get('/matiers', [MatierController::class, 'index']);

// Show Create Form for matier
Route::get('/matiers/create', [MatierController::class, 'create'])->middleware('auth');

// Store matier Data
Route::post('/matiers', [MatierController::class, 'store'])->middleware('auth');

// Show Edit Form for matier
Route::get('/matiers/{id}/edit', [MatierController::class, 'edit'])->middleware('auth');

// Update Matier
Route::put('/matiers/{id}', [MatierController::class, 'update'])->middleware('auth');

// Delete Matier
Route::delete('/matiers/{id}', [MatierController::class, 'destroy'])->middleware('auth');

// Single Matier
Route::get('/matiers/{id}', [MatierController::class, 'show']);



// All Sessions
Route::get('/sessions', [SessionController::class, 'index']);

// Show Create Form for Session
Route::get('/sessions/create', [SessionController::class, 'create'])->middleware('auth');

// Store Session Data
Route::post('/sessions', [SessionController::class, 'store'])->middleware('auth');

// Show Edit Form for Session
Route::get('/sessions/{id}/edit', [SessionController::class, 'edit'])->middleware('auth');
// Show Edit Form for Session
Route::get('/sessions/{id}/subscribe', [SessionController::class, 'subscribe'])->middleware('auth');

// Update Session
Route::put('/sessions/{id}', [SessionController::class, 'update'])->middleware('auth');

// Delete Session
Route::delete('/sessions/{id}', [SessionController::class, 'destroy'])->middleware('auth');

// Single Session
Route::get('/sessions/{id}', [SessionController::class, 'show']);

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('auth');

// get all users
Route::get('/users', [UserController::class, 'index']);
// get all users
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
// Create New User
Route::post('/users', [UserController::class, 'store']);
// Update role
Route::put('/users/role', [UserController::class, 'updateRole'])->middleware('auth');
// Update user
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth');
// Delete Session
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth');

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
