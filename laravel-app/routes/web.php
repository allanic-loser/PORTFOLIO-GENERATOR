<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SupabaseSessionController;

// Public landing page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login and Register pages
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');

// Portfolio management page
Route::get('/portfolio/manage', [
    App\Http\Controllers\PortfolioController::class,
    'index',
])->name('portfolio.index');

// Portfolio setup and creation
Route::get('/portfolio/setup', function () {
    return view('portfolio.setup');
})->name('portfolio.setup');

Route::get('/portfolio/create', [
    PortfolioController::class,
    'create',
])->name('portfolio.create');

Route::post('/portfolio', [
    PortfolioController::class,
    'store',
])->name('portfolio.store');


Route::get('/portfolio/{id}/edit', [
    PortfolioController::class,
    'edit',
])->name('portfolio.edit');

Route::put('/portfolio/{id}', [
    PortfolioController::class,
    'update',
])->name('portfolio.update');

Route::delete('/portfolio/{id}', [
    PortfolioController::class,
    'destroy',
])->name('portfolio.destroy');

Route::get('/portfolio/{id}/preview', [PortfolioController::class, 'preview'])
    ->name('portfolio.preview');

// Supabase session management
Route::post('/supabase/session', [
    SupabaseSessionController::class,
    'store',
])->name('supabase.session.store');

Route::delete('/supabase/session', [
    SupabaseSessionController::class,
    'destroy',
])->name('supabase.session.destroy');
