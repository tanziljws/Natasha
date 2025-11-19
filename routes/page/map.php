<?php

use App\Http\Controllers\Page\MapController;

Route::get('/maps', [MapController::class, 'index'])->name("map.index");
Route::get('/detail/{id}', [MapController::class, 'show'])->name("detail.show");
