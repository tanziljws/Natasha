<?php

use App\Http\Controllers\Admin\GaleryController;
use Illuminate\Support\Facades\Route;

Route::resource('galery', GaleryController::class);

// Route::post('galery/sort/order', [GaleryController::class, 'updateOrder'])->name('galery.updateOrder');
