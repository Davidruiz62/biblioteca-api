<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Rutas de la API, devuelven JSON 
Route::get('/books', [BookController::class, 'index']);       
Route::get('/books/{id}', [BookController::class, 'show']);   
Route::post('/books', [BookController::class, 'store']);      
Route::put('/books/{id}', [BookController::class, 'update']); 
Route::patch('/books/{id}/read', [BookController::class, 'toggleRead']); 
Route::delete('/books/{id}', [BookController::class, 'destroy']); 
