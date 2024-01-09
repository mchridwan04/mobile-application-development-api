<?php

use App\Http\Controllers\MakanananController;
use App\Http\Controllers\PenitipanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HewanController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::get('/hewans', [HewanController::class, 'index']);
Route::post('/hewans', [HewanController::class, 'store']);
Route::put('/hewans/{id}', [HewanController::class, 'update']);
Route::delete('/hewans/{id}', [HewanController::class, 'destroy']);

Route::get('/makanans', [MakanananController::class, 'index']);
Route::post('/makanans', [MakanananController::class, 'store']);
Route::put('/makanans/{id}', [MakanananController::class, 'update']);
Route::delete('/makanans/{id}', [MakanananController::class, 'destroy']);


Route::get('/penitipans', [PenitipanController::class, 'index']);
Route::post('/penitipans', [PenitipanController::class, 'store']);
Route::put('/penitipans/{id}', [PenitipanController::class, 'update']);
Route::delete('/penitipans/{id}', [PenitipanController::class, 'destroy']);
