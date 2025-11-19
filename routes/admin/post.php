<?php

use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('post', PostController::class);

// Route::post('post/sort/order', [PostController::class, 'updateOrder'])->name('post.updateOrder');
