<?php

use App\Http\Controllers\GuideController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guias', [GuideController::class, 'index'])->name('guides.index');
Route::get('/guias/{guide}', [GuideController::class, 'show'])->name('guides.show');

Route::get('/dashboard', function () {
    return redirect()->route('guides.mine');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/mis-guias', [GuideController::class, 'mine'])->name('guides.mine');
    Route::get('/guias/crear/nueva', [GuideController::class, 'create'])->name('guides.create');
    Route::post('/guias', [GuideController::class, 'store'])->name('guides.store');
    Route::get('/guias/{guide}/editar', [GuideController::class, 'edit'])->name('guides.edit');
    Route::patch('/guias/{guide}', [GuideController::class, 'update'])->name('guides.update');
    Route::delete('/guias/{guide}', [GuideController::class, 'destroy'])->name('guides.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
