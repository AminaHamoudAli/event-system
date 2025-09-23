<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use Inertia\Inertia;


use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(function () {
    return Inertia::render('Error/NotFound');
});


Route::get('/events', [EventController::class, 'index'])->name('events.index');

// صفحات الأحداث
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/events', [EventController::class, 'index'])->name('events.index');
//     Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
// });
// Route::get('/dashboard', function () { return Inertia::render('Dashboard'); });
Route::get('/events', function () { return Inertia::render('Events'); });
Route::get('/orders', function () { return Inertia::render('Orders'); });
// Route::get('/orders', function () { return Inertia::render('Orders'); });
// Route::get('/events/create', function () { return Inertia::render('EventTickets'); });
// Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');


Route::get('/events/create', function () {
    return Inertia::render('EventCreate'); // اسم الملف Vue بدون .vue
})->middleware(['auth'])->name('events.create');




// Route::get('/event-tickets', function () {
//     return Inertia::render('EventTickets'); // اسم الصفحة بالضبط كما في resources/js/Pages/EventTickets.vue
// })->name('tickets.index');

Route::get('/event-tickets', [TicketController::class, 'index'])->name('tickets.index');

// Route::Resource('events', EventController::class);

require __DIR__.'/auth.php';
