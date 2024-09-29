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
use App\Http\Controllers\BrowseController;
use App\Http\Middleware\CheckPostAuthor;

Route::get('/', [HomepageController::class, 'index']);
Route::get('/test', [ProfileController::class, 'index']);
Route::get('/following', [BrowseController::class, 'followingPosts']);
Route::get('/newest', [BrowseController::class, 'newestPosts']);
Route::get('/popular', [BrowseController::class, 'PopularPosts']);
Route::get('/trending', [BrowseController::class, 'trendingPosts']);

Route::get('/register', [UserController::class, 'showRegisterform'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
Route::get('/admin/posts', [AdminController::class, 'showPosts'])->name('admin.posts');
Route::get('/admin/comments', [AdminController::class, 'showComments'])->name('admin.comments');
Route::get('/admin/stats', [AdminController::class, 'showStats'])->name('admin.stats');

Route::get('/profile/{userId}', [ProfileController::class, 'showInfo'])->name('profile.show');

Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware(CheckPostAuthor::class);
Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware(CheckPostAuthor::class);

Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(CheckPostAuthor::class);
