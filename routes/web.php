<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PerpustakaanController;

Route::get('Perpustakaans', [PerpustakaanController::class, 'index'])->name('Perpustakaans.index');
Route::get('Perpustakaans/create', [PerpustakaanController::class, 'create'])->name('Perpustakaans.create');
Route::post('Perpustakaans', [PerpustakaanController::class, 'store'])->name('Perpustakaans.store');
Route::get('Perpustakaans/{id}/edit', [PerpustakaanController::class, 'edit'])->name('Perpustakaans.edit');
Route::put('Perpustakaans/{id}', [PerpustakaanController::class, 'update'])->name('Perpustakaans.update');
Route::delete('Perpustakaans/{id}', [PerpustakaanController::class, 'destroy'])->name('perpustakaans.destroy');

Route::get('/', function () {
    return view('welcome');
});
