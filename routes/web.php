<?php

use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\CustomerWebController;
use Illuminate\Support\Facades\Route;

// UI: Login Page


Route::get('/', [WebAuthController::class, 'showLoginForm'])->name('home');

Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.submit');

Route::post('/register', [WebAuthController::class, 'register'])->name('register.submit');


Route::get('/verify-mfa', [WebAuthController::class, 'showMfaForm'])->name('verify-mfa-form');
Route::post('/verify-mfa', [WebAuthController::class, 'verifyMfa'])->name('verify-mfa-submit');




Route::middleware('auth')->group(function () {

    Route::get('/customers', function () {
        return view('customers.index');
    })->name('customers.index');
    
    Route::get('/customers/create', function () {
        return view('customers.create');
    });
    
    Route::get('/customers/{id}/edit', function ($id) {
        return view('customers.edit', ['id' => $id]);
    });
});

