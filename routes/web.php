<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\LikeController;
use App\Http\Controllers\Personal\HomeController as PersonalHomeController;
use App\Http\Controllers\Personal\LikedController;
use App\Http\Controllers\Personal\CommentController as PersonalCommentController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', [HomeController::class, 'index'])->name('main.index');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/search', [PostController::class, 'search'])->name('post.search');
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');

    Route::group(['prefix' => '{post}/comments'], function () {
        Route::post('/', [CommentController::class, 'store'])->name('post.comment.store');
    });

    Route::group(['prefix' => '{post}/likes'], function () {
        Route::post('/', [LikeController::class, 'toggleLike'])->name('post.like.store');
    });
});

Route::group(['prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'home'], function () { 
        Route::get('/', [PersonalHomeController::class, 'index'])->name('personal.main.index');
    });

    Route::group(['prefix' => 'likeds'], function () {
        Route::get('/', [LikedController::class, 'index'])->name('personal.liked.index');
        Route::delete('/{post}', [LikedController::class, 'delete'])->name('personal.liked.delete');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [PersonalCommentController::class, 'index'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [PersonalCommentController::class, 'edit'])->name('personal.comment.edit');
        Route::patch('/{comment}', [PersonalCommentController::class, 'update'])->name('personal.comment.update');
        Route::delete('/{comment}', [PersonalCommentController::class, 'delete'])->name('personal.comment.delete');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('admin.main.index');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [AdminPostController::class, 'index'])->name('admin.post.index');
        Route::get('/create', [AdminPostController::class, 'create'])->name('admin.post.create');
        Route::post('/', [AdminPostController::class, 'store'])->name('admin.post.store');
        Route::get('/{post}', [AdminPostController::class, 'show'])->name('admin.post.show');
        Route::get('/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.post.edit');
        Route::patch('/{post}', [AdminPostController::class, 'update'])->name('admin.post.update');
        Route::delete('/{post}', [AdminPostController::class, 'delete'])->name('admin.post.delete');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::patch('/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{category}', [CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
        Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagController::class, 'delete'])->name('admin.tag.delete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user}', [UserController::class, 'delete'])->name('admin.user.delete');
    });
});

Auth::routes(['verify' => true]);
