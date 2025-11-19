<?php

use App\Http\Controllers\Admin\ProfilesController;
use Illuminate\Support\Facades\Route;

Route::resource('profiles', ProfilesController::class)->parameters([
    'profiles' => 'profiles'
]);

// Route::post('profiles/sort/order', [ProfilesController::class, 'updateOrder'])->name('profiles.updateOrder');
