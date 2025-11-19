<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::resource('category', CategoryController::class);

// Route::post('category/sort/order', [CategoryController::class, 'updateOrder'])->name('category.updateOrder');
