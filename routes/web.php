<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[DashboardController::class,'index']) ->middleware(['auth']) -> name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/tasks',[TaskController::class,'index']) -> middleware(['auth']) -> name('tasks.index');
Route::post('/tasks',[TaskController::class,'store']) -> middleware(['auth']);
Route::put('/tasks/{task}',[TaskController::class,'update']) -> middleware(['auth']);
Route::delete('/tasks/{task}',[TaskController::class,'destroy']) -> middleware(['auth']);
Route::post('/tasks/bulk-create',[TaskController::class,'bulkCreate']) -> middleware(['auth']);
Route::patch('/tasks/{task}/update-attribute',[TaskController::class,'updateAttribute']) -> middleware(['auth']);
require __DIR__.'/auth.php';
