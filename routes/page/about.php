<?php

use App\Http\Controllers\Page\HomeController;
use App\Http\Controllers\Page\AboutController;

Route::get('/about/{id}', [AboutController::class, 'show'])->name("about.show");
