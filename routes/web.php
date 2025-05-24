<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', [DashboardController::class, 'index']);

// Client Routes
// Route::get('/clients', [ClientController::class,'index']);
// Route::get('/clients/create', [ClientController::class,'create']);
// Route::get('/clients/{client}', [ClientController::class,'show']);
// Route::get('/clients/{client}/edit', [ClientController::class,'edit']);
// Route::patch('/clients/{client}', [ClientController::class,'update']);
// Route::delete('/clients/{client}', [ClientController::class,'destroy']);
// Route::post('/clients', [ClientController::class,'store']);

Route::resource('clients', ClientController::class)->middleware('auth');



// Projects routes
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']);
Route::get('/projects/create', [App\Http\Controllers\ProjectController::class, 'create']);
Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']);
Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show']);


// Invoices routes
Route::get('/invoices', [App\Http\Controllers\InvoiceController::class, 'index']);
Route::get('/invoices/create', [App\Http\Controllers\InvoiceController::class, 'create']);
Route::post('/invoices', [App\Http\Controllers\InvoiceController::class, 'store']);
Route::get('/invoices/{invoice}', [App\Http\Controllers\InvoiceController::class, 'show']);


Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
