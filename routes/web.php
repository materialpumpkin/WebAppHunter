<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/posts', 'store')->name('posts.store');
    Route::get('/posts/create', 'create')->name('posts.create');
    Route::get('/posts/serch', 'serch')->name('serch');
    Route::get('/posts/bookmark', 'bookmark_posts')->name('posts.bookmark');
    Route::get('/posts/{post}', 'show')->name('posts.show');
    Route::put('/posts/{post}', 'update')->name('posts.update');
    Route::delete('/posts/{post}', 'delete')->name('posts.delete');
    Route::get('/posts/{post}/edit', 'edit')->name('posts.edit');
});

Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");
Route::get('/doubleSearch', [CategoryController::class,'doubleSearch'])->name('doubleSearch');

Route::post('/bookmark/{post}', [BookmarkController::class, 'store'])->name('bookmark.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::delete('/posts/{post}/unbookmark', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    
});

require __DIR__.'/auth.php';
