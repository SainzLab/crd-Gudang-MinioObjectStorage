<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect('/products');
});

Route::resource('products', ProductController::class);
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');