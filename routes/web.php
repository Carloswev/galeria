<?php

use App\Http\Controllers\PhotoController;

Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
Route::delete('/photos/{id}', [PhotoController::class, 'destroy'])->name('photos.destroy');
