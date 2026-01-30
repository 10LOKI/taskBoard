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
Route::delete('/tasks/{id}/archive',[TaskController::class ,'archive']) -> name('tasks.archive');
Route::get('/tasks/archived',[TaskController::class,'archived']) -> middleware(['auth']) -> name('tasks.archived');
Route::post('/tasks/{id}/restore',[TaskController::class,'restore']) -> middleware(['auth']) -> name('tasks.restore');
Route::delete('/tasks/{id}/force-delete',[TaskController::class,'forceDelete']) -> middleware(['auth']) -> name('tasks.force-delete');
require __DIR__.'/auth.php';
