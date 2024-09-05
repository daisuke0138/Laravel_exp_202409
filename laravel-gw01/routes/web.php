<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetLikeController;
use App\Http\Controllers\CommentController;
use App\Models\User;
use App\Http\Controllers\UserController;


Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
  Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
  Route::get('/profile/my-profile-show', [ProfileController::class, 'show'])->name('profile.my-profile-show'); // 追加
  Route::resource('tweets', TweetController::class);
  Route::post('/tweets/{tweet}/like', [TweetLikeController::class, 'store'])->name('tweets.like');
  Route::delete('/tweets/{tweet}/like', [TweetLikeController::class, 'destroy'])->name('tweets.dislike');
  Route::resource('tweets.comments', CommentController::class);
  Route::get('/users', [UserController::class, 'index'])->name('users.index');
  Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
  Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

});

require __DIR__ . '/auth.php';
