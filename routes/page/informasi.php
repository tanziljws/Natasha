<?php

use App\Http\Controllers\Page\InformasiController;

Route::get('/informasi', [InformasiController::class, 'index'])->name("informasi.index");
