<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/api/users', [UserController::class, 'getUsers']);

    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/admin/users', [UserController::class, 'showUsers'])->name('admin.users');
        Route::post('/admin/change-role/{user}', [UserController::class, 'changeRole'])->name('admin.change_role');
    });

    Route::middleware([RoleMiddleware::class . ':professor'])->group(function () {
        Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
        Route::get('/task/{task}/applied-students', [TaskController::class, 'appliedStudents'])->name('task.applied_students');
        Route::post('/task', [TaskController::class, 'store'])->name('task.store');
    });

    Route::get('/tasks', [TaskController::class, 'allTasks'])->name('task.all_tasks');
    Route::get('/task/{task}', [TaskController::class, 'apply'])->middleware(RoleMiddleware::class . ':student')->name('task.apply');
});
