<?php

use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/contacts',[ContactController::class, 'index'])->name('contacts');
Route::post('/contacts/create',[ContactController::class, 'create'])->name('create');
Route::get('/contacts/delete/{id}',[ContactController::class, 'deleteContact'])->name('create');
Route::get('/contacts/edit/{id}',[ContactController::class, 'edit'])->name('edit');
Route::post('/contacts/update/{id}',[ContactController::class, 'update'])->name('update');

