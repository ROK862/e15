<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ItemController;

use Illuminate\Support\Facades\Route;


Route::get('/', [PageController::class, 'home'])->name('home');;


/**
* The following Route groups require the user to be authorized.
*/
Route::group(["middleware" => "auth"], function () {
    Route::get('/create', [PageController::class, 'create'])->name('create');

    Route::get('/manage', [PageController::class, 'manage'])->name('manage');
    
    Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');

    Route::get('/sales', [PageController::class, 'salesReport'])->name('reports.sales');

    Route::get('/order/{product}', [PageController::class, 'order'])->name('order.items');

    Route::post('/create', [ItemController::class, 'store'])->name('store');

    Route::post('/update/visibility/{item_id}', [ItemController::class, 'updateVisibility'])->name('update_visibility');

    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

    Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');

    Route::get('/orders', [OrdersController::class, 'orders'])->name('orders.report');
});