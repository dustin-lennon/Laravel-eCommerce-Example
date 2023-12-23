<?php

use App\Events\UserRegistered;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Jobs\SendMail;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/** CRUD Routes */
Route::group(['middleware' => 'auth'], function() {
    Route::get('posts/trash', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::get('posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/force-delete/{id}', [PostController::class, 'forceDelete'])->name('posts.force-delete');

    Route::resource('posts', PostController::class);
});

Route::get('send-mail', function () {
    SendMail::dispatch();

    dd('mail has been sent');
});

Route::get('user-data', function () {
    return auth()->user()->email;
});

Route::get('user-register', function () {
    $user = 'example@gmail.com';
    event(new UserRegistered($user));
    dd('message sent');
});


Route::get('greeting/{locale?}', function (?string $locale = 'en') {
    App::setLocale($locale);

    return view('greeting');
})->name('greeting');
