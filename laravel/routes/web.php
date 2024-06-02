<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::prefix('/')->group(function() {
    Route::get('/', [userController::class, 'index'])->name('user-index');
    Route::post('/', [userController::class, 'store'])->name('user-store');
    Route::get('/{id}/edit', [userController::class, 'edit'])->name('user-edit');
    Route::put('/{id}', [userController::class, 'update'])->name('user-update');
    Route::delete('/{id}', [userController::class, 'destroy'])->name('user-destroy');

});
