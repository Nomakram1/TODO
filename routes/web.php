<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowTask\ShowTaskController;
use App\Http\Controllers\CreateTask\CreateTaskController;
use App\Http\Controllers\CreateTaskGroup\CreateTaskGroupController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ShowTaskController::class, 'show'])->name('dashboard');
    Route::get('/create', [CreateTaskController::class, 'create'])->name('create');
    Route::get('/create-task-group', [CreateTaskGroupController::class, 'create'])->name('create-task-group');
});


require __DIR__.'/auth.php';
