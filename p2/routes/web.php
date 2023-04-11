<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PracticeController;


Route::any('/practice/{n?}', [PracticeController::class, 'index']);

Route::get('/', [PageController::class,'home']);

Route::get('/home', [PageController::class,'home']);

Route::post('/process', [StockController::class, 'process']);