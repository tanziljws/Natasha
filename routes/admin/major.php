<?php

use App\Http\Controllers\Admin\MajorController;
use Illuminate\Support\Facades\Route;

Route::resource('major', MajorController::class);

// Route::post('major/sort/order', [MajorController::class, 'updateOrder'])->name('major.updateOrder');
