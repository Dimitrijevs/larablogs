<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', [MainPageController::class, 'index'])->name('main');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('posts')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/', [PostController::class, 'store'])->name('posts.store');
        Route::get('/{post}', [PostController::class, 'show'])->name('posts.show');
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}/update', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/{post}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');

        Route::post('/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    });

    Route::prefix('comments')->group(function () {
        Route::delete('/{comment}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');
    });
});
