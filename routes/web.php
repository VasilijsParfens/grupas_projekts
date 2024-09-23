<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\HomepageController;
use App\Http\Middleware\CheckPostAuthor;

Route::get('/', [HomepageController::class, 'index']);

Route::get('/register', [UserController::class, 'showRegisterform'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware(CheckPostAuthor::class);
Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware(CheckPostAuthor::class);

Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(CheckPostAuthor::class);
