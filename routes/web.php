<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;

// Public Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication Routes
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated and Verified Users
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Events (ONLY allow user access to their own events)
    Route::resource('events', EventController::class); // ✅ Keep this only ONCE

    Route::patch('/events/{id}/approve', [EventController::class, 'approve'])->name('events.approve')->middleware('admin');

    // Calendar/API
    Route::get('/api/events', [EventController::class, 'getEvents']);

    // Booking and registration
    Route::post('/events/{id}/book', [BookingController::class, 'book'])->name('bookings.book');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my');
    Route::post('/events/{id}/register', [UserController::class, 'registerEvent'])->name('events.register');
});

// Admin-only
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Admin Event Management
    Route::get('/events/manage', [AdminController::class, 'manageEvents'])->name('manageEvents');
    Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
    Route::post('/events', [AdminController::class, 'storeEvent'])->name('events.store');
    Route::get('/events/{id}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
    Route::put('/events/{id}', [AdminController::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{id}', [AdminController::class, 'deleteEvent'])->name('events.destroy');
    Route::patch('/events/{id}/approve', [AdminController::class, 'approveEvent'])->name('events.approve');

    // Admin Users & Bookings
    Route::get('/users', [AdminController::class, 'manageUsers'])->name('manageUsers');
    Route::patch('/users/{id}/toggle-status', [AdminController::class, 'toggleUserStatus'])->name('toggleUserStatus');
    Route::get('/bookings', [AdminController::class, 'manageBookings'])->name('manageBookings');
});

require __DIR__.'/auth.php';
