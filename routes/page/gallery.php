<?php

use App\Http\Controllers\Page\GalleryController;

Route::get('/gallery', [GalleryController::class, 'index'])->name("gallery.index");
