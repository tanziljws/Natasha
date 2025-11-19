<?php

use App\Http\Controllers\Admin\FotoController;
use Illuminate\Support\Facades\Route;

Route::resource('foto', FotoController::class)->except(['index']);
Route::get('foto', function () {
    return redirect()->route('admin.galery.index');
})->name('foto.index');

// Route::post('foto/sort/order', [FotoController::class, 'updateOrder'])->name('foto.updateOrder');
