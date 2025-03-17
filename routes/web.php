<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index');

Route::get('/animals/create', [AnimalController::class, 'create'])->name('animals.create'); // Show form
Route::post('/animals', [AnimalController::class, 'store'])->name('animals.store'); // Handle form submission
Route::delete('/animals/{id}', [AnimalController::class, 'destroy'])->name('animals.destroy');
Route::get('/animals/{id}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
Route::put('/animals/{animal}', [AnimalController::class, 'update'])->name('animals.update');


Route::get('/admin/animals', [AnimalController::class, 'adminAnimals'])->middleware('auth')->name('admin.animals');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users/{user}/animals', [AnimalController::class, 'userAnimals'])->name('users.animals');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
