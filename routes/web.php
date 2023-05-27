<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main.index');

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', [App\Http\Controllers\Post\PostController::class, 'index'])->name('post.index');
    Route::get('/search', [App\Http\Controllers\Post\PostController::class, 'search'])->name('post.search');
    Route::get('/{post}', [App\Http\Controllers\Post\PostController::class, 'show'])->name('post.show');

    Route::group(['prefix' => '{post}/comments'], function () {
        Route::post('/', [App\Http\Controllers\Post\CommentController::class, 'store'])->name('post.comment.store');
    });

    Route::group(['prefix' => '{post}/likes'], function () {
        Route::post('/', [App\Http\Controllers\Post\LikeController::class, 'toggleLike'])->name('post.like.store');
    });
});

Route::group(['prefix' => 'personal', 'middleware' => ['auth', 'verified']], function () {
    Route::group(['prefix' => 'home'], function () { 
        Route::get('/', [App\Http\Controllers\Personal\HomeController::class, 'index'])->name('personal.main.index');
    });

    Route::group(['prefix' => 'likeds'], function () {
        Route::get('/', [App\Http\Controllers\Personal\LikedController::class, 'index'])->name('personal.liked.index');
        Route::delete('/{post}', [App\Http\Controllers\Personal\LikedController::class, 'delete'])->name('personal.liked.delete');
    });

    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [App\Http\Controllers\Personal\CommentController::class, 'index'])->name('personal.comment.index');
        Route::get('/{comment}/edit', [App\Http\Controllers\Personal\CommentController::class, 'edit'])->name('personal.comment.edit');
        Route::patch('/{comment}', [App\Http\Controllers\Personal\CommentController::class, 'update'])->name('personal.comment.update');
        Route::delete('/{comment}', [App\Http\Controllers\Personal\CommentController::class, 'delete'])->name('personal.comment.delete');
    });
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.main.index');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('admin.post.index');
        Route::get('/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('admin.post.create');
        Route::post('/', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('admin.post.store');
        Route::get('/{post}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('admin.post.show');
        Route::get('/{post}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])->name('admin.post.edit');
        Route::patch('/{post}', [App\Http\Controllers\Admin\PostController::class, 'update'])->name('admin.post.update');
        Route::delete('/{post}', [App\Http\Controllers\Admin\PostController::class, 'delete'])->name('admin.post.delete');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('/', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.category.show');
        Route::get('/{category}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::patch('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
        Route::delete('/{category}', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.category.delete');
    });

    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tag.index');
        Route::get('/create', [App\Http\Controllers\Admin\TagController::class, 'create'])->name('admin.tag.create');
        Route::post('/', [App\Http\Controllers\Admin\TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/{tag}', [App\Http\Controllers\Admin\TagController::class, 'show'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [App\Http\Controllers\Admin\TagController::class, 'edit'])->name('admin.tag.edit');
        Route::patch('/{tag}', [App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tag.update');
        Route::delete('/{tag}', [App\Http\Controllers\Admin\TagController::class, 'delete'])->name('admin.tag.delete');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.user.delete');
    });
});

Auth::routes(['verify' => true]);
