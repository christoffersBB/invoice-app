<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SessionController;
use App\Mail\InvoiceSent;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Redirect forbidden (403) responses to /login
// Remove previous attempt, use Laravel's built-in auth middleware for all protected routes

// If user is not logged in, redirect '/' to /login, else show dashboard
Route::get('/', function () {
    if (!\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/login');
    }
    return app(\App\Http\Controllers\DashboardController::class)->index();
});

// Protect all resource and dashboard routes with 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::resource('clients', ClientController::class);
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']);
    Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']);
    Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']);
    Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show']);
    Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index']);
    Route::get('/invoices/create', [App\Http\Controllers\InvoiceController::class, 'create']);
    Route::post('/invoices', [App\Http\Controllers\InvoiceController::class, 'store']);
    Route::get('/invoices/{invoice}', [App\Http\Controllers\InvoiceController::class, 'show']);
});

// Registration and login routes remain public
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
