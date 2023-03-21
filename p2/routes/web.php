<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PageController;


Route::get('/', [PageController::class,'home']);

Route::get('/home', [PageController::class,'home']);

Route::post('/process', [StockController::class, 'process']);