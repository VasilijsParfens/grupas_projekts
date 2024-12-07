<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\BrowseController;
use App\Http\Middleware\CheckPostAuthor;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [HomepageController::class, 'index']);
Route::get('/following', [BrowseController::class, 'followingPosts']);
Route::get('/newest', [BrowseController::class, 'newestPosts']);
Route::get('/popular', [BrowseController::class, 'PopularPosts']);
Route::get('/trending', [BrowseController::class, 'trendingPosts']);
Route::get('/search', [SearchController::class, 'filter'])->name('search');

Route::get('/register', [UserController::class, 'showRegisterform'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/profile/edit', [UserController::class, 'showEditProfileForm'])->name('profile.edit');
Route::post('/profile/edit', [UserController::class, 'editProfile'])->name('profile.update');

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::group(['middleware' => AdminMiddleware::class], function () {
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users');
    Route::get('/export-users-xlsx', [AdminController::class, 'exportUsersToXLSX'])->name('export-users-xlsx');
    Route::get('/admin/posts', [AdminController::class, 'showPosts'])->name('admin.posts');
    Route::get('/admin/comments', [AdminController::class, 'showComments'])->name('admin.comments');
    Route::get('/admin/stats', [AdminController::class, 'showStats'])->name('admin.stats');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    Route::delete('/admin/posts/{id}', [PostController::class, 'destroy'])->name('admin.posts.delete');
    Route::delete('/admin/comments/{id}', [CommentController::class, 'destroyComment'])->name('admin.comments.delete');
});


Route::get('/profile/{userId}', [ProfileController::class, 'showInfo'])->name('profile.show');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{postId}/like', [LikeController::class, 'like'])->middleware('auth')->name('posts.like');
Route::post('/posts/{postId}/unlike', [LikeController::class, 'unlike'])->middleware('auth')->name('posts.unlike');
Route::post('/posts/{postId}/comments', [CommentController::class, 'storeComment'])->name('comments.store');
Route::put('/comments/{commentId}', [CommentController::class, 'updateComment'])->name('comments.update');
Route::delete('/comments/{commentId}', [CommentController::class, 'destroyComment'])->name('comments.destroy');

Route::post('/follow/{followedUserId}', [FollowerController::class, 'follow'])->name('follow');
Route::post('/unfollow/{followedUserId}', [FollowerController::class, 'unfollow'])->name('unfollow');

Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware(CheckPostAuthor::class);
Route::put('posts/{id}', [PostController::class, 'update'])->name('posts.update')->middleware(CheckPostAuthor::class);
Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(CheckPostAuthor::class);
