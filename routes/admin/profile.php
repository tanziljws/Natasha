<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::resource('profile', ProfileController::class);

// Route::post('profile/sort/order', [ProfileController::class, 'updateOrder'])->name('profile.updateOrder');
