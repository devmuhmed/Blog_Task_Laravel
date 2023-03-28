<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'index'])
        ->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'index'])
        ->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [PostController::class, 'index'])
        ->name('dashboard');
    Route::post('/posts/{post}/likes', [LikeController::class, 'storepost'])
        ->name('posts.likes');
    Route::post('/comments/{comment}/likes', [LikeController::class, 'store'])
        ->name('comments.likes');
    Route::resource('comments', CommentController::class);
    Route::get('/profiles/{user}/likes', [ProfileController::class, 'likes'])->name('profiles.likes');
});
Route::resource('posts', PostController::class);

Route::get('/home', function () {
    return redirect()->route('posts.index');
})->name('home');

Route::resource('categories', CategoryController::class);
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroypost'])
    ->name('likes.destroy');
Route::delete('/comments/{comment}/likes', [LikeController::class, 'destroy'])
    ->name('commentslikes.destroy');
Route::get('/profiles/{user}/posts', [ProfileController::class, 'posts'])->name('profiles.posts');
Route::get('/profiles/{user}/comments', [ProfileController::class, 'comments'])->name('profiles.comments');
