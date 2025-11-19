<?php

use App\Http\Controllers\Page\HomeController;

Route::get('/', [HomeController::class, 'index'])->name("home.index");
