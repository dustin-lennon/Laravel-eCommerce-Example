<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;

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

Route::get('home', HomeController::class);

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'handleLogin'])->name('login.submit');


// Route::get('about', [AboutController::class, 'index'])->name('about');

// Route::get('contact', [ContactController::class, 'index']);

// Route::resource('blog', BlogController::class);

// /** Fallback Route */
// Route::fallback(function () {
//     return "Route Not Exist!";
// });
